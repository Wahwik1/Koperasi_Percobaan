<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pesan1;
use App\Models\Tabungan;
use App\Models\Pembayaran1;
use App\Models\Pembayaran2;
use App\Models\PembayaranTabungan;
use App\Models\Peminjaman1;
use App\Models\Peminjaman2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    // Admin
    function adminDashboard() {
        $existingIds = User::pluck('id')->toArray(); // Ambil semua ID jadi array
        sort($existingIds); // Urutkan ID
    
        // Cari ID kosong
        $nextId = 1;
        foreach ($existingIds as $id) {
            if ($id != $nextId) break;
            $nextId++;
        }
    
        return view('admin.dashboard', [
            'judul' => 'Daftar Anggota',
            'css' => '../css/pendaftaran_admin.css',
            'check' => Pesan1::exists(),
            'nextId' => $nextId
        ]);
    }

    public function cekDuplikat(Request $request)
    {
        $emailExists = User::where('email', $request->email)->exists();
        $namaExists = User::where('name', $request->name)->exists();
        $nikExists = User::where('nik', $request->nik)->exists();
    
        return response()->json([
            'email' => $emailExists,
            'name' => $namaExists,
            'nik' => $nikExists,
        ]);
    }

    // Daftar Anggota
    function daftarAnggota(Request $request){
        // Cek apakah ID sudah digunakan
        $existingId = User::where('id', $request->id)->first();
        if ($existingId) {
            return redirect()->back()->with('failed', 'Nomor telah digunakan');
        }

        // Cek apakah email sudah digunakan
        $existingEmail = User::where('email', $request->email)->first();
        if ($existingEmail) {
            return redirect()->back()->with('failed', 'Email telah digunakan');
        }

        // Cek apakah NIK sudah digunakan
        $existingNik = User::where('nik', $request->nik)->first();
        if ($existingNik) {
            return redirect()->back()->with('failed', 'NIK telah digunakan');
        }

        // Jika semua valid, simpan user baru
        $user = new User();
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->jeniskelamin = $request->jeniskelamin;
        $user->nik = $request->nik;
        $user->ttl = $request->ttl;
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }

    function tabelAnggota(){
        return view('admin.tabel_anggota', [
            'judul' => 'Tabel Anggota',
            'css' => '../css/tabel_anggota_admin.css',
            'posts' => User::all(),
            'check' => Pesan1::exists()
        ]);
    }

// Update Anggota
    function editAnggota(Request $request){
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->ttl = $request->ttl;
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        $user->password = Hash::make($request->password);
    }

    function updateAnggota(Request $request){
        $user = User::find($request->id);

        // Cek apakah email sudah dipakai oleh user lain
        $emailExists = User::where('email', $request->email)
                        ->where('id', '!=', $request->id) // bukan user yang sedang diedit
                        ->exists();

        if ($emailExists) {
            return redirect()->back()->with('failed', 'Email telah digunakan oleh user lain!');
        }

        $nameExists = User::where('name', $request->name)
                        ->where('id', '!=', $request->id) // bukan user yang sedang diedit
                        ->exists();

        if ($nameExists) {
            return redirect()->back()->with('failed', 'Nama telah digunakan oleh user lain!');
        }

        $nikExists = User::where('nik', $request->nik)
                        ->where('id', '!=', $request->id) // bukan user yang sedang diedit
                        ->exists();

        if ($nikExists) {
            return redirect()->back()->with('failed', 'NIK telah digunakan oleh user lain!');
        }
        
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->ttl = $request->ttl;
        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success-update', 'Berhasil Di Ubah');
    }

// ====================================================================================================================================================================

// Delete Data
function deleteAnggota($id){
    $user = User::find($id);

    if ($user) {
        $user->peminjaman1()->delete();
        $user->peminjaman2()->delete();
        $user->delete();
    }

    return redirect()->back()->with('success-delete', 'Data berhasil dihapus beserta pinjamannya.');
}


// ===========================================================================================================================================================

    // Peminjaman
    function peminjaman(Request $request){
        $user = Auth::user();
        return view('admin.pinjaman', [
            'judul' => 'Admin Peminjaman',
            'css' => '../css/pinjaman_admin.css',
            'js' => '../js/script_pinjaman_admin.js',
            'posts' => User::find($request->id),
            'check' => Pesan1::exists()
        ]);
    }

//Search
    public function search(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $pinjaman1 = Peminjaman1::where('pinjaman_id', $request->pinjaman_id)->latest()->first();
        $pinjaman2 = Peminjaman2::where('pinjaman_id', $request->pinjaman_id)->latest()->first();

        if ($user) {
            return response()->json([
                'id' => $user->id,
                'nama' => $user->name,
                'telepon' => $user->nohp,
                'ttl' => $user->ttl,
                'alamat' => $user->alamat,
                'ttotalpeminjaman1' => $pinjaman1 ? $pinjaman1->ttotalpeminjaman1 : 0,
                'ttotalpeminjaman2' => $pinjaman2 ? $pinjaman2->ttotalpeminjaman2 : 0
            ]);
        } else {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }
    }

