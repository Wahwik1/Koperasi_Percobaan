<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pesan1;
use App\Models\Tabungan;
use App\Models\Pembayaran1;
use App\Models\Pembayaran2;
use App\Models\Peminjaman1;
use App\Models\Peminjaman2;
use Illuminate\Http\Request;
use App\Models\PembayaranTabungan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function userProfile(){
        $user = Auth::user();
        return view('user.profile', [
            'judul' => 'Profile',
            'css' => '../css/profile_user.css',
            'active' => 'active',
            'user' => $user
        ]);
    }
    function userDashboard(){
        $user = Auth::user();
        return view('user.dashboard', [
            'judul' => 'Dashboard',
            'css' => '../css/dashboard_user.css',
            'user' => $user,
            'pinjaman1' => Peminjaman1::all()
        ]);
    }
    public function detailKeuangan()
    {
 
        $user = Auth::user();

        $peminjamanTerbaru = Peminjaman1::where('pinjaman_id', $user->id)
                                        ->orderBy('id', 'desc')
                                        ->first(); 

        $peminjamanTerbaru2 = Peminjaman2::where('pinjaman_id', $user->id)
                                        ->orderBy('id', 'desc') 
                                        ->first();

        $tabungan = Tabungan::where('tabungan_id', $user->id)
                                        ->orderBy('id', 'desc') 
                                        ->first();

        
        return view('user.detailkeuangan', [
            'judul' => 'Detail Keuangan',
            'css' => '../css/detail_keuangan_user.css',
            'user' => $user,
            'peminjaman1' => $peminjamanTerbaru,
            'peminjaman2' => $peminjamanTerbaru2,
            'tabungan' => $tabungan,
            'tabel_pembayaran1' => Pembayaran1::with(['pembayaran1', 'peminjaman1'])
            ->where('pembayaran_id', $user->id)
            ->orderBy('id', 'desc')
            ->get(),

            'tabel_pembayaran2' => Pembayaran2::with(['pembayaran2', 'peminjaman2'])
                        ->where('pembayaran_id', $user->id)
                        ->orderBy('id', 'desc')
                        ->get(),

            'tabel_pembayarantabungan' => PembayaranTabungan::with('tabungan')
                        ->where('pembayarantabungan_id', $user->id)
                        ->orderBy('id', 'desc')
                        ->get(),
        ]);
    }
// =======================================================================================================================================
// PINJAMAN
    public function Pinjaman(){

        $user = Auth::user();
    
        // Misal: cek apakah user sudah punya peminjaman pertama dan kedua
        $posts1 = DB::table('peminjaman1s')->where('pinjaman_id', Auth::user()->id)->latest()->first();
        $posts2 = DB::table('peminjaman2s')->where('pinjaman_id', Auth::user()->id)->latest()->first();
        $peminjaman1Ada = Peminjaman1::where('pinjaman_id', $user->id)->exists();
        $peminjaman2Ada = Peminjaman2::where('pinjaman_id', $user->id)->exists();
        $pesan1 = Pesan1::where('jenis1', 'Pinjaman Pertama')
                ->where('pesan_id', $user->id)
                ->latest()
                ->first();
        $pesan2 = Pesan1::where('jenis1', 'Pinjaman Kedua')
                ->where('pesan_id', $user->id)
                ->latest()
                ->first();

        $pesan1pem = DB::table('pesan1s')
                ->where('jenis1', 'Pinjaman Pertama')
                ->where('pesan_id', $user->id)
                ->first();
        $pesan2pem = DB::table('pesan1s')
                ->where('jenis1', 'Pinjaman Kedua')
                ->where('pesan_id', $user->id)
                ->first();

        return view ('user.peminjaman', [
            'judul' => 'Pinjaman',
            'css' => '../css/user_peminjaman.css',
            'user' => $user,
            'posts1' => $posts1,
            'posts2' => $posts2,
            'peminjaman1' => $peminjaman1Ada,
            'peminjaman2' => $peminjaman2Ada,
            'pesan1' => $pesan1,
            'pesan2' => $pesan2,
            'pesan1pem' => $pesan1pem,
            'pesan2pem' => $pesan2pem
        ]);
    }

    public function userPesan1(Request $request){
        $validated = $request->validate([
            'pesan_id' => 'required|exists:users,id',
            'ttotalpeminjaman1' => 'nullable|numeric',
            'tpembayaran1' => 'nullable|integer',
            'tbunga1' => 'nullable|numeric',
            'ttotalpokok1' => 'nullable|numeric',
            'ttotalbunga1' => 'nullable|numeric',
            'ttotalpembayaran1' => 'nullable|numeric',
            'jenis1' => 'nullable|string',
            'deskripsi1' => 'nullable|string',
            'penarikantabungan' => 'nullable|numeric',
            'tabungansaatini' => 'nullable|numeric',
            'sisatabungan' => 'nullable|numeric'
        ]);

        // Hapus pinjaman lama (jika ada yang belum punya tpembayaran1)
        // Pesan1::where('pesan_id', $request->pinjaman_id)
        //     ->exists();

        // Simpan data
        Pesan1::create($validated);

        return redirect()->back()->with('success-pinjaman', 'Data pinjaman berhasil disimpan.');
    }
