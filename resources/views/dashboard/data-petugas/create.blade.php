@extends('layout.dashboard')

@section('judul')

@section('content')

	<div class="container">
         <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                       <div class="card-title">Tambah Petugas</div>
                     
                        <form method="post" action="{{ url('/dashboard/data-petugas') }}" id="create">
                           @csrf
                           <div class="input-group mb-3">									
                        <div class="input-group-prepend">										
                           <label class="input-group-text">										 	
                              Level	
                           </label>
                        </div>
                        <select name="level" class="custom-select @error('level') is-invalid @enderror">							
                              <option value="">Silahkan Pilih</option>											
                              <option value="admin">admin</option>
                              <option value="petugas">petugas</option>
                       </select>
                     </div>
                     <span class="text-danger">@error('level') {{ $message }} @enderror</span>
               
   
                           <div class="form-group">
                              <label>Username</label>
                              <input type="text" id="usernama" class="form-control @error('usernama') is-invalid @enderror" name="usernama" value="{{ old('usernama') }}">
                              <span class="text-danger">@error('usernama') {{ $message }} @enderror</span>
                           </div>
                           <div class="form-group">
                              <label>email</label>
                              <input type="email" id="email" class="form-control @error('usernama') is-invalid @enderror" name="email" value="{{ old('usernama') }}">
                              <span class="text-danger">@error('usernama') {{ $message }} @enderror</span>
                           </div>
                           
                           <div class="form-group">
                              <label>nama Petugas</label>
                              <input type="text" id="nama_petugas" class="form-control @error('nama_petugas') is-invalid @enderror" name="nama_petugas" value="{{ old('nama_petugas') }}">
                              <span class="text-danger">@error('nama_petugas') {{ $message }} @enderror</span>
                           </div>
                           
                           <div class="form-group">
                              <label>Password</label>
                              <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password">
                              <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                           </div>
                           
                           {{-- <div class="form-group">
                              <label>Konfirmasi Password</label>
                              <input type="password" id="konfirmasi_password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password">
                              <span class="text-danger">@error('confirm_password') {{ $message }} @enderror</span>
                           </div> --}}
                           <a href="{{ url('dashboard/data-petugas') }}" class="btn btn-primary btn-rounded">
                              <i class="mdi mdi-chevron-left"></i> Kembali
                           </a>
                           <button type="submit" class="btn btn-success btn-rounded" onclick="button()">
                                 <i class="mdi mdi-check"></i> Simpan
                           </button>   
                        </form>
                  </div>
              </div>     
            </div>
            
	</div>

@endsection

{{-- @section('sweet')

    function button()
   {
        var password = $('#password').val()
        var confirm_password = $('#konfirmasi_password').val()
        
        if(password == confirm_password){
             $('#create').submit()
         }else{
            swal.fire({
               title: 'Terjadi Kesalahan!',
               text: "Konfirmasi password kamu tidak cocok, tolong coba lagi",
               icon: 'error',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            })
         }
   }
   
@endsection --}}