// Admin-Pinjaman
public function adminPinjaman1(Request $request){
    $validated = $request->validate([
        'pinjaman_id' => 'required|exists:users,id',
        'ttotalpeminjaman1' => 'required|numeric',
        'tpembayaran1' => 'required|integer',
        'tbunga1' => 'required|numeric',
        'ttotalpokok1' => 'required|numeric',
        'ttotalbunga1' => 'required|numeric',
        'ttotalpembayaran1' => 'required|numeric',
        'tanggal_pembayaran' => 'required|date',
        'deskripsi1' => 'nullable|string'
    ]);

    // Hapus pinjaman lama (jika ada yang belum punya tpembayaran1)
    Peminjaman1::where('pinjaman_id', $request->pinjaman_id)
        ->where('tpembayaran1', 0)
        ->delete();

    $validated['tpembayaran1'] = 0;   

    // 👇 Tambahkan field pokok1 ke array validated
    $validated['pokok1'] = $validated['ttotalpeminjaman1'];
    $validated['bunga_sebelumnya'] = $validated['ttotalbunga1'];

    // Simpan data
    Peminjaman1::create($validated);

    return redirect()->back()->with('success-pinjaman', 'Data pinjaman berhasil disimpan.');
}
    public function adminPinjaman2(Request $request){
        $validated = $request->validate([
            'pinjaman_id' => 'required|exists:users,id',
            'ttotalpeminjaman2' => 'required|numeric',
            'tpembayaran2' => 'required|integer',
            'tbunga2' => 'required|numeric',
            'ttotalpokok2' => 'required|numeric',
            'ttotalbunga2' => 'required|numeric',
            'ttotalpembayaran2' => 'required|numeric',
            'deskripsi2' => 'nullable|string',
        ]);

        Peminjaman2::where('pinjaman_id', $request->pinjaman_id)
        ->where('tpembayaran2', 0)
        ->delete();
        $validated['tpembayaran2'] = 0;   
            // 👇 Tambahkan field pokok1 ke array validated
        $validated['pokok2'] = $validated['ttotalpeminjaman2'];
        $validated['bunga_sebelumnya2'] = $validated['ttotalbunga2'];

        Peminjaman2::create($validated);

        return redirect()->back()->with('success-pinjaman', 'Data pinjaman berhasil disimpan.');
    }

// ============================================================================================================================================================

    // Overbook
    function overbook(Request $request){
        return view('admin.overbook', [
            'judul' => 'Admin Overbook',
            'css' => '../css/overbook_admin.css',
            'posts' => User::find($request->id),
            'check' => Pesan1::exists()
        ]);
    }

    //Search Overbook
    public function search_overbook(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $pinjaman1 = Peminjaman1::where('pinjaman_id', $request->pinjaman_id)->latest()->first();
        $pinjaman2 = Peminjaman2::where('pinjaman_id', $request->pinjaman_id)->latest()->first();
    
        if ($user) {
            return response()->json([
                'id' => $user->id,
                'nama_overbook' => $user->name,
                'telepon_overbook' => $user->nohp,
                'ttl_overbook' => $user->ttl,
                'alamat_overbook' => $user->alamat,
                'tpokok1' => $pinjaman1 ? $pinjaman1->pokok1 : 0,
                'tpokok2' => $pinjaman2 ? $pinjaman2->pokok2 : 0,
            ]);
        } else {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }
    }

    public function adminOverbook1(Request $request){
        $validated = $request->validate([
            'pinjaman_id' => 'required|exists:users,id',
            'ttotalpeminjaman1' => 'required|numeric',
            'tpembayaran1' => 'required|integer',
            'tbunga1' => 'required|numeric',
            'ttotalpokok1' => 'required|numeric',
            'ttotalbunga1' => 'required|numeric',
            'ttotalpembayaran1' => 'required|numeric',
            'deskripsi1' => 'nullable|string',
        ]);
    
        // Hapus data lama berdasarkan pinjaman_id
        Peminjaman1::where('pinjaman_id', $validated['pinjaman_id'])->delete();
        // Simpan data baru
        Peminjaman1::create([
            'pinjaman_id' => $validated['pinjaman_id'],
            'ttotalpeminjaman1' => $validated['ttotalpeminjaman1'],
            'pokok1' => $validated['ttotalpeminjaman1'],
            'tpembayaran1' => $validated['tpembayaran1'],
            'tbunga1' => $validated['tbunga1'],
            'ttotalpokok1' => $validated['ttotalpokok1'],
            'ttotalbunga1' => $validated['ttotalbunga1'],
            'ttotalpembayaran1' => $validated['ttotalpembayaran1'],
            'deskripsi1' => $validated['deskripsi1'],
        ]);

        return redirect()->back()->with('success-overbook', 'Data pinjaman berhasil disimpan.');
    }
    public function adminOverbook2(Request $request){
        $validated = $request->validate([
            'pinjaman_id' => 'required|exists:users,id',
            'ttotalpeminjaman2' => 'required|numeric',
            'tpembayaran2' => 'required|integer',
            'tbunga2' => 'required|numeric',
            'ttotalpokok2' => 'required|numeric',
            'ttotalbunga2' => 'required|numeric',
            'ttotalpembayaran2' => 'required|numeric',
            'deskripsi2' => 'nullable|string',
        ]);
    
        // Hapus data lama berdasarkan pinjaman_id
        Peminjaman2::where('pinjaman_id', $validated['pinjaman_id'])->delete();
        // Simpan data baru
        Peminjaman2::create([
            'pinjaman_id' => $validated['pinjaman_id'],
            'ttotalpeminjaman2' => $validated['ttotalpeminjaman2'],
            'tpembayaran2' => $validated['tpembayaran2'],
            'tbunga2' => $validated['tbunga2'],
            'ttotalpokok2' => $validated['ttotalpokok2'],
            'ttotalbunga2' => $validated['ttotalbunga2'],
            'ttotalpembayaran2' => $validated['ttotalpembayaran2'],
            'deskripsi2' => $validated['deskripsi2'],
        ]);

        return redirect()->back()->with('success-overbook', 'Data pinjaman berhasil disimpan.');
    }

