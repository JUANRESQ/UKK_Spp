@extends('layout.dashboard')

@section('judul', '')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Data Petugas</div>
                  <a href="{{ url('dashboard/data-petugas/create') }}" class="btn btn-success mb-3">Tambah Petugas</a>
                  @if (session()->has('Berhasil!'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('Berhasil!') }}</div>
                  @endif
                  @if (session()->has('danger!'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('danger!') }}</div>
              @endif
                    <div class="table-responsive mb-3">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">LEVEL</th>
                                        <th scope="col">DIBUAT</th>
                                        <th scope="col">ACTION</th>
                                <th scope="col"></th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                            @foreach($users as $value)
                                    <tr>					    
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $value->username }}</td>
                                        <td>{{ $value->nama_petugas }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->level }}</td>
                                        <td>{{ $value->created_at->format('d M, Y') }}</td>
                                        <td>										                           
                                            <form onsubmit="return confirm('Yakin Anda akan menghapus data?')" action="{{ url('dashboard/data-petugas', $value->id) }}"  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ url('dashboard/data-petugas/'. $value->id .'/edit') }}" class="btn btn-primary">edit</a>
                                                <button type="submit" name="submit" class="btn btn-danger d-inline">Delete</button>
                                              </form>
                                            </td>
                                            </form>	
                                             {{-- @endif --}}
                                            </div>
                                        </div>								
                                    </td>					
                                    </tr>
                            @endforeach                                  
                                </tbody>
                            </table>
                        </div>

                  <!-- Pagination -->
                @if($users->lastPage() != 1)
                    <div class="btn-group float-right">		
                       <a href="{{ $users->previousPageUrl() }}" class="btn btn-success">
                            <i class="mdi mdi-chevron-left"></i>
                        </a>
                        @for($i = 1; $i <= $users->lastPage(); $i++)
                            <a class="btn btn-success {{ $i == $users->currentPage() ? 'active' : '' }}" href="{{ $users->url($i) }}">{{ $i }}</a>
                        @endfor
                        <a href="{{ $users->nextPageUrl() }}" class="btn btn-success">
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                   </div>
                @endif
                <!-- End Pagination -->
                
                   @if(count($users) == 0)
                          <div class="text-center">Tidak ada data!</div>
                   @endif
            </div>
        </div>
    </div>
</div>

@endsection

