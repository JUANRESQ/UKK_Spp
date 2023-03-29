@extends('layout.dashboard')

@section('judul', '')
   

@section('content')

   <div class="row">
      <div class="col-md-12">
      
         <div class="card">
            <div class="card-body">
               <div class="card-title">Entri Pembayaran</div>
               @if (session()->has('Berhasil!'))
               <div class="alert alert-success" role="alert">{{ session('Berhasil!') }}</div>
           @endif
                <form method="post" action="{{ url('dashboard/entry-pembayaran') }}">
                  @csrf
                  
                     <div class="form-group">
                        <label>NISN Siswa</label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" autocomplete="off">
                        <span class="text-danger">@error('nisn') {{ $message }} @enderror</span>
                     </div>
                     
                       <div class="input-group mb-3">									
                        <div class="input-group-prepend">										
                           <label class="input-group-text">										 	
                              SPP Bulan	
                           </label>
                        </div>
                        <select class="custom-select @error('spp_bulan') is-invalid @enderror" name="spp_bulan">
                           									
                              <option value="">Silahkan Pilih</option>											
                                 <option value="januari">Januari</option>
                                 <option value="februari">Februari</option>
                                 <option value="maret">Maret</option>
                                 <option value="april">April</option>
                                 <option value="mei">Mei</option>
                                 <option value="juni">Juni</option>
                                 <option value="juli">Juli</option>
                                 <option value="agustus">Agustus</option>
                                 <option value="september">September</option>
                                 <option value="oktober">Oktober</option>
                                 <option value="november">November</option>
                                 <option value="desember">Desember</option>
                       </select>
                     </div>
                     <span class="text-danger">@error('spp_bulan') {{ $message }} @enderror</span>
                  
                     <div class="form-group">
                       <label>Jumlah Bayar</label>
                       <input type="text" class="form-control @error('jumlah_bayar') is-invalid @enderror" name="jumlah_bayar">
                       <span class="text-danger">@error('jumlah_bayar') {{ $message }} @enderror</span>
                    </div>
                  
                   <button type="submit" class="btn btn-success btn-rounded float-right">
                     <i class="mdi mdi-check"></i> Simpan
                   </button>
               
                </form>
                  
            </div>
         </div>
         
      </div>
   </div>

   <div class="row mt-3 mb-3">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <div class="card-title">Data Pembayaran</div>
                  <div class="table-responsive mb-3">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">PETUGAS</th>
								                    <th scope="col">NISN SISWA</th>
                                            <th scope="col">NAMA SISWA</th>
                                            <th scope="col">SPP</th>
                                            <th scope="col">JUMLAH BAYAR</th>
                                            <th scope="col">TANGGAL BAYAR</th>
								                    <th scope="col">Action</th>                                                                            
								                    <th scope="col"></th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
								            @foreach($pembayaran as $value)
                                        <tr>					    
                                          <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $value->users->username }}</td>
						        <td>{{ $value->siswa->nisn }}</td>
                                            <td>{{ $value->siswa->nama }}</td>
                                            <td>{{ $value->siswa->spp->nominal }}</td>
                                            <td>{{ $value->jumlah_bayar }}</td>
                                            <td>{{ $value->created_at->format('d M, Y') }}</td>
                                            <td>										                           
                                             <form onsubmit="return confirm('Yakin Anda akan menghapus data?')" action="{{ url('dashboard/entry-pembayaran', $value->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                              
                                                <button type="submit" name="submit" class="btn btn-danger d-inline">Delete</button>
                                              </form>
                                            </td>
											         </form>	            
                                				</div>
                            				</div>								
								                {{-- </td>
                                        @if(auth()->user()->level == 'admin')
                                        <td><a href="{{ url('dashboard/entry-pembayaran/'. $value->id .'/edit') }}" class="btn btn-primary">edit</a></td>
                                        @endif					 --}}
                                        </tr>
								            @endforeach                                  
                                    </tbody>
                                </table>
                            </div>
                           
                            <! -- Pagination -->
					@if($pembayaran->lastPage() != 1)
						<div class="btn-group float-right">		
						   <a href="{{ $pembayaran->previousPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-left"></i>
						    </a>
						    @for($i = 1; $i <= $pembayaran->lastPage(); $i++)
								<a class="btn btn-success {{ $i == $pembayaran->currentPage() ? 'active' : '' }}" href="{{ $pembayaran->url($i) }}">{{ $i }}</a>
						    @endfor
					        <a href="{{ $pembayaran->nextPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-right"></i>
							</a>
					   </div>
					@endif
					<!-- End Pagination -->
					
					   @if(count($pembayaran) == 0)
				  			<div class="text-center">Tidak ada data!</div>
					   @endif

            </div>
         </div>
      
      </div>
   </div>

@endsection

