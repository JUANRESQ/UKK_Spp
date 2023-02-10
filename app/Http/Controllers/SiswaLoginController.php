<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class SiswaLoginController extends Controller
{
    public function index(){
        $data = [
            'pembayaran' => Pembayaran::orderBy('id', 'DESC')->paginate(15),
            'u' => User::find(auth()->User()->id)
         ];
         
        return view('dashboard.siswa.index', $data);
    }
}
