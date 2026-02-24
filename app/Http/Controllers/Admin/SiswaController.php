<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Traits\ResetsAutoIncrement;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    use ResetsAutoIncrement;

    public function index(Request $request)
    {
        $query = Siswa::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nis', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%");
            });
        }
        
        // Date filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Per page filter (default 10, allow 5, 10, 25, 50, 100)
        $perPage = $request->get('per_page', 10);
        $allowedPerPage = [5, 10, 25, 50, 100];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }
        
        $siswas = $query->orderBy('nis', 'asc')->paginate($perPage);
        
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|max:10|unique:tb_siswa',
            'kelas' => 'required|max:10',
            'jurusan' => 'required|max:100'
        ]);

        Siswa::create($request->all());

        return redirect()->route('admin.siswa.index')
                        ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|max:10|unique:tb_siswa,nis,' . $siswa->nis . ',nis',
            'kelas' => 'required|max:10',
            'jurusan' => 'required|max:100'
        ]);

        $siswa->update($request->all());

        return redirect()->route('admin.siswa.index')
                        ->with('success', 'Siswa berhasil diupdate');
    }

    public function destroy(Siswa $siswa)
    {
        // Check if siswa has any aspirasi (input_aspirasis)
        $aspirasiCount = $siswa->inputAspirasis()->count();
        
        if ($aspirasiCount > 0) {
            // Delete all related aspirasi (cascade will handle aspirasi and status history)
            $siswa->inputAspirasis()->delete();
            
            // Reset auto increments for related tables
            $this->resetInputAspirasiAutoIncrement();
            $this->resetAspirasiAutoIncrement();
        }

        $siswa->delete();
        
        // Reset siswa auto increment
        $this->resetSiswaAutoIncrement();

        $message = $aspirasiCount > 0 
            ? "Siswa berhasil dihapus beserta {$aspirasiCount} aspirasi yang terkait."
            : 'Siswa berhasil dihapus';

        return redirect()->route('admin.siswa.index')
                        ->with('success', $message);
    }
}