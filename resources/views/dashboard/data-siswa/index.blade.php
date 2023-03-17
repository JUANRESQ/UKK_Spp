@extends('layout.dashboard')

@section('judul')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="card-title">Data Siswa</div>
					@if (session()->has('Berhasil!'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('Berhasil!') }}</div>
					@endif
                              <a href="{{ url('dashboard/data-siswa/create') }}" class="btn btn-success btn-rounded float-right mb-3">
                                 <i class="mdi mdi-plus-circle"></i> {{ __('Tambah Siswa') }}
                              </a>
						<div class="table-responsive mb-3">
                                <table class="table ml-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NISN</th>
								            <th scope="col">NIS</th>
                                            <th scope="col">NAMA</th>
                                            <th scope="col">KELAS</th>
								            <th scope="col">NOMOR TELEPON</th>
								            <th scope="col">ALAMAT</th>
								            <th scope="col">ACTION</th>                                        
								            <th scope="col">ACTION</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
								@foreach($siswa as $value)
                                        <tr>					    
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $value->nisn }}</td>
								            <td>{{ $value->nis }}</td>
                                            <td>{{ $value->nama }}</td>
                                            <td>{{ $value->kelas->nama_kelas }}</td>
								            <td>{{ $value->nomor_telp }}</td>
								            <td>{{ $value->alamat }}</td>
                                            <td>										                           	
												<form onsubmit="return confirm('Yakin Anda akan menghapus data?')" action="{{ url('dashboard/data-siswa', $value->id) }}"  method="POST">
													@csrf
													@method('DELETE')
													
													<button type="submit" name="submit" class="btn btn-danger">Delete</button>
												  </form>							
								            </td>
											<td><a href="{{ url('dashboard/data-siswa/'. $value->id .'/edit') }}" class="btn btn-primary">edit</a></td>					
                                        </tr>
								@endforeach                                  
                                    </tbody>
                                </table>
                            </div>

					  <!-- Pagination -->
					@if($siswa->lastPage() != 1)
						<div class="btn-group float-right">		
						   <a href="{{ $siswa->previousPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-left"></i>
						    </a>
						    @for($i = 1; $i <= $siswa->lastPage(); $i++)
								<a class="btn btn-success {{ $i == $siswa->currentPage() ? 'active' : '' }}" href="{{ $siswa->url($i) }}">{{ $i }}</a>
						    @endfor
					        <a href="{{ $siswa->nextPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-right"></i>
							</a>
					   </div>
					@endif
					<!-- End Pagination -->
					
					   @if(count($siswa) == 0)
				  			<div class="text-center"> Tidak ada data!</div>
					   @endif
				</div>
			</div>
		</div>
	</div>

@endsection

