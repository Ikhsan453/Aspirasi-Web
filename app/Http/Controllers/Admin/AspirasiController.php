<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\AspirasiStatusHistory;
use App\Models\InputAspirasi;
use App\Traits\ResetsAutoIncrement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    use ResetsAutoIncrement;

    public function index(Request $request)
    {
        $query = InputAspirasi::with(['siswa', 'kategori', 'aspirasi']);
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nis', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('ket', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function($kq) use ($search) {
                      $kq->where('ket_kategori', 'like', "%{$search}%");
                  });
            });
        }
        
        // Date filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Status filter
        if ($request->filled('status')) {
            $status = $request->status;
            $query->whereHas('aspirasi', function($sq) use ($status) {
                $sq->where('status', $status);
            });
        }
        
        // Per page filter (default 10, allow 5, 10, 25, 50, 100)
        $perPage = $request->get('per_page', 10);
        $allowedPerPage = [5, 10, 25, 50, 100];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
        
        $inputAspirasis = $query->orderBy('id_pelaporan', 'asc')->paginate($perPage);
        
        return view('admin.aspirasi.index', compact('inputAspirasis'));
    }

    public function show(InputAspirasi $inputAspirasi)
    {
        $inputAspirasi->load(['siswa', 'kategori', 'aspirasi']);
        return view('admin.aspirasi.show', compact('inputAspirasi'));
    }

    public function updateStatus(Request $request, InputAspirasi $inputAspirasi)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string'
        ]);

        // Get current admin username
        $adminUsername = Auth::guard('admin')->user()->username ?? 'system';

        // Save to status history for this specific aspirasi
        AspirasiStatusHistory::create([
            'id_pelaporan' => $inputAspirasi->id_pelaporan,
            'status' => $request->status,
            'feedback' => $request->feedback,
            'changed_by' => $adminUsername
        ]);

        // Update aspirasi record for this aspirasi
        $aspirasi = Aspirasi::updateOrCreate(
            ['id_pelaporan' => $inputAspirasi->id_pelaporan],
            [
                'id_kategori' => $inputAspirasi->id_kategori,
                'status' => $request->status,
                'feedback' => $request->feedback
            ]
        );

        return redirect()->route('admin.aspirasi.index')
                        ->with('success', 'Status aspirasi berhasil diupdate');
    }

    public function destroy(InputAspirasi $inputAspirasi)
    {
        $pelaporanId = $inputAspirasi->id_pelaporan;
        
        // Delete related aspirasi and status histories (cascade should handle this)
        AspirasiStatusHistory::where('id_pelaporan', $pelaporanId)->delete();
        Aspirasi::where('id_pelaporan', $pelaporanId)->delete();
        
        // Delete the aspirasi
        $inputAspirasi->delete();
        
        // Reset auto increments
        $this->resetInputAspirasiAutoIncrement();
        $this->resetAspirasiAutoIncrement();
        $this->resetStatusHistoryAutoIncrement();

        return redirect()->route('admin.aspirasi.index')
                        ->with('success', 'aspirasi dan riwayat statusnya berhasil dihapus');
    }
}