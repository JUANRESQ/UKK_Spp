<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $data = [
            'pembayaran' => Pembayaran::orderBy('id', 'DESC')->paginate(15),
            'u' => User::find(auth()->User()->id)
         ];
         
        return view('dashboard.index', $data);
    }
}
