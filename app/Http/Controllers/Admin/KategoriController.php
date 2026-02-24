<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Traits\ResetsAutoIncrement;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    use ResetsAutoIncrement;

    public function index(Request $request)
    {
        $query = Kategori::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('ket_kategori', 'like', "%{$search}%");
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
        
        $kategoris = $query->orderBy('id_kategori', 'asc')->paginate($perPage);
        
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ket_kategori' => 'required|max:30'
        ]);

        Kategori::create($request->all());

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'ket_kategori' => 'required|max:30'
        ]);

        $kategori->update($request->all());

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(Kategori $kategori)
    {
        // Check if kategori has any related aspirasi
        $aspirasiCount = $kategori->inputAspirasis()->count();
        
        if ($aspirasiCount > 0) {
            // Delete all related aspirasi first
            $kategori->inputAspirasis()->delete();
            
            // Delete related aspirasi status
            $kategori->aspirasis()->delete();
            
            // Reset auto increments
            $this->resetInputAspirasiAutoIncrement();
            $this->resetAspirasiAutoIncrement();
        }
        
        $kategori->delete();
        
        // Reset kategori auto increment
        $this->resetKategoriAutoIncrement();

        $message = $aspirasiCount > 0 
            ? "Kategori berhasil dihapus beserta {$aspirasiCount} aspirasi yang terkait."
            : 'Kategori berhasil dihapus';

        return redirect()->route('admin.kategori.index')
                        ->with('success', $message);
    }
}