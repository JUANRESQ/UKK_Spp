<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Siswa;

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

    public function authUser(Request $req)
    {
        // $credentials = Siswa::where('nisn', $req->nisn )->get([
        //     'nisn' => ['required'],
        //     'nama' => ['required'],
        // ]);
 
        // if (Auth::attempt($credentials)) {
        //     $req->session()->regenerate();
 
        //     return redirect('dashboard/siswa/index');
        // }
 
        // return back()->with('salah', 'maaf email atau password yang anda masukan salah!');
        $exists = Siswa::where('nisn', $req->nisn)->exists();
         
        if($exists) :
              $siswa = Siswa::where('nisn', $req->nisn)->get();
              
              foreach($siswa as $val) :
                  Session::put('id', $val->id);
                  $nama = $val->nama;
              endforeach;
              
              if(strtolower($nama) == strtolower($req->nama_siswa)) :
                 
                    Session::put('nisn', $req->nisn);
                    Session::put('nama', $nama);
                    
                    return redirect('dashboard/siswa/index');
              
                    //  Alert::error('Gagal Login!', 'NISN dan nama siswa tidak sesuai');
                    return back()->with('gagal login', 'NISN dan nama siswa tidak sesuai' );
                    
              endif;
            
            //   Alert::error('Gagal Login!', 'Data siswa dengan NISN ini tidak ditemukan');
              return back()->with('gagal login', 'Data siswa dengan NISN ini tidak ditemukan');
           endif;
        return back()->with('salah', 'maaf email atau password yang anda masukan salah!');
    }
    public function logout(){
      
        Session::flush();
        return redirect('/login');
      
    }
    // public function logout2(){
      
    //     Session::flush();
    //     return redirect('/login');
      
    // }

    // public function login(){
    //     return view('auth.login');
    // }
    

}
