<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Alert;
use Illuminate\Http\Request;

class SiswaController extends Controller
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
            'user' => User::find(auth()->user()->id),
            'siswa' => Siswa::orderBy('id', 'DESC')->paginate(5),
        ];
      
        return view('dashboard.data-siswa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'user' => User::find(auth()->user()->id),
            'kelas' => Kelas::all(),
            'spp' => Spp::all(),
        ];
      
        return view('dashboard.data-siswa.create', $data);
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
            'integer' => ':attribute harus berupa bilangan bulat!'
         ];
         
        $validasi = $request->validate([
            'nisn' => 'required|numeric|',
            'nis' => 'required|numeric|',
            'nama' => 'required',
             'kelas' => 'required|integer',
             'nomor_telepon' => 'required|numeric',
             'alamat' => 'required',
             'spp' => 'required|integer',
        ], $messages);
        
        if($validasi) :
            $store = Siswa::create([
               'nisn' => $request->nisn,
               'nis' => $request->nis,
               'nama' => $request->nama,
               'id_kelas' => $request->kelas,
               'nomor_telp' => $request->nomor_telepon,
               'alamat' => $request->alamat,
               'id_spp' => $request->spp
             ]);
              if($store) :
                return redirect('dashboard/data-siswa')->with('Berhasil!', 'Data Berhasil di Tambahkan');
               else :
                  return back()->with('Terjadi Kesalahan!', 'Data Gagal di Tambahkan');
               endif;
        endif;
      
       ;
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
            'siswa' => Siswa::find($id),
            'kelas' => Kelas::all(),
            'spp' => Spp::all(),
        ];
      
        return view('dashboard.data-siswa.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong!',
            'numeric' => ':attribute harus berupa angka!',
            'integer' => ':attribute harus berupa bilangan bulat!'
         ];
         
        $validasi = $request->validate([
            'nisn' => 'required|numeric|',
            'nis' => 'required|numeric|',
            'nama' => 'required',
             'kelas' => 'required|integer',
             'nomor_telepon' => 'required|numeric',
             'alamat' => 'required',
             'spp' => 'required|integer',
        ], $messages);
        
        if($validasi) :            
            $update = Siswa::find($id)->update([
               'nisn' => $request->nisn,
               'nis' => $request->nis,
               'nama' => $request->nama,
               'id_kelas' => $request->kelas,
               'nomor_telp' => $request->nomor_telepon,
               'alamat' => $request->alamat,
               'id_spp' => $request->spp
             ]);
            
             
             
              if($update) :
                return redirect('dashboard/data-siswa')->with('Berhasil!', 'Data Berhasil di Edit');
               else :
                  return back()->with('Terjadi Kesalahan!', 'Data Gagal di Edit');
               endif;
        endif;
      
        return redirect('dashboard/data-siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Siswa::where('id', $id)->delete();
        return back()->with('Berhasil!', 'data berhasil dihapus');
    }
}
