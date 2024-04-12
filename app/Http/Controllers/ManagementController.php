<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Merek;
// use Intervention\Image\Facades\Image;
class ManagementController extends Controller
{
    //
    public function index()
    {
        $mereks = Merek::all();
        $mobils = Mobil::join('merek', 'mobil.merek_id', '=', 'merek.id')
                    ->get(['mobil.*', 'merek.nama as merek']); // Mengambil semua data mobil dari database dengan join ke tabel mereks
        return view('apps.management.index', compact('mobils','mereks'));
    }

    public function create()
    {
        // Tampilkan form untuk membuat manajemen baru
    }

    public function store(Request $request)
    {
        // dd($request);
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'kapasitas_duduk' => 'required|integer',
            'warna' => 'required|string|max:255',
            'nomor_plat' => 'required|string|max:255',
            'bulan_plat' => 'required|string|max:255',
            'tahun_plat' => 'required|integer',
            'bahan_bakar' => 'required|string|max:255',
            'merek_id' => 'required|integer',
            'model' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric',
            'gambar' => 'required|image|max:2048', // Maksimal 2MB
        ]);

        // Simpan gambar ke dalam storage
        $gambarPath = $request->file('gambar')->store('storage/gambar_mobil');

        // Buat data mobil baru
        $mobil = new Mobil();
        $mobil->nama_mobil = $validatedData['nama_mobil'];
        $mobil->kapasitas_duduk = $validatedData['kapasitas_duduk'];
        $mobil->warna = $validatedData['warna'];
        $mobil->nomor_plat = $validatedData['nomor_plat'];
        $mobil->bulan_plat = $validatedData['bulan_plat'];
        $mobil->tahun_plat = $validatedData['tahun_plat'];
        $mobil->bahan_bakar = $validatedData['bahan_bakar'];
        $mobil->merek_id = $validatedData['merek_id'];
        $mobil->model = $validatedData['model'];
        $mobil->harga_sewa = $validatedData['harga_sewa'];
        $mobil->gambar = $gambarPath;
        $mobil->save();

        // Redirect ke halaman lain atau berikan respons sesuai kebutuhan
        return redirect()->route('management.index')->with('success', 'Car added successfully');
    }

    public function show($id)
    {
        // Tampilkan detail dari sebuah manajemen
    }

    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);
        
        return view('apps.management.edit', compact('mobil'));
    }

    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);

        // Validasi data yang diterima dari form
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'kapasitas_duduk' => 'required|in:4,5,7,9',
            'warna' => 'required|string|max:255',
            'nomor_plat' => 'required|string|max:255',
            'bulan_plat' => 'required|integer|between:1,12',
            'tahun_plat' => 'required|integer|min:1900',
            'bahan_bakar' => 'required|string|max:255',
            'merek_id' => 'required|exists:merek,id',
            'model' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048', // Maksimum 2MB
        ]);

        // Mengupdate data mobil berdasarkan data yang diterima dari form
        $mobil->nama_mobil = $request->nama_mobil;
        $mobil->kapasitas_duduk = $request->kapasitas_duduk;
        $mobil->warna = $request->warna;
        $mobil->nomor_plat = $request->nomor_plat;
        $mobil->bulan_plat = $request->bulan_plat;
        $mobil->tahun_plat = $request->tahun_plat;
        $mobil->bahan_bakar = $request->bahan_bakar;
        $mobil->merek_id = $request->merek_id;
        $mobil->model = $request->model;
        $mobil->harga_sewa = $request->harga_sewa;

        // Jika terdapat gambar yang diunggah, lakukan proses pengolahan gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($mobil->gambar && file_exists(storage_path('app/public/' . $mobil->gambar))) {
                unlink(storage_path('app/public/' . $mobil->gambar));
            }

            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('storage/gambar_mobil');

            // Ubah path gambar untuk menyimpannya di database
            $mobil->gambar = $gambarPath;
        }

        // Simpan perubahan pada data mobil
        $mobil->save();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('management.index')->with('success', 'Car updated successfully');
    }

    public function destroy($id)
    {
        $mobil = Mobil::find($id);

        if (!$mobil) {
            return redirect()->route('management.index')->with('error', 'Car not found.');
        }
    
        $mobil->delete();
    
        return redirect()->route('management.index')->with('success', 'Car deleted successfully.');
    }
}
