<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class AuthController extends Controller
{
    public function getLogin() {
        return view('login');
    }

    public function getRegister() {
        return view('register');
    }

    public function doLogin(Request $request) {
        $rule_validasi = [
            'email' => 'required|email:dns',
            'password' => 'required'
        ];

        $pesan_validasi = [
            'email.required' => 'Email harus di isi',
            'email.email' => 'Format email tidak sesuai',
            'password.required' => 'Password harus di isi',
        ];

        $credentials = $request->validate($rule_validasi, $pesan_validasi);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Gagal!');
    }

    public function doRegister(Request $request) {
        $rule_validasi = [
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ];

        $pesan_validasi = [
            'name.required' => 'Nama harus di isi',
            'name.max' => 'Melebihi batas maksimal',
            'email.required' => 'Email harus di isi',
            'email.email' => 'Format email tidak sesuai',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus di isi',
            'password.min' => 'Password minimal 5 huruf',
            'password.max' => 'Password melebih batas maksimal',
        ];

        $validatedData = $request->validate($rule_validasi, $pesan_validasi);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        event(new Registered($user));
        Auth::login($user);
        return redirect()->intended('/dashboard');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function verifyEmail() {
        return view('verify-email');
    }

    public function doVerifyEmail(EmailVerificationRequest $request) {
        $request->fulfill();
        
        return redirect('/dashboard');
    }

    public function sendVerifyEmail(Request $request) {
        $request->user()->sendEmailVerificationNotification();
 
        return back()->with('message', 'Link verifikasi dikirim');
    }
}