// ======================================================================================================================================
    public function Overbook(){

        $user = Auth::user();
    
        // Misal: cek apakah user sudah punya peminjaman pertama dan kedua
        $peminjaman1Ada = Peminjaman1::where('pinjaman_id', $user->id)->exists();
        $peminjaman2Ada = Peminjaman2::where('pinjaman_id', $user->id)->exists();
        $pesan1 = Pesan1::where('jenis1', 'Overbook Pertama')
                ->where('pesan_id', $user->id)
                ->latest()
                ->first();
        $pesan2 = Pesan1::where('jenis1', 'Overbook Kedua')
                ->where('pesan_id', $user->id)
                ->latest()
                ->first();

        $pesan1pem = DB::table('pesan1s')
                ->where('jenis1', 'Overbook Pertama')
                ->where('pesan_id', $user->id)
                ->first();
        $pesan2pem = DB::table('pesan1s')
                ->where('jenis1', 'Overbook Kedua')
                ->where('pesan_id', $user->id)
                ->first();

        $peminjamanTerbaru = Peminjaman1::where('pinjaman_id', $user->id)
        ->orderBy('id', 'desc')
        ->first(); 

        $peminjamanTerbaru2 = Peminjaman2::where('pinjaman_id', $user->id)
                ->orderBy('id', 'desc') 
                ->first();

        return view ('user.overbook', [
            'judul' => 'Overbook',
            'css' => '../css/user_overbook.css',
            'user' => $user,
            'peminjaman1' => $peminjaman1Ada,
            'peminjaman2' => $peminjaman2Ada,
            'peminjamanTerbaru' => $peminjamanTerbaru,
            'peminjamanTerbaru2' => $peminjamanTerbaru2,
            'pesan1' => $pesan1,
            'pesan2' => $pesan2,
            'pesan1pem' => $pesan1pem,
            'pesan2pem' => $pesan2pem
            ]);
    }

// ===============================================================================================================================

// Penarikan Tabungan
    public function penarikanTabungan(){

        $user = Auth::user();

        $pesan1 = Pesan1::where('jenis1', 'Penarikan Tabungan')
        ->where('pesan_id', $user->id)
        ->latest()
        ->first();

        $pesan1pem = DB::table('pesan1s')
        ->where('jenis1', 'Penarikan Tabungan')
        ->where('pesan_id', $user->id)
        ->first();

        $tabungan = Tabungan::where('tabungan_id', $user->id)
                                        ->orderBy('id', 'desc') 
                                        ->first();
                                        
        return view('user.penarikantabungan', [
            'judul' => 'Penarikan Tabungan',
            'css' => '../css/user_penarikan_tabungan.css',
            'user' => $user,
            'tabungan' => $tabungan,
            'pesan1' => $pesan1,
            'pesan1pem' => $pesan1pem
        ]);
    }

    public function Pengaturan(){
        $user = Auth::user();
        return view('user.pengaturan',[
            'judul' => 'Pengaturan',
            'css' => '../css/user_penarikan_tabungan.css',
            'user' => $user
        ]);
    }
    
    public function userUbahPassword(Request $request)
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