// =============================================================================================================================================

    // Tabungan
    public function penarikantabungan(){
        return view('admin.penarikan_tabungan', [
            'judul' => 'Admin Penarikan Tabungan',
            'css' => '../css/penarikan_tabungan_admin.css',
            'check' => Pesan1::exists()
        ]);
    }

    public function adminTabungan(Request $request){
        $validated = $request->validate([
            'tabungan_id' => 'required|exists:users,id', // atau ganti sesuai dengan relasi tabelmu
            'tabungan' => 'required|numeric'
        ]);
        
        Tabungan::create($validated);
    
        return redirect()->back()->with('success-tabungan', 'Data pinjaman berhasil disimpan.');
    }

    public function search_tabungan(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $tabungan = Tabungan::where('tabungan_id', $request->id)
        ->latest('updated_at')
        ->first();
    
        if ($user) {
            return response()->json([
                'id' => $user->id,
                'nama_tabungan' => $user->name,
                'telepon_tabungan' => $user->nohp,
                'ttl_tabungan' => $user->ttl,
                'alamat_tabungan' => $user->alamat,
                'tabungan' => $tabungan ? $tabungan->tabungan : 0,
            ]);
        } else {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }
    }

// ======================================================================================================================================
    
    // Cicilan
    public function cicilan(Request $request)
    {
        // $lastStart = Cache::get('last_start_time');
        // $cooldownUntil = $lastStart ? $lastStart->addMinutes(2) : null;

        $lastResetMonth = Cache::get('last_reset_bunga_month'); // format: Y-m
        $currentMonth = now()->format('Y-m');

        $isResetDisabled = $lastResetMonth === $currentMonth;

        // Hitung tanggal aktif kembali (1 bulan setelah reset terakhir)
        $nextAvailableDate = null;
        if ($isResetDisabled && $lastResetMonth) {
            $nextAvailableDate = \Carbon\Carbon::createFromFormat('Y-m', $lastResetMonth)->addMonth()->startOfMonth();
        }

    
        return view('admin.cicilan', [
            'judul' => 'Admin Pembayaran Cicilan',
            'css' => '../css/cicilan_admin.css',
            'pinjaman' => Peminjaman1::find($request->pinjaman_id),
            'pinjaman2' => Peminjaman2::find($request->pinjaman_id),
            // 'cooldownUntil' => $cooldownUntil,
            'check' => Pesan1::exists(),
            'isResetDisabled' => $isResetDisabled,
            'nextAvailableDate' => $nextAvailableDate ? $nextAvailableDate->format('Y-m-d') : null
        ]);
    }


    // Pembayaran Cicilan Tabungan
    public function search_cicilan(Request $request){
        $user = User::where('id', $request->id)->first();
        $tabungan = Tabungan::where('tabungan_id', $request->id)
        ->latest('updated_at')
        ->first();
        $pinjaman1 = Peminjaman1::where('pinjaman_id', $request->id)
        ->latest()
        ->first();
        $pinjaman2 = Peminjaman2::where('pinjaman_id', $request->id)
        ->latest()
        ->first();
    
        if ($user) {
            return response()->json([
                'id' => $user->id,
                'nama_cicilan' => $user->name,
                'telepon_cicilan' => $user->nohp,
                'ttl_cicilan' => $user->ttl,
                'alamat_cicilan' => $user->alamat,
                
                'ttotalpeminjaman1_cicilan' => $pinjaman1 ? $pinjaman1->ttotalpeminjaman1 : 0,
                'tpembayaran1_cicilan' => $pinjaman1 ? $pinjaman1->tpembayaran1 : 0,
                'ttotalpokok1_cicilan' => $pinjaman1 ? $pinjaman1->ttotalpokok1 : 0,
                'ttotalbunga1_cicilan' => $pinjaman1 ? $pinjaman1->ttotalbunga1 : 0,
                'pokok1_cicilan' => $pinjaman1 ? $pinjaman1->pokok1 : 0,
                'denda_cicilan' => $pinjaman1 ? $pinjaman1->denda : 0,

                'ttotalpeminjaman2_cicilan' => $pinjaman2 ? $pinjaman2->ttotalpeminjaman2 : 0,
                'tpembayaran2_cicilan' => $pinjaman2 ? $pinjaman2->tpembayaran2 : 0,
                'ttotalpokok2_cicilan' => $pinjaman2 ? $pinjaman2->ttotalpokok2 : 0,
                'ttotalbunga2_cicilan' => $pinjaman2 ? $pinjaman2->ttotalbunga2 : 0,
                'pokok2_cicilan' => $pinjaman2 ? $pinjaman2->pokok2 : 0,
                'denda2_cicilan' => $pinjaman2 ? $pinjaman2->denda2 : 0,

                'tabungan_cicilan' => $tabungan ? $tabungan->tabungan : 0
            ]);
        } else {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }
    }

    public function adminCicilanTabungan(Request $request){
        $validated = $request->validate([
            'tabungan_id' => 'required|exists:users,id', // atau ganti sesuai dengan relasi tabelmu
            'pembayarantabungan' => 'required|numeric',
            'tabungansebelumnya' => 'required|numeric',
            'tabungan' => 'required|numeric',
            'jenis1' => 'nullable|string'
        ]);
        
        Tabungan::updateOrCreate(
            ['tabungan_id' => $validated['tabungan_id']], // kondisi pencarian
            ['tabungan' => $validated['tabungan']]        // data yang akan diupdate/insert
        );

        PembayaranTabungan::create([
            'pembayarantabungan_id' => $validated['tabungan_id'],
            'pembayarantabungan' => $validated['pembayarantabungan'],
            'tabungansebelumnya' => $validated['tabungansebelumnya'],
            'sisatabungan' => $validated['tabungan'],
            'jenis1' => $validated['jenis1']
        ]);

        return redirect()->back()->with('success-tabungan', 'Data pinjaman berhasil disimpan.');
    }

    public function prosesPembayaran(Request $request)
    {
        $validated = $request->validate([
            'pinjaman_id' => 'required|exists:users,id',
            'jumlah_bayar' => 'required|string',
            'tpembayaran1' => 'required|integer',
            'denda' => 'required|numeric',
            'pokok_dibayar' => 'required|numeric',
            'bunga_dibayar' => 'required|numeric',
            'ttotalpeminjaman1' => 'required|numeric',
            'pokok1' => 'required|numeric',
            'jenis1' =>'string|nullable'
        ]);
    
        $lastPeminjaman = Peminjaman1::where('pinjaman_id', $validated['pinjaman_id'])->latest()->first();
        
        // $dendaDibayar = $validated['denda'];
        // if ($lastPeminjaman) {
        //     $jumlahBayar = (int) str_replace(['Rp', '.', ' '], '', $validated['jumlah_bayar']);
        //     $pokokDibayar = (int) str_replace(['Rp', '.', ' '], '', $request->pokok_dibayar);
            
        //     $bungaSebelumnya = $lastPeminjaman->ttotalbunga1;
        //     $sisaPokok = ($lastPeminjaman->pokok1 ?? 0) - $pokokDibayar;
        //     $sisaPembayaran = $validated['tpembayaran1'] + 1;

        //     // Update datanya
        //     $lastPeminjaman->pokok1 = $sisaPokok;
        //     $lastPeminjaman->tpembayaran1 = $sisaPembayaran;
        //     $lastPeminjaman->ttotalbunga1 = 0;
        //     $lastPeminjaman->bunga_sebelumnya = $bungaSebelumnya;
        //     $lastPeminjaman->tbunga1 = 0.5;
        //     $lastPeminjaman->denda = 0;
        //     $lastPeminjaman->status_denda = false;
        //     $lastPeminjaman->status_lunas = ($sisaPembayaran <= 0);

        //     $lastPeminjaman->save(); // atau ->update() kalau kamu ingin langsung sekaligus
        // }

        $jumlahBayar = (int) str_replace(['Rp', '.', ' '], '', $validated['jumlah_bayar']);
        $pokokDibayar = (int) str_replace(['Rp', '.', ' '], '', $request->pokok_dibayar);
    
        $bungaSebelumnya = $lastPeminjaman->ttotalbunga1;
        $sisaPokok = ($lastPeminjaman->pokok1 ?? 0) - $pokokDibayar;
        $sisaPembayaran = $validated['tpembayaran1'] + 1;
        $dendaDibayar = $validated['denda'];
    
        
        $data = new Peminjaman1();
        $data->pinjaman_id = $validated['pinjaman_id'];
        $data->pokok1 = $sisaPokok;
        $data->tpembayaran1 = $sisaPembayaran;
        $data->ttotalbunga1 = 0;
        $data->bunga_sebelumnya = $bungaSebelumnya;
        $data->ttotalpeminjaman1 = $lastPeminjaman->ttotalpeminjaman1 ?? 0;
        $data->ttotalpokok1 = $lastPeminjaman->ttotalpokok1 ?? 0;
        $data->ttotalpembayaran1 = $lastPeminjaman->ttotalpembayaran1 ?? 0;
        $data->tbunga1 = 0.5;
        $data->denda = 0;
        $data->status_denda = false;
        $data->status_lunas = ($sisaPembayaran <= 0);
        $data->save();
        
        $datapem1 = new Pembayaran1();
        $datapem1->pembayaran_id = $validated['pinjaman_id'];
        $datapem1->pokok1 = $sisaPokok;
        $datapem1->jenis1 = $validated['jenis1'];
        $datapem1->bunga_dibayar = $validated['bunga_dibayar'];
        $datapem1->pokok_dibayar = $validated['pokok_dibayar'];
        $datapem1->denda_dibayar = $dendaDibayar;
        $datapem1->jumlah_pembayaran = $jumlahBayar;
        $datapem1->save();
        
        if($sisaPokok == 0){
            Peminjaman1::where('pinjaman_id', $validated['pinjaman_id'])->delete();
        }
        
        return redirect()->back()->with('success-pinjaman', 'Pembayaran berhasil dilakukan.');
    }
    public function prosesPembayaran2(Request $request)
    {
        $validated = $request->validate([
            'pinjaman_id' => 'required|exists:users,id',
            'jumlah_bayar2' => 'required|string',
            'tpembayaran2' => 'required|integer',
            'denda2' => 'required|numeric',
            'pokok_dibayar2' => 'required|numeric',
            'bunga_dibayar2' => 'required|numeric',
            'ttotalpeminjaman2' => 'required|numeric',
            'pokok2' => 'required|numeric',
            'jenis2' =>'string|nullable'
        ]);
    
        $lastPeminjaman = Peminjaman2::where('pinjaman_id', $validated['pinjaman_id'])->latest()->first();
    
        $jumlahBayar = (int) str_replace(['Rp', '.', ' '], '', $validated['jumlah_bayar2']);
        $pokokDibayar = (int) str_replace(['Rp', '.', ' '], '', $request->pokok_dibayar2);
    
        $bungaSebelumnya = $lastPeminjaman->ttotalbunga2;
        $sisaPokok = ($lastPeminjaman->pokok2 ?? 0) - $pokokDibayar;
        $sisaPembayaran = $validated['tpembayaran2'] - 0;
        $dendaDibayar = $validated['denda2'];
    
        
        $data = new Peminjaman2();
        $data->pinjaman_id = $validated['pinjaman_id'];
        $data->pokok2 = $sisaPokok;
        $data->tpembayaran2 = $sisaPembayaran;
        $data->ttotalbunga2 = 0;
        $data->bunga_sebelumnya2 = $bungaSebelumnya;
        $data->ttotalpeminjaman2 = $lastPeminjaman->ttotalpeminjaman2 ?? 0;
        $data->ttotalpokok2 = $lastPeminjaman->ttotalpokok2 ?? 0;
        $data->ttotalpembayaran2 = $lastPeminjaman->ttotalpembayaran2 ?? 0;
        $data->tbunga2 = 0.5;
        $data->denda2 = 0;
        $data->status_denda2 = false;
        $data->status_lunas2 = ($sisaPembayaran <= 0);
        $data->save();
        
        $datapem2 = new Pembayaran2();
        $datapem2->pembayaran_id = $validated['pinjaman_id'];
        $datapem2->pokok2 = $sisaPokok;
        $datapem2->jenis2 = $validated['jenis2'];
        $datapem2->bunga_dibayar2 = $validated['bunga_dibayar2'];
        $datapem2->pokok_dibayar2 = $validated['pokok_dibayar2'];
        $datapem2->denda_dibayar2 = $dendaDibayar;
        $datapem2->jumlah_pembayaran2 = $jumlahBayar;
        $datapem2->save();
        
        if($sisaPokok == 0){
            Peminjaman2::where('pinjaman_id', $validated['pinjaman_id'])->delete();
        }
        
        return redirect()->back()->with('success-pinjaman', 'Pembayaran berhasil dilakukan.');
    }

    public function resetBunga()
    {
        // Mengambil pinjaman terakhir untuk setiap user di Peminjaman1
        $lastPinjamanPerUser = Peminjaman1::select('pinjaman_id', DB::raw('MAX(id) as max_id'))
            ->groupBy('pinjaman_id')
            ->pluck('max_id');
            
            
            // Mengambil data pinjaman terbaru di Peminjaman1 berdasarkan ID yang sudah diambil
            $pinjamans = Peminjaman1::whereIn('id', $lastPinjamanPerUser)->get();
        
        foreach ($pinjamans as $pinjaman) {

            if ($pinjaman->ttotalbunga1 == 0) {
                // Reset bunga ke nilai default hanya jika tidak ada bunga saat ini
                $pinjaman->ttotalbunga1 = $pinjaman->bunga_sebelumnya ?: 0;
                $pinjaman->status_denda = false;

            } else {
                // Menambahkan denda jika bunga sudah ada
                $pinjaman->denda += $pinjaman->ttotalbunga1;
                $pinjaman->status_denda = true;
            }
            
            $pinjaman->save();
        }
        
        // Mengambil pinjaman terakhir untuk setiap user di Peminjaman1
        $lastPinjamanPerUser2 = Peminjaman2::select('pinjaman_id', DB::raw('MAX(id) as max_id'))
            ->groupBy('pinjaman_id')
            ->pluck('max_id');
            
            
            // Mengambil data pinjaman terbaru di Peminjaman1 berdasarkan ID yang sudah diambil
            $pinjamans2 = Peminjaman2::whereIn('id', $lastPinjamanPerUser2)->get();
        
        foreach ($pinjamans2 as $pinjaman) {

            if ($pinjaman->ttotalbunga2 == 0) {
                // Reset bunga ke nilai default hanya jika tidak ada bunga saat ini
                
                $pinjaman->tpembayaran2 = $pinjaman->tpembayaran2 - 1;
                $pinjaman->ttotalbunga2 = $pinjaman->bunga_sebelumnya2 ?: 0;
                $pinjaman->status_denda2 = false;

            } else {
                // Menambahkan denda jika bunga sudah ada
                $pinjaman->denda2 += $pinjaman->ttotalbunga2;
                $pinjaman->status_denda2 = true;
            }
            
            $pinjaman->save();
        }
    
        // // Menyimpan waktu sekarang di cache
        // Cache::put('last_start_time', now(), now()->addMinutes(2));
        
        // Simpan bulan terakhir kali tombol ditekan
        Cache::put('last_reset_bunga_month', now()->format('Y-m'));
    
        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Reset bunga berhasil!');
    }

    public function riwayatPembayaran($pinjaman_id)
{
    $riwayat = Peminjaman1::where('pinjaman_id', $pinjaman_id)
        ->where('jumlah_pembayaran', '>', 0)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('riwayat-pembayaran', compact('riwayat'));
}

    public function Edit(Request $request){
        return view('admin.edit', [
            'judul' => 'Admin Edit',
            'css' => '../css/edit_admin.css',
            'pinjaman' => Peminjaman1::find($request->pinjaman_id),
            'pinjaman2' => Peminjaman2::find($request->pinjaman_id),
            'check' => Pesan1::exists()
        ]);
    }

    public function search_edit(Request $request){
        $user = User::where('id', $request->id)->first();

        // Ambil tanggal dari request
        $tanggal = $request->tanggal;
    
        // Cari pinjaman berdasarkan id dan tanggal
        $pinjaman1 = Peminjaman1::where('pinjaman_id', $request->id);
        $pinjaman2 = Peminjaman2::where('pinjaman_id', $request->id);
        $tabungan = Tabungan::where('tabungan_id', $request->id);
        
        if ($tanggal) {
            $pinjaman1 = $pinjaman1->whereDate('created_at', $tanggal);
            $pinjaman2 = $pinjaman2->whereDate('created_at', $tanggal);
            $tabungan = $tabungan->whereDate('created_at', $tanggal);
        }
        
        $pinjaman1 = $pinjaman1->latest()->first();
        $pinjaman2 = $pinjaman2->latest()->first();
        $tabungan = $tabungan->latest()->first();
    
        if ($user) {
            return response()->json([
                'id' => $user->id,
                'nama_edit' => $user->name,
                'telepon_edit' => $user->nohp,
                'ttl_edit' => $user->ttl,
                'alamat_edit' => $user->alamat,
                
                'ttotalpeminjaman1_edit' => $pinjaman1 ? $pinjaman1->ttotalpeminjaman1 : 0,
                'tpembayaran1_edit' => $pinjaman1 ? $pinjaman1->tpembayaran1 : 0,
                'ttotalpokok1_edit' => $pinjaman1 ? $pinjaman1->ttotalpokok1 : 0,
                'ttotalbunga1_edit' => $pinjaman1 ? $pinjaman1->ttotalbunga1 : 0,
                'pokok1_edit' => $pinjaman1 ? $pinjaman1->pokok1 : 0,
                'denda_edit' => $pinjaman1 ? $pinjaman1->denda : 0,
                'jumlah_pembayaran' => $pinjaman1 ? $pinjaman1->jumlah_pembayaran : 0,

                'ttotalpeminjaman2_edit' => $pinjaman2 ? $pinjaman2->ttotalpeminjaman2 : 0,
                'tpembayaran2_edit' => $pinjaman2 ? $pinjaman2->tpembayaran2 : 0,
                'ttotalpokok2_edit' => $pinjaman2 ? $pinjaman2->ttotalpokok2 : 0,
                'ttotalbunga2_edit' => $pinjaman2 ? $pinjaman2->ttotalbunga2 : 0,
                'pokok2_edit' => $pinjaman2 ? $pinjaman2->pokok2 : 0,
                'denda2_edit' => $pinjaman2 ? $pinjaman2->denda2 : 0,
                'jumlah_pembayaran2' => $pinjaman2 ? $pinjaman2->jumlah_pembayaran2 : 0,

                'tabungan_edit' => $tabungan? $tabungan->tabungan : 0,
            ]);
        } else {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }
    }

    public function updateByDateTabungan(Request $request)
    {
    $request->validate([
        'tabungan_id' => 'required|exists:tabungans,tabungan_id',
        'tanggal' => 'required|date',
        'tabungan' => 'required|numeric'
    ]);

    $tabungan = Tabungan::where('tabungan_id', $request->tabungan_id)
        ->whereDate('created_at', $request->tanggal)
        ->latest('updated_at')
        ->first();

    if (!$tabungan) {
        return back()->withErrors(['msg' => 'Data pinjaman tidak ditemukan untuk tanggal tersebut.']);
    }

    $tabungan->update([
        'tabungan' => $request->tabungan
    ]);

    return back()->with('success-edit', 'Data berhasil diupdate.');
    }

    public function updateByDate(Request $request)
    {
    $request->validate([
        'pinjaman_id' => 'required|exists:peminjaman1s,pinjaman_id',
        'tanggal' => 'required|date',
        'pokok_dibayar' => 'required|numeric',
        'ttotalbunga1' => 'required|numeric',
        'pokok1' => 'required|numeric',
        'ttotalpeminjaman1' => 'required|numeric',
        'tpembayaran1' => 'required|numeric',
        'ttotalpokok1' => 'required|numeric',
        'denda' => 'required|numeric',
        'jumlah_bayar' => 'required|numeric', // perbaikan di sini
    ]);

    $pinjaman = Peminjaman1::where('pinjaman_id', $request->pinjaman_id)
        ->whereDate('created_at', $request->tanggal)
        ->latest('updated_at')
        ->first();

    if (!$pinjaman) {
        return back()->withErrors(['msg' => 'Data pinjaman tidak ditemukan untuk tanggal tersebut.']);
    }

    $pinjaman->update([
        'pokok_dibayar' => $request->pokok_dibayar,
        'ttotalbunga1' => $request->ttotalbunga1,
        'pokok1' => $request->pokok1, 
        'ttotalpeminjaman1' => $request->ttotalpeminjaman1, 
        'tpembayaran1' => $request->tpembayaran1, 
        'ttotalpokok1' => $request->ttotalpokok1, 
        'denda' => $request->denda, 
        'jumlah_bayar' => $request->jumlah_pembayaran, // fix penamaan
    ]);

    return back()->with('success-edit', 'Data berhasil diupdate.');
    }
    public function updateByDate2(Request $request)
    {
    $request->validate([
        'pinjaman_id' => 'required|exists:peminjaman2s,pinjaman_id',
        'tanggal' => 'required|date',
        'pokok_dibayar2' => 'required|numeric',
        'ttotalbunga2' => 'required|numeric',
        'pokok2_edit' => 'required|numeric',
        'ttotalpeminjaman2' => 'required|numeric',
        'tpembayaran2' => 'required|numeric',
        'ttotalpokok2' => 'required|numeric',
        'denda2' => 'required|numeric',
        'jumlah_bayar2' => 'required|numeric', // perbaikan di sini
    ]);

    $pinjaman2 = Peminjaman2::where('pinjaman_id', $request->pinjaman_id)
        ->whereDate('created_at', $request->tanggal)
        ->latest('updated_at')
        ->first();

    if (!$pinjaman2) {
        return back()->withErrors(['msg' => 'Data pinjaman tidak ditemukan untuk tanggal tersebut.']);
    }

    $pinjaman2->update([
        'pokok_dibayar2' => $request->pokok_dibayar2,
        'ttotalbunga2' => $request->ttotalbunga2,
        'pokok2_edit' => $request->pokok2, 
        'ttotalpeminjaman2' => $request->ttotalpeminjaman2, 
        'tpembayaran2' => $request->tpembayaran2, 
        'ttotalpokok2' => $request->ttotalpokok2, 
        'denda2' => $request->denda2, 
        'jumlah_bayar2' => $request->jumlah_pembayaran2, // fix penamaan
    ]);

    return back()->with('success-edit', 'Data berhasil diupdate.');
    }

