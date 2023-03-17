@extends('layout.dashboard')

@section('Judul')

@section('content')

	<div class="d-flex mr-5 mb-3">
         <div class="row-md-12">
              <div class="card">
                  <div class="card-body">
                       <div class="card-title">{{ __('Tambah Kelas') }}</div>
                       @if (session()->has('Berhasil!'))
                       <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('Berhasil!') }}</div>
                       @endif
                       @if (session()->has('danger!'))
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('danger!') }}</div>
                       @endif
                        <form method="post" action="{{ url('/dashboard/data-kelas') }}">
                           @csrf   
                           <div class="form-group">
                              <label>Nama Kelas</label>
                              <input type="text" class="form-control @error('kelas') is-invalid @enderror" name="kelas" value="{{ old('kelas') }}">
                              <span class="text-danger">@error('kelas') {{ $message }} @enderror</span>
                           </div>
                           
                           <div class="form-group">
                              <label>Kompeten Keahlian</label>
                              <input type="text" class="form-control @error('keahlian') is-invalid @enderror" name="keahlian" value="{{ old('keahlian') }}">
                              <span class="text-danger">@error('keahlian') {{ $message }} @enderror</span>
                           </div>
                           
                           <button type="submit" class="btn btn-success btn-rounded">
                                 <i class="mdi mdi-check"></i> Simpan
                           </button>
                        
                        </form>
                  </div>
              </div>     
            </div>
            
	</div>
     <div class="row">
           <div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="card-title">Data SPP</div>
                              
						<div class="table-responsive mb-3">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">KELAS</th>
								            <th scope="col">KEAHLIAN</th>
                                            <th scope="col">DIBUAT</th>
								            <th scope="col">Action</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
								@php 
								$i=1;
								@endphp
								@foreach($kelas as $value)
                                        <tr>					    
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $value->nama_kelas }}</td>
								            <td>{{ $value->kompetensi_keahlian }}</td>
                                            <td>{{ $value->created_at->format('d M, Y') }}</td>
                                            <td>										                           
                                                <form onsubmit="return confirm('Yakin Anda akan menghapus data?')" action="{{ url('dashboard/data-petugas', $value->id) }}"  method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ url('dashboard/data-kelas/'. $value->id .'/edit') }}" class="btn btn-primary">edit</a>
                                                    <button type="submit" name="submit" class="btn btn-danger d-inline">Delete</button>
                                                  </form>
                                                </td>			
                                        </tr>
								@php
								$i++;
								@endphp
								@endforeach                                  
                                    </tbody>
                                </table>
                            </div>

					  <!-- Pagination -->
					@if($kelas->lastPage() != 1)
						<div class="btn-group float-right">		
						   <a href="{{ $kelas->previousPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-left"></i>
						    </a>
						    @for($i = 1; $i <= $kelas->lastPage(); $i++)
								<a class="btn btn-success {{ $i == $kelas->currentPage() ? 'active' : '' }}" href="{{ $kelas->url($i) }}">{{ $i }}</a>
						    @endfor
					        <a href="{{ $kelas->nextPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-right"></i>
							</a>
					   </div>
					@endif
					<!-- End Pagination -->
					
					   @if(count($kelas) == 0)
				  			<div class="text-center"> Tidak ada data!</div>
					   @endif
				</div>
			</div>
		</div>
     </div>

@endsection

