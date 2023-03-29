<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function __construct(){
        $this->middleware([
           'auth',
           'privilege:admin'
        ]);
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'users' => User::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id)
         ];
         
        return view('dashboard.data-petugas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'user' => User::find(auth()->user()->id)
      ];
      
       return view('dashboard.data-petugas.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong!',
             'min' => ':attribute minimal :min karakter!',
             'unique' => ':attribute sudah digunakan!',
             'max' => ':attribute maksimal :max karakter',
       ];
       
       $req->validate([
          'level' => 'required',
          'usernama' => 'required|min:2',
          'email' => 'required',
          'nama_petugas' => 'required|',
          'password' => 'required|min:8'
       ], $messages);
       
              if(User::create([
                   'username' => $req->usernama,
                   'email' => $req->email,
                   'nama_petugas' => $req->nama_petugas,
                   'level' => $req->level,
                   'password' => Hash::make($req->password)
               ])) :
                //   Alert::success('Berhasil!', 'Data User Berhasil di Tambahkan');
             else :
                // Alert::error('Terjadi Kesalahan!', 'Data User Gagal di Tambahkan');
          endif;
      
 
          return redirect('dashboard/data-petugas')->with('Berhasil!', 'Data User Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'user' => User::find(auth()->user()->id),
            'edit' => User::find($id)
        ];
        
        return view('dashboard.data-petugas.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id) 
    {

        if($update = User::find($id)) :
            
            // if(Hash::check($req->old_pass, $update->old_pass)) :
                 
               $update->update([
                   'username' => $req->username,
                   'email' => $req->email,
                   'nama_petugas' => $req->nama_petugas,
                   'level' => $req->level,
                //    'password' => $req->password
              ]);
            
            //   Alert::success('Berhasil!', 'Data Berhasil di Edit');
              return redirect('dashboard/data-petugas')->with('Berhasil!', 'Data Berhasil di Edit');
            
        //    else :
        //        Alert::error('Terjadi Kesalahan!', 'Password Anda tidak Cocok');
            // endif;
         endif;
        
        return back()->with('danger!', 'Password Anda tidak Cocok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if($destroy = User::find($id)) :
        //     $destroy->delete();
        //       with('Berhasil!', 'Data Berhasil di Hapus');
        // else :
        //       with('Terjadi Kesalahan!', 'Data Gagal di Hapus');
        // endif;   
        // return back();
        User::where('id', $id)->delete();
        return back()->with('danger!', 'data berhasil dihapus');
    }
}