// Pesan
    function Pesan(){
        $user = Auth::user();

        $pesan1 = Pesan1::where('jenis1', 'Pinjaman Pertama')
                ->where('pesan_id', $user->id)
                ->latest()
                ->first();

        $tabungan = DB::table('pesan1s')
                ->where('jenis1', 'Penarikan Tabungan')
                ->where('pesan_id', $user->id)
                ->first();

        $posts = Pesan1::with('pesan1')->get()->map(function($post) {
            $pinjaman1Ada = Peminjaman1::where('pinjaman_id', $post->pesan_id)->exists();
            $pinjaman2Ada = Peminjaman2::where('pinjaman_id', $post->pesan_id)->exists();
    
            // Tandai sesuai jenis
            if ($post->jenis1 === 'Pinjaman 1') {
                $post->sudah_punya_peminjaman = $pinjaman1Ada;
            } elseif ($post->jenis1 === 'Pinjaman 2') {
                $post->sudah_punya_peminjaman = $pinjaman2Ada;
            } else {
                $post->sudah_punya_peminjaman = false;
            }
    
            return $post;
        });

        return view('admin.pesan', [
            'judul' => 'Pesan Anggota',
            'css' => '../css/tabel_anggota_admin.css',
            'posts' => $posts,
            'check' => Pesan1::exists(),
            'pesan1' => $pesan1,
            'tabungan' => $tabungan,
        ]);
    }

    function adminPesanPeminjaman1(Request $request){
        $pesan = Pesan1::find($request->pesan_id);
        $pesan->jenis = $request->jenis;
        $pesan->ttotalpeminjaman1 = $request->ttotalpeminjaman1;
        $pesan->tpembayaran1 = $request->tpembayaran1;
        $pesan->tbunga1 = $request->tbunga1;
        $pesan->ttotalpokok1 = $request->ttotalpokok1;
        $pesan->ttotalpembayaran1 = $request->ttotalpembayaran1;
        $pesan->deskripsi1 = $request->deskripsi1;
    }

    function adminDeletePesan($pesan_id){
        $user = Pesan1::find($pesan_id);
    
        if ($user) {
            $user->delete();
        }
    
        return redirect()->back()->with('success-delete', 'Data berhasil dihapus beserta pinjamannya.');
    }

    public function adminPindahPinjaman(Request $request){
        $validated = $request->validate([
            'pinjaman_id' => 'required|exists:pesan1s,pesan_id',
            'jenis1' => 'nullable|string',
            'ttotalpeminjaman1' => 'nullable|numeric',
            'tpembayaran1' => 'nullable|integer',
            'tbunga1' => 'nullable|numeric',
            'ttotalpokok1' => 'nullable|numeric',
            'ttotalbunga1' => 'nullable|numeric',
            'ttotalpembayaran1' => 'nullable|numeric',
            'deskripsi1' => 'nullable|string',
            'sisatabungan' => 'nullable|numeric'
        ]);
    
        // 👇 Tambahkan field pokok1 ke array validated
        
        // Simpan data
        if($validated['jenis1'] === 'Pinjaman Pertama'){
            Peminjaman1::create([
                'pinjaman_id' => $validated['pinjaman_id'],
                'ttotalpeminjaman1' => $validated['ttotalpeminjaman1'],
                'tpembayaran1' => 0,
                'tbunga1' => $validated['tbunga1'],
                'ttotalpokok1' => $validated['ttotalpokok1'],
                'ttotalbunga1' => $validated['ttotalbunga1'],
                'ttotalpembayaran1' => $validated['ttotalpembayaran1'],
                'deskripsi1' => $validated['deskripsi1'],
                'pokok1' => $validated['ttotalpeminjaman1'],
                'bunga_sebelumnya' => $validated['ttotalbunga1'],
            ]);

            Pesan1::where('jenis1', 'Pinjaman Pertama')
                ->where('pesan_id', $validated['pinjaman_id'])
                ->latest()
                ->first()
                ->delete();

            return redirect()->back()->with('success-update', 'Data pinjaman berhasil disimpan.');
        }
        elseif($validated['jenis1'] === 'Pinjaman Kedua'){
            Peminjaman2::create([
                'pinjaman_id' => $validated['pinjaman_id'],
                'ttotalpeminjaman2' => $validated['ttotalpeminjaman1'],
                'tpembayaran2' => 0,
                'tbunga2' => $validated['tbunga1'],
                'ttotalpokok2' => $validated['ttotalpokok1'],
                'ttotalbunga2' => $validated['ttotalbunga1'],
                'ttotalpembayaran2' => $validated['ttotalpembayaran1'],
                'deskripsi2' => $validated['deskripsi1'],
                'pokok2' => $validated['ttotalpeminjaman1'],
                'bunga_sebelumnya2' => $validated['ttotalbunga1'],
            ]);
            Pesan1::where('jenis1', 'Pinjaman Kedua')
                ->where('pesan_id', $validated['pinjaman_id'])
                ->latest()
                ->first()
                ->delete();
            return redirect()->back()->with('success-update', 'Data pinjaman berhasil disimpan.');
        }

        elseif($validated['jenis1'] === 'Overbook Pertama'){
            // Hapus data lama berdasarkan pinjaman_id
            Peminjaman1::where('pinjaman_id', $validated['pinjaman_id'])->delete();
            Pembayaran1::where('pembayaran_id', $validated['pinjaman_id'])->delete();
            // Simpan data baru
            Peminjaman1::create([
                'pinjaman_id' => $validated['pinjaman_id'],
                'ttotalpeminjaman1' => $validated['ttotalpeminjaman1'],
                'tpembayaran1' => $validated['tpembayaran1'],
                'tbunga1' => $validated['tbunga1'],
                'ttotalpokok1' => $validated['ttotalpokok1'],
                'ttotalbunga1' => $validated['ttotalbunga1'],
                'ttotalpembayaran1' => $validated['ttotalpembayaran1'],
                'deskripsi1' => $validated['deskripsi1'],
                'pokok1' => $validated['ttotalpeminjaman1'],
                'bunga_sebelumnya' => $validated['ttotalbunga1'],
            ]);

            Pesan1::where('jenis1', 'Overbook Pertama')
                ->where('pesan_id', $validated['pinjaman_id'])
                ->latest()
                ->first()
                ->delete();

            return redirect()->back()->with('success-update', 'Data pinjaman berhasil disimpan.');
        }
        elseif($validated['jenis1'] === 'Overbook Kedua'){
            // Hapus data lama berdasarkan pinjaman_id
            Peminjaman2::where('pinjaman_id', $validated['pinjaman_id'])->delete();
            Pembayaran2::where('pembayaran_id', $validated['pinjaman_id'])->delete();
            // Simpan data baru
            Peminjaman2::create([
                'pinjaman_id' => $validated['pinjaman_id'],
                'ttotalpeminjaman2' => $validated['ttotalpeminjaman1'],
                'tpembayaran2' => $validated['tpembayaran1'],
                'tbunga2' => $validated['tbunga1'],
                'ttotalpokok2' => $validated['ttotalpokok1'],
                'ttotalbunga2' => $validated['ttotalbunga1'],
                'ttotalpembayaran2' => $validated['ttotalpembayaran1'],
                'deskripsi2' => $validated['deskripsi1'],
                'pokok2' => $validated['ttotalpeminjaman1'],
                'bunga_sebelumnya2' => $validated['ttotalbunga1'],
            ]);

            Pesan1::where('jenis1', 'Overbook Kedua')
                ->where('pesan_id', $validated['pinjaman_id'])
                ->latest()
                ->first()
                ->delete();

            return redirect()->back()->with('success-update', 'Data pinjaman berhasil disimpan.');
        }
        
        elseif($validated['jenis1'] === 'Penarikan Tabungan'){            
            Tabungan::updateOrCreate(
                ['tabungan_id' => $validated['pinjaman_id']], // kondisi pencarian
                ['tabungan' => $validated['sisatabungan']]        // data yang akan diupdate/insert
            );

            Pesan1::where('jenis1', 'Penarikan Tabungan')
            ->where('pesan_id', $validated['pinjaman_id'])
            ->latest()
            ->first()
            ->delete();

            return redirect()->back()->with('success-tabungan', 'Data pinjaman berhasil disimpan.');
        }
        
        return redirect()->back()->with('success-update', 'Data pinjaman berhasil disimpan.');
    }


// Ubah Password
    function Pengaturan(){
        return view('admin.pengaturan', [
            'judul' => 'Admin Pengaturan',
            'css' => '../css/penarikan_tabungan_admin.css',
            'check' => Pesan1::exists()
        ]);
    }

    public function ubahPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
        ]);

        $user = User::where('id', $request->id)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }
    
}
