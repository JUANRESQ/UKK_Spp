<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

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
        $exists = Siswa::where('nisn', $req->nisn)->exists();
         
        if($exists) :
              $siswa = Siswa::where('nisn', $req->nisn)->get();
              
              foreach($siswa as $val) :
                  Session::put('id', $val->id);
                  $nis = $val->nis;
              endforeach;
              
              if(strtolower($nis) == strtolower($req->nis)) :
                 
                    Session::put('nisn', $req->nisn);
                    Session::put('nis', $req->$nis);
                    
                    
                    return redirect('/dashboardSiswa');
              
                    //  Alert::error('Gagal Login!', 'NISN dan nama siswa tidak sesuai');
                    return back()->with('gagal login', 'NISN dan NIS siswa tidak sesuai' );
                    
              endif;
            
            //   Alert::error('Gagal Login!', 'Data siswa dengan NISN ini tidak ditemukan');
              return back()->with('gagal login', 'Data siswa dengan NISN ini tidak ditemukan');
           endif;
        // return back()->with('gagal login', 'maaf email atau password yang anda masukan salah!');
    }
    public function logout(){
      
        Session::flush();
        return redirect('/login');
      
    }
    public function logout2(){
      
        Session::flush();
        return redirect('/');
      
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if($user != null){
                \auth()->login($user, true);
                return redirect('dashboard');
            }else{
                $create = User::Create([
                    'email'                => $user_google->getEmail(),
                    'username'             => $user_google->getName(),
                    'password'          => 0,
                    'email_verified_at' => now() // fungsi tgl saat ini
                ]);

                \auth()->login($create, true);
                return redirect('/dasboard');
            }

        } catch (\Exception $e) {
            return redirect('login');
        }
    }
    

}
