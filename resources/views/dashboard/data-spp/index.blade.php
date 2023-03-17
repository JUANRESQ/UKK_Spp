@extends('layout.dashboard')

@section('judul')

@section('content')

	<div class="d-flex mr-5">
         <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                       <div class="card-title">{{ __('Tambah SPP') }}</div>
                       @if (session()->has('Berhasil!'))
                       <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('Berhasil!') }}</div>
                       @endif
                       @if (session()->has('danger!'))
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('danger!') }}</div>
                       @endif
                        <form method="post" action="{{ url('/dashboard/data-spp') }}">
                           @csrf   
                           <div class="form-group">
                              <label>Tahun</label>
                              <input type="number" class="form-control @error('tahun') is-invalid @enderror" name="tahun" value="{{ old('tahun') }}">
                              <span class="text-danger">@error('tahun') {{ $message }} @enderror</span>
                           </div>
                           
                           <div class="form-group">
                              <label>Nominal</label>
                              <input type="text" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ old('nominal') }}">
                              <span class="text-danger">@error('nominal') {{ $message }} @enderror</span>
                           </div>
                           
                           <button type="submit" class="btn btn-success btn-rounded float-right">
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
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">TAHUN</th>
								            <th scope="col">NOMINAL</th>
                                            <th scope="col">DIBUAT</th>
								            <th scope="col">ACTION</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
								@foreach($spp as $value)
                                        <tr>					    
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $value->tahun }}</td>
								            <td>{{ $value->nominal }}</td>
                                            <td>{{ $value->created_at->format('d M, Y') }}</td>
                                            <td>										                           
                                                <form onsubmit="return confirm('Yakin Anda akan menghapus data?')" action="{{ url('dashboard/data-spp', $value->id) }}" method="POST">
                                                   @csrf
                                                   @method('DELETE')
                                                   <a href="{{ url('dashboard/data-spp/'. $value->id .'/edit') }}" class="btn btn-primary">edit</a>
                                                   <button type="submit" name="submit" class="btn btn-danger d-inline">Delete</button>
                                                 </form>
                                            </td>			
                                        </tr>
								@endforeach                                  
                                    </tbody>
                                </table>
                            </div>

					  <!-- Pagination -->
					@if($spp->lastPage() != 1)
						<div class="btn-group float-right">		
						   <a href="{{ $app->previousPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-left"></i>
						    </a>
						    @for($i = 1; $i <= $spp->lastPage(); $i++)
								<a class="btn btn-success {{ $i == $spp->currentPage() ? 'active' : '' }}" href="{{ $spp->url($i) }}">{{ $i }}</a>
						    @endfor
					        <a href="{{ $spp->nextPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-right"></i>
							</a>
					   </div>
					@endif
					<!-- End Pagination -->
					
					   @if(count($spp) == 0)
				  			<div class="text-center">Tidak ada data!</div>
					   @endif
				</div>
			</div>
		</div>
     </div>

@endsection

