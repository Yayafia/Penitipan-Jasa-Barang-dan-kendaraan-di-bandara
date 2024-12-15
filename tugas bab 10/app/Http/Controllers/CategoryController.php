<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.categories', compact('categories'));
    }

    public function create()
    {
        return view('categories.categories-entry');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'gambar' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Upload file gambar
        $gambar = $request->file('gambar');
        $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
        $tujuan_upload = 'img_categories';
        $gambar->move($tujuan_upload, $nama_gambar);

        // Simpan data ke database
        Category::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'gambar' => $nama_gambar,
        ]);

        return redirect('/category')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id_categories)
    {
        $category = Category::findOrFail($id_categories);
        return view('categories.categories-edit', compact('category'));
    }

    public function update(Request $request, $id_categories)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        $category = Category::findOrFail($id_categories);

        // Jika ada file gambar baru, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('gambar')) {
            if (File::exists('img_categories/' . $category->gambar)) {
                File::delete('img_categories/' . $category->gambar);
            }

            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $tujuan_upload = 'img_categories';
            $gambar->move($tujuan_upload, $nama_gambar);
            $category->gambar = $nama_gambar;
        }

        // Update data
        $category->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/category')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function delete($id_categories)
    {
        $category = Category::findOrFail($id_categories);
        return view('categories.categories-hapus', compact('category'));
    }

    public function destroy($id_categories)
    {
        $category = Category::findOrFail($id_categories);

        // Hapus file gambar jika ada
        if (File::exists('img_categories/' . $category->gambar)) {
            File::delete('img_categories/' . $category->gambar);
        }

        $category->delete();
        return redirect('/category')->with('success', 'Kategori berhasil dihapus.');
    }
}
