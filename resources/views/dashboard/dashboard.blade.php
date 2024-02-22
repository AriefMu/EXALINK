@extends('layout/default')
@section('title','Dashboard')
@section('content')


<div class="container-fluid">
    {{ Breadcrumbs::render('home') }}
    @if($notify == null)

    @else
    @foreach ($notify as $item)
        
    @if( $item->status =='setuju')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
       Pengajuan anda untuk {{$item->nama}} pada waktu  {{Carbon\Carbon::createFromTimeString($item->mulai)->isoformat('dddd,D MMMM Y')  }} {{ date('H:i:s ',strtotime($item->mulai))}} - {{ date('H:i:s ',strtotime($item->selesai)) }} telah di{{$item->status}}i
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @elseif($item->status == 'tolak')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Pengajuan anda untuk {{$item->nama}} pada waktu  {{Carbon\Carbon::createFromTimeString($item->mulai)->isoformat('dddd,D MMMM Y')  }} {{ date('H:i:s ',strtotime($item->mulai))}} - {{ date('H:i:s ',strtotime($item->selesai)) }} Telah di{{$item->status}}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>

      @endif
      @endforeach
      @endif
      {{-- @foreach ($notify as $item2)
      
     
        
      @else
      
       @endif
      
      @endforeach --}}
    <div class="container">
      
    </div>
    <div class="card">
    
        
           
        
   
    <div class="card-body border-primary border-5">
        
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
           
        </div>
    </div>

<div class="row">
    <div class="col-xl-6 md-6 mb-4">
        <div class="card border-primary border-top-0 border-right-0 border-bottom-0  border-5 rounded-left shadow py-2 pl-2 "  id="card">
          
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2 ">
                        <div class="text center">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">PENGGUNA</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{$cuser}}
                       
                            <div class="col-auto float-right position-relative">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                                  </svg>
                            </div>
                        </div>
                        </div>
                        
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="col-xl-6 md-6 mb-4">
    <div class="card border-warning border-top-0 border-right-0 border-bottom-0 border-5 rounded-left shadow py-2 pl-2 " id="card">
      
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text center">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ruang</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cruan}}
                   
                        <div class="col-auto float-right position-relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
                                <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022ZM6 8.694 1 10.36V15h5V8.694ZM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15Z"/>
                                <path d="M2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-2 2h1v1H2v-1Zm2 0h1v1H4v-1Zm4-4h1v1H8V9Zm2 0h1v1h-1V9Zm-2 2h1v1H8v-1Zm2 0h1v1h-1v-1Zm2-2h1v1h-1V9Zm0 2h1v1h-1v-1ZM8 7h1v1H8V7Zm2 0h1v1h-1V7Zm2 0h1v1h-1V7ZM8 5h1v1H8V5Zm2 0h1v1h-1V5Zm2 0h1v1h-1V5Zm0-2h1v1h-1V3Z"/>
                              </svg>
                        </div>
                    </div>
                    </div>
                    
            </div>
        </div>
    </div>
</div>

</div>

