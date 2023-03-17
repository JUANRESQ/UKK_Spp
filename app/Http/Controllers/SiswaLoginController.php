<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiswaLoginController extends Controller
{

    public function __construct(){
        $this->middleware('SiswaMiddle');
    }
    
    public function index(){
        if(session('nisn') == null) : 
            return redirect('/');
        endif;
          
         $data = [
             'pembayaran' => Pembayaran::where('id_siswa', Session::get('id'))->paginate(10)
         ];
         
        return view('dashboard.siswa.index', $data);
    }
}
