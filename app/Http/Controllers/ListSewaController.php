<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListSewaController extends Controller
{
    //
    public function index()
    {
        // Tampilkan daftar manajemen
        return view('apps/listsewa/index');
    }

    public function create()
    {
        // Tampilkan form untuk membuat manajemen baru
    }

    public function store(Request $request)
    {
        // Simpan data manajemen yang baru
    }

    public function show($id)
    {
        // Tampilkan detail dari sebuah manajemen
    }

    public function edit($id)
    {
        // Tampilkan form untuk mengedit manajemen
    }

    public function update(Request $request, $id)
    {
        // Simpan perubahan pada sebuah manajemen
    }

    public function destroy($id)
    {
        // Hapus sebuah manajemen
    }
}
