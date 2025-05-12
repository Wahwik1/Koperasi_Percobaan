<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class AuthController extends Controller
{
        // Login
        function tampilLogin(){
            return view('login', ['judul' => 'Login',
        'css'=>'../css/login_admin.css']);
        }

        function submitLogin(Request $request){

        // $request->validate([
        //     'name' => 'required',
        //     'password' => 'required',
        //     'g-recaptcha-response' => 'required'
        // ], [
        //     'g-recaptcha-response.required' => 'Mohon centang kotak reCAPTCHA terlebih dahulu.'
        // ]);

        // // Verifikasi CAPTCHA ke Google
        // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => env('RECAPTCHA_SECRET_KEY'),
        //     'response' => $request->input('g-recaptcha-response'),
        // ]);

        // if (!$response->json('success')) {
        //     session()->flash('verifikasi_gagal', 'Verifikasi reCAPTCHA gagal.');
        //     return redirect()->back();
        // }

        $credentials = $request->only('name', 'password');

        // Cek apakah username ada di database
        $user = User::where('name', $credentials['name'])->first();
    
        if (!$user) {
            // Jika username tidak ditemukan
            session()->flash('tidak_terdaftar', 'Nama Tidak Terdaftar');
            return redirect()->back();
        }
    
        // Jika username ditemukan, cek password
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            if (Auth::user()->is_admin == true) {
                $request->session()->put('role', 'admin');
                return redirect()->route('admin.dashboard');
            } else {
                $request->session()->put('role', 'user');
                return redirect()->route('user.dashboard');
            }
        } else {
            // Username ditemukan, tapi password salah
            session()->flash('gagal', 'Password salah.');
            return redirect()->back();
        }
    }

// ======================================================================================================================================

    // Logout
    function logout(Request $request)
{
    Auth::logout();
    $request->session()->forget('role');
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}


}