</div>
<div class="row p-2  ">
    @if (Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin')
        
   
    <div class="card border-danger border-left-0 border-right-0 border-bottom-0 border-5 rounded-left shadow py-2 pl-2 mr-2  col" id="card">
      
        <div class="card-body">
            <div>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Peminjaman   <a class="btn btn-primary btn-sm" href="{{url('/pinjam/indexproses') }}"><b>Lihat semua</b></a></h1>
                   
                </div>
            </div>
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead>
          <tr>
            <th scope="col" class=" text-center">NO</th>
            <th scope="col" class=" text-center">NAMA KEGIATAN</th>
            {{-- <th scope="col" class=" text-center">NAMA PEMINJAM</th> --}}
            <th scope="col" class=" text-center">NAMA RUANG</th>
            <th scope="col" class=" text-center">WAKTU KEGIATAN</th>
            {{-- <th scope="col" class="text-center">DURASI<br>(dalam jam)</th> --}}
            {{-- <th scope="col" class="text-center">PENANGGUNG JAWAB</th> --}}
            <th scope="col" class=" text-center">STATUS</th>
            {{-- <th scope="col" class="text-center">ApprovedBy</th> --}}
            {{-- <th scope="col" class="col-md-2 text-center">AKSI</th> --}}
          </tr>
        </thead>
        <tbody> 
            <?php $no=$activity->firstItem(); ?>
          @forelse ($activity as $row)
            
            <tr>
                <td class="text-center">
                   {{ $no++}}
                </td>
                <td class="text-center">{{ $row->namakeg }}</td>
                {{-- <td class="text-center">{{ $row->nama}}</td> --}}
                <td class="text-center">{{ $row->ruang}}</td>
                <td class="text-center">{{ Carbon\Carbon::createFromTimeString($row->mulai)->isoformat('dddd,D MMMM Y')  }}</br>{{ date('H:i:s ',strtotime($row->mulai))}} - {{ date('H:i:s ',strtotime($row->selesai)) }}</td>
                {{-- <td class="text-center">{{ round((strtotime($row->selesai) - strtotime($row->mulai))/3600) }}</td> --}}
                {{-- <td class="text-center">{{ $row->penanggungjawab}}</td> --}}
                @if(Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin' )
                <td class="">
               
                    @if ($row->status == 'setuju')
                    <center>
                    <h3><a href="#edit{{$row->id}}" data-bs-toggle="modal" class="btn btn-success">Setuju</a></h3>
                    </center>
                    @include('includes\action')
                    @elseif ($row->status == 'tolak')
                    <center>
                    <h3><a href="#edit{{$row->id}}" data-bs-toggle="modal" class="btn btn-danger" >Tolak</a></h3>
                    </center>
                    @include('includes\action')
                    @else
                       <center>
                        <a href="#edit{{$row->id}}" data-bs-toggle="modal"  class="btn btn-warning" >Proses</a>
                       </center>
                        @include('includes\action')
                     
                   
                    @endif
            </td>
            @else
            <td class="">
               
                @if ($row->status == 'setuju')
                <h3><a href="#edit{{$row->id}}" data-bs-toggle="modal" class="btn btn-success">Setuju</a></h3>
                @include('includes\actionuser2')
                @elseif ($row->status == 'tolak')
                <h3><a href="#edit{{$row->id}}" data-bs-toggle="modal" class="btn btn-danger" >Tolak</a></h3>
                @include('includes\actionuser2')
                @else
                   
                    <a href="#edit{{$row->id}}" data-bs-toggle="modal"  class="btn btn-warning" >Proses</a>
                    @include('includes\actionuser')
                    @endif
            </td>
            @endif
            {{-- <td class="text-center">{{ $row->approvedby }}</td> --}}
            </tr>
          @empty
              <div class="alert alert-danger">
                  Data aktivitas belum Tersedia.
              </div>
          @endforelse
        </tbody> 

    </table>    
    {{ $activity->links() }}
</div>
    </div>
    @endif
    <div class="card border-success border-left-0 border-right-0 border-bottom-0 border-5 rounded-left shadow py-2 pl-2 ml-2 col" id="card">
      
        <div class="card-body">
            <div>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <form class='row cols-lg-auto g-1'>
                        <div class="col-6">
                    <h1 class="h3 mb-0 text-gray-800">Jadwal</h1>
                        </div>
                    <div class="col-4"><input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Search here..." /></div>
                    <div class="col-2"><button class="btn btn-success">Search</button></div>
                </form>
                </div>
            </div>
            
            
    <table class="table table-striped table-hover table-bordered align-middle">
        <thead>
          <tr>
            <th scope="col" class=" text-center">NO</th>
            <th scope="col" class=" text-center">NAMA KEGIATAN</th>
            {{-- <th scope="col" class=" text-center">NAMA PEMINJAM</th> --}}
            <th scope="col" class=" text-center">NAMA RUANG</th>
            <th scope="col" class=" text-center">WAKTU KEGIATAN</th>
            {{-- <th scope="col" class="text-center">DURASI<br>(dalam jam)</th> --}}
            {{-- <th scope="col" class="text-center">PENANGGUNG JAWAB</th> --}}
            {{-- <th scope="col" class="text-center">STATUS</th> --}}
            {{-- <th scope="col" class="text-center">ApprovedBy</th> --}}
            {{-- <th scope="col" class="col-md-2 text-center">AKSI</th> --}}
          </tr>
        </thead>
        <tbody> 
            <?php $no=$jadwal->firstItem(); ?>
          @forelse ($jadwal as $row2)
            
            <tr>
                <td class="text-center">
                   {{ $no++}}
                </td>
                <td class="text-center">{{ $row2->namakeg }}</td>
                {{-- <td class="text-center">{{ $row->nama}}</td> --}}
                <td class="text-center">{{ $row2->ruang}}</td>
                <td class="text-center">{{ Carbon\Carbon::createFromTimeString($row2->mulai)->isoformat('dddd,D MMMM Y')  }}</br>{{ date('H:i:s ',strtotime($row2->mulai))}} - {{ date('H:i:s ',strtotime($row2->selesai)) }}</td>
                {{-- <td class="text-center">{{ round((strtotime($row->selesai) - strtotime($row->mulai))/3600) }}</td> --}}
                {{-- <td class="text-center">{{ $row->penanggungjawab}}</td> --}}
                {{-- @if(Auth::user()->role == 'admin')
                <td class="">
               
                    @if ($row2->status == 'setuju')
                    <center>
                    <h3><a href="#edit{{$row2->id}}" data-bs-toggle="modal" class="btn btn-success">Setuju</a></h3>
                    </center>
                    @include('includes\action')
                    @elseif ($row->status == 'tolak')
                    <center>
                    <h3><a href="#edit{{$row2->id}}" data-bs-toggle="modal" class="btn btn-danger" >Tolak</a></h3>
                    </center>
                    @include('includes\action')
                    @else
                       <center>
                        <a href="#edit{{$row2->id}}" data-bs-toggle="modal"  class="btn btn-warning" >Proses</a>
                       </center>
                        @include('includes\action')
                     
                   
                    @endif --}}
            {{-- </td>
            @else
            <td class="">
               
                @if ($row2->status == 'setuju')
                <h3><a href="#edit{{$row2->id}}" data-bs-toggle="modal" class="btn btn-success">Setuju</a></h3>
                @include('includes\actionuser2')
                @elseif ($row->status == 'tolak')
                <h3><a href="#edit{{$row2->id}}" data-bs-toggle="modal" class="btn btn-danger" >Tolak</a></h3>
                @include('includes\actionuser2')
                @else
                   
                    <a href="#edit{{$row2->id}}" data-bs-toggle="modal"  class="btn btn-warning" >Proses</a>
                    @include('includes\actionuser')
                    @endif
            </td>
            @endif --}}
            {{-- <td class="text-center">{{ $row->approvedby }}</td> --}}
            </tr>
         
        </tbody> 
        <tfoot>
        @empty
              <div class="alert alert-danger">
                  Data jadwal belum Tersedia.
              </div>
          @endforelse
        </tfoot>
    </table>    
    {{ $jadwal->links() }}
</div>
    </div>
</div>
    </div>
</div>
</div>
@endsection