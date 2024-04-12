<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Merek;
use App\Models\Sewa;
use App\Models\Pengguna;
class PeminjamanController extends Controller
{
    //
    public function index()
    {
        $sewas = Sewa::join('mobil', 'mobil.id', '=', 'sewa.mobil_id')->join('pengguna', 'pengguna.id', '=', 'sewa.pengguna_id')
        ->get(['sewa.*', 'mobil.id as mobilid','mobil.nama_mobil','mobil.nomor_plat','mobil.harga_sewa','pengguna.*']); // Mengambil semua data mobil dari database dengan join ke tabel mereks
        $mobils = Mobil::whereNotIn('id', function ($query) {
            $query->select('mobil_id')->from('sewa');
        })->get();
        $pengguna = Pengguna::all();
        return view('apps.peminjaman.index', compact('sewas','mobils','pengguna'));
    }

    public function create()
    {
        // Tampilkan form untuk membuat manajemen baru
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'tanggal_masuk' => 'required',
            'keterangan' => 'required',
            'mobil_id' => 'required|integer',
            'pengguna_id' => 'required|integer',
        ]);

        // Buat data mobil baru
        $sewamobil = new Sewa();
        $sewamobil->tanggal_masuk = $validatedData['tanggal_masuk'];
        $sewamobil->keterangan = $validatedData['keterangan'];
        $sewamobil->mobil_id = $validatedData['mobil_id'];
        $sewamobil->pengguna_id = $validatedData['pengguna_id'];
        $sewamobil->save();

        // Redirect ke halaman lain atau berikan respons sesuai kebutuhan
        return redirect()->route('peminjaman.index')->with('success', 'Sewa added successfully');
    }

    public function show($id)
    {
        // Tampilkan detail dari sebuah manajemen
    }

    public function edit($id)
    {
        $sewa = Sewa::findOrFail($id);
        
        return view('apps.peminjaman.edit', compact('sewa'));
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $sewa = Sewa::find($id);

        if (!$sewa) {
            return redirect()->route('peminjaman.index')->with('error', 'Data not found.');
        }
    
        $sewa->delete();
    
        return redirect()->route('peminjaman.index')->with('success', 'Data deleted successfully.');
    }
}
