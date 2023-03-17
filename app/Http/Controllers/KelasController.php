<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
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
            'kelas' => Kelas::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id),
       ];
       
      return view('dashboard.data-kelas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong!',
         ];
         
         $validasi = $request->validate([
            'kelas' => 'Required',
            'keahlian' => 'Required',
         ], $messages);
      
         if($validasi) :
             $create = Kelas::create([
                  'nama_kelas' => $request->kelas,
                  'kompetensi_keahlian' => $request->keahlian
            ]);
            
            if($create) :
                return back()->with('Berhasil!', 'Data Berhasil Ditambahkan');
            else :
                return back()->with('Gagal!', 'Data Gagal Ditambahkan');
            endif;
         endif;
      
        return back();
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
            'edit' =>  Kelas::find($id),
             'user' => User::find(auth()->user()->id),
         ];
         
         return view('dashboard.data-kelas.edit', $data);
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
        if($update = Kelas::find($id)) :
            $stat = $update->update([
               'nama_kelas' => $req->kelas,
               'kompetensi_keahlian' => $req->keahlian
            ]);
            if($stat) :
                return redirect('dashboard/data-kelas')->with('Berhasil!', 'Data Berhasil di Edit!');
               else :
                return back()->with('Terjadi Kesalahan!', 'Data Gagal di Edit!');
               endif;
      endif;
      
      return redirect('dashboard/data-kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::where('id', $id)->delete();
        return back()->with('Berhasil!', 'data berhasil dihapus');
    }
}
