<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\User;
use Illuminate\Http\Request;

class SppController extends Controller
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
            'spp' => Spp::orderBy('id', 'DESC')->paginate(10),
            'user' => User::find(auth()->user()->id)
        ];
      
         return view('dashboard.data-spp.index', $data);
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
            'numeric' => ':attribute harus berupa angka!',
            'min' => ':attribute minimal harus :min angka!',
            'max' => ':attribute maksimal harus :max angka!',
            'integer' => ':attribute harus berupa nilai uang tanpa titik!'
         ];
         
        $validasi = $request->validate([
            'tahun' => 'required|min:4|max:4',
            'nominal' => 'required|integer',
        ], $messages);
      
       if($validasi) :
           $store = Spp::create([
               'tahun' => $request->tahun,
               'nominal' => $request->nominal,
           ]);
         
           if($store) :
            return back()->with('Berhasil!', 'Data Berhasil Ditambahkan');
            else :
                return back()->with('Terjadi Kesalahan!', 'Data Gagal Ditambahkan');
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
            'edit' => Spp::find($id),
             'user' => User::find(auth()->user()->id)
        ];
      
        return view('dashboard.data-spp.edit', $data);
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
        if($update = Spp::find($id)) :         
            $stat = $update->update([
               'tahun' => $req->tahun,
               'nominal' => $req->nominal
            ]);
            if($stat) :
                return redirect('dashboard/data-spp')->with('Berhasil!', 'Data Berhasil di Edit');
                else :
                    return back()->with('Terjadi Kesalahan!', 'Data Gagal di Edit');
               endif;
         endif;
         
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Spp::where('id', $id)->delete();
        return back()->with('Berhasil!', 'data berhasil dihapus');
    }
}
