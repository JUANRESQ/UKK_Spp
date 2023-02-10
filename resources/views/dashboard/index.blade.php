@extends('layout.dashboard')

@section('judul',  'Histroy Terbaru')

@section('content')

{{-- <div class="row"> --}}
   <div class="d-flex">
      <div class="row ml-1">
         @foreach ($pembayaran as $history)   
         <div class="card d-flex mr-5 mb-3" style="width: 18rem;">
            <div class="card-body">
               {{-- <h5 class="card-title">History Terbaru</h5> --}}
               {{-- <hr> --}}
               <span class="badge badge-success badge-rounded float-right"badge badge-success badge-rounded float-right>{{ $history->created_at->diffforHumans() }}</span>
               <h6 class="font-medium">{{ $history->siswa->nama }}</h6>
               <hr>
               <span class="m-b-15 d-block">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item">Kelas {{ $history->siswa->kelas->nama_kelas }}</li>
                     <li class="list-group-item">Jumlah Bayar Rp.{{ $history->jumlah_bayar }}</li>
                     <li class="list-group-item">SPP Bulan <b  class="text-capitalize text-bold">{{ $history->spp_bulan }}</b></li>                                   
                </ul>
             </span>
             <div class="comment-footer ">
               <span class="text-muted float-right">{{ $history->created_at->format('M d, Y') }}</span>                                            
               <span class="action-icons active">
                       <a href="{{ url('dashboard/entry-pembayaran/'. $history->id .'/edit') }}"><i class="fa fa-solid fa-pen"></i></a>                                                  
                   </span>
            </div>
            </div>
        </div>
      @endforeach
      </div>
   </div>
{{-- </div> --}}

@endsection