<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect('/dashboard');
        }
 
        return back()->with('salah', 'maaf email atau password yang anda masukan salah!');
    }
    public function loginsiswa(){
        return view('auth.login-siswa');
    }

    public function authUser(Request $request)
    {
        $credentials = $request->validate([
            'nisn' => ['required'],
            'nis' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect('/dashboard.siswa.index');
        }
 
        return back()->with('salah', 'maaf email atau password yang anda masukan salah!');
    }

    // public function login(){
    //     return view('auth.login');
    // }
    

}
