<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Merek;
use App\Models\Sewa;
use App\Models\Pengguna;
use DateTime; // Import kelas DateTime

class PengembalianController extends Controller
{
    //
    public function index()
    {
        $sewas = Sewa::join('mobil', 'mobil.id', '=', 'sewa.mobil_id')->join('pengguna', 'pengguna.id', '=', 'sewa.pengguna_id')
            ->get(['sewa.*','sewa.id as id', 'mobil.id as mobilid', 'mobil.nama_mobil', 'mobil.nomor_plat', 'mobil.harga_sewa', 'pengguna.nama','pengguna.nomor_telepon','pengguna.alamat','pengguna.nomor_sim']); // Mengambil semua data mobil dari database dengan join ke tabel mereks
        $mobils = Mobil::whereNotIn('id', function ($query) {
            $query->select('mobil_id')->from('sewa');
        })->get();
        $pengguna = Pengguna::all();
        return view('apps.pengembalian.index', compact('sewas', 'mobils', 'pengguna'));
    }

    public function create()
    {
        // Tampilkan form untuk membuat manajemen baru
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        // dd($id);
        $sewaToUpdate = Sewa::join('mobil', 'mobil.id', '=', 'sewa.mobil_id')
            ->join('pengguna', 'pengguna.id', '=', 'sewa.pengguna_id')
            ->where('sewa.id', $id)
            ->select('sewa.*', 'mobil.id as mobilid', 'mobil.nama_mobil', 'mobil.nomor_plat', 'mobil.harga_sewa', 'pengguna.*')
            ->firstOrFail();

        // Hitung jumlah hari sewa
        $tanggalMasuk = new DateTime($sewaToUpdate->tanggal_masuk);
        $tanggalSelesai = new DateTime($sewaToUpdate->tanggal_selesai);
        $selisihHari = $tanggalMasuk->diff($tanggalSelesai)->days;

        // Kalkulasi total biaya sewa
        $mobil = Mobil::findOrFail($sewaToUpdate->mobilid);
        $totalBiayaSewa = $selisihHari * $mobil->harga_sewa;

        // Tetapkan total biaya ke dalam model Sewa
        $sewaToUpdate->biaya_sewa = $totalBiayaSewa;
        $sewaToUpdate->status_sewa = 'selesai';
        $sewaToUpdate->save();

        // Redirect ke halaman lain atau berikan respons sesuai kebutuhan
        return redirect()->route('peminjaman.index')->with('success', 'Sewa updated successfully');
    }

    public function destroy($id)
    {
    }
}
