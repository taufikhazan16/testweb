<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;

class AnggotaController extends Controller
{
    //
    public function index()
    {
        $anggota = Pengguna::all();
        return view('apps.anggota.index', compact('anggota'));
    }

    public function create()
    {
        // Tampilkan form untuk membuat manajemen baru
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'nama' => 'required',
            'nomor_telepon' => 'required',
            'nomor_sim' => 'required',
            'alamat' => 'required',
        ]);

        // Buat data mobil baru
        $anggotamobil = new Pengguna();
        $anggotamobil->nama = $validatedData['nama'];
        $anggotamobil->alamat = $validatedData['alamat'];
        $anggotamobil->nomor_telepon = $validatedData['nomor_telepon'];
        $anggotamobil->nomor_sim = $validatedData['nomor_sim'];
        $anggotamobil->save();

        // Redirect ke halaman lain atau berikan respons sesuai kebutuhan
        return redirect()->route('anggota.index')->with('success', 'Pengguna added successfully');
    }

    public function show($id)
    {
        // Tampilkan detail dari sebuah manajemen
    }

    public function edit($id)
    {
        $anggota = Pengguna::findOrFail($id);
        
        return view('apps.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $anggota = Pengguna::find($id);

        if (!$anggota) {
            return redirect()->route('anggota.index')->with('error', 'Data not found.');
        }
    
        $anggota->delete();
    
        return redirect()->route('anggota.index')->with('success', 'Data deleted successfully.');
    }
}
