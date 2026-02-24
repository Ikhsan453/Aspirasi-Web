<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\AspirasiStatusHistory;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AspirasiController extends Controller
{
    public function index()
    {
        return view('student.aspirasi.index');
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('student.aspirasi.create', compact('kategoris'));
    }

    public function checkNis($nis)
    {
        try {
            $siswa = Siswa::where('nis', $nis)->first();
            
            if ($siswa) {
                return response()->json([
                    'success' => true,
                    'student' => [
                        'nis' => $siswa->nis,
                        'kelas' => $siswa->kelas,
                        'jurusan' => $siswa->jurusan
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'NIS tidak ditemukan dalam database siswa'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memverifikasi NIS'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|max:10',
            'id_kategori' => 'required|exists:tb_kategori,id_kategori',
            'lokasi' => 'required|max:50',
            'ket' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Verifikasi NIS ada di tabel siswa
        $siswa = Siswa::where('nis', $request->nis)->first();
        
        if (!$siswa) {
            return back()->withErrors([
                'nis' => 'NIS tidak ditemukan dalam database siswa. Silakan hubungi admin untuk mendaftarkan NIS Anda terlebih dahulu.'
            ])->withInput();
        }

        $data = [
            'nis' => $request->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket
        ];

        // Handle upload foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('aspirasi', $filename, 'public');
            $data['foto'] = $filename;
        }

        $inputAspirasi = InputAspirasi::create($data);

        // Create aspirasi status for this aspirasi
        Aspirasi::create([
            'id_pelaporan' => $inputAspirasi->id_pelaporan,
            'id_kategori' => $inputAspirasi->id_kategori,
            'status' => 'Menunggu',
            'feedback' => null
        ]);

        // Create initial status history
        AspirasiStatusHistory::create([
            'id_pelaporan' => $inputAspirasi->id_pelaporan,
            'status' => 'Menunggu',
            'feedback' => 'aspirasi telah diterima dan sedang menunggu review dari admin.',
            'changed_by' => 'system'
        ]);

        return redirect()->route('student.aspirasi.success')
                        ->with('success', 'aspirasi berhasil dikirim');
    }

    public function success()
    {
        return view('student.aspirasi.success');
    }

    public function status()
    {
        return view('student.aspirasi.status');
    }

    public function checkStatus(Request $request)
    {
        // Support both GET and POST
        $nis = $request->input('nis');
        
        if (!$nis) {
            return redirect()->route('student.aspirasi.status')
                ->withErrors(['nis' => 'NIS harus diisi']);
        }

        $request->validate([
            'nis' => 'required|max:10'
        ]);

        // Per page filter (default 10, allow 5, 10, 25, 50, 100)
        $perPage = $request->get('per_page', 10);
        $allowedPerPage = [5, 10, 25, 50, 100];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        // Get paginated data
        $aspirasis = InputAspirasi::with(['kategori', 'aspirasi', 'siswa'])
            ->where('nis', $nis)
            ->orderBy('id_pelaporan', 'asc')
            ->paginate($perPage);

        // Calculate statistics from all data (not just current page)
        $allAspirasis = InputAspirasi::with('aspirasi')
            ->where('nis', $nis)
            ->get();
        
        $totalAspirasi = $allAspirasis->count();
        $menunggu = 0;
        $proses = 0;
        $selesai = 0;

        foreach ($allAspirasis as $item) {
            $status = $item->aspirasi ? $item->aspirasi->status : 'Menunggu';
            if ($status === 'Menunggu') {
                $menunggu++;
            } elseif ($status === 'Proses') {
                $proses++;
            } elseif ($status === 'Selesai') {
                $selesai++;
            }
        }

        return view('student.aspirasi.status', compact('aspirasis', 'totalAspirasi', 'menunggu', 'proses', 'selesai'));
    }

}