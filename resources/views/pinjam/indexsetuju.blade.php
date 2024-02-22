@extends('layout/default')
@section('title','Peminjaman Ruang')
@section('content')
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ url('pinjam/delete') }}" method="POST">
            @method('delete')
            @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pengajuan</h1>
          <button type="button" class="btn-close " id="closePinjamBtn"data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="pinjam_delete_id" id="pinjam_id">
          <h5>Are you sure want to delete this ? </h5>
        </div>
        <div class="modal-footer">
          
          <button type="submit" class="btn btn-danger">Yes, Delete it</button>
        </div>
        </form>
      </div>
    </div>
  </div>
    <div class="container ">
        <div class="row">
            {{-- <div class="col-auto"> --}}
                <div class="col">
            {{ Breadcrumbs::render('setuju') }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                       
                        @if($desc == true)
                            
                        <div class="row mb-2 ">
                        <h3>Menampilkan Hasil Penelusuran :  {{$q}} {{$desc}}</h3>
                        </div>
                        @elseif($desc==false)
                       

                        @endif
                        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addNew">
                            TAMBAH PENGAJUAN
                          </button>
                        <div class="btn-group mb-3" role="group" aria-label="Basic example">
                            <a class="btn btn-secondary" href="{{ route('pinjam.index')}}">All</a>
                            <a class="btn btn-secondary" href="{{url('/pinjam/indexsetuju') }}">Setuju</a>
                            <a class="btn btn-secondary" href="{{url('/pinjam/indexproses') }}">Proses</a>
                            <a class="btn btn-secondary" href="{{url('/pinjam/indextolak') }}">Tolak</a>
                          </div>
                          <div class="card-header">
                            <form class="row cols-lg-auto g-1">
                                <div class="col">
                                    <select class="form-select" name="diffH"placeholder="Pilih Rentang Waktu">
                                        <option value = '' selected >Semua rentang waktu</option>
                                        <option value="1">Sejam terakhir</option>
                                        <option value="2">24 jam terahir</option>
                                        <option value="3">Seminggu terakhir</option>
                                        <option value="4">Bulan terakhir</option>
                                        <option value="5">Setahun terakhir</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="livesearch form-select " name="ruang_id">   

                                    </select>
                                </div>
                                <div class=" col">
                                    <div class="input-group">
                                        <input class="form-control" type="date" name="start" value="{{ $start }}" />
                                        <input class="form-control" type="date" name="end" value="{{ $end }}" />
                                    </div>
                                </div>
                             {{-- <div class="col">
                                    <div class="input-group">
                                        <select class="form-select" name="total_operator" onchange="hide_total_value_end()">
                                            <option value="">All Total</option>
                                            @foreach($operators as $key => $val)
                                            @if($key==$total_operator)
                                            <option value="{{ $key }}" selected>Total {{ $val }}</option>
                                            @else
                                            <option value="{{ $key }}">Total {{ $val }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <input class="form-control" type="text" name="total_value" value="{{ $total_value }}" size="4" />
                                        <input class="form-control" type="text" name="total_value_end" value="{{ $total_value_end }}" size="4" />
                                    </div>
                                </div>  --}}
                                <div class=" col">
                                    <input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Search here..." />
                                </div>
                                <div class="col">
                                    <button class="btn btn-success">Search</button>
                                </div>
                            </form>
                        </div>
                       
                        @if(Auth::user()->role == 'admin' or  Auth::user()->role == 'superadmin')
                                        <table class="table table-striped table-hover table-bordered align-middle">
                                            <thead>
                                              <tr>
                                                <th scope="col" class="text-center">NO</th>
                                                <th scope="col" class="text-center">NAMA KEGIATAN</th>
                                                <th scope="col" class="text-center">NAMA PEMINJAM</th>
                                                <th scope="col" class="text-center">NAMA RUANG</th>
                                                <th scope="col" class="col-2 text-center">WAKTU KEGIATAN</th>
                                                {{-- <th scope="col" class="text-center">MULAI KEGIATAN</th>
                                                <th scope="col" class="text-center">DURASI<br>(per jam)</th> --}}
                                                <th scope="col" class="text-center">PENANGGUNG JAWAB</th>
                                                <th scope="col" class="text-center">STATUS</th>
                                                <th scope="col" class="text-center">APPROVEDBY</th>
                                                {{-- <th scope="col" class="col-md-2 text-center">AKSI</th> --}}
                                              </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=$pinjam->firstItem(); ?>
                                              @forelse ($pinjam as $row)
                                            
                                                <tr>
                                                    <td class="text-center">
                                                       {{ $no++}}
                                                    </td>
                                                    <td class="text-center">{{ $row->namakeg }}</td>
                                                    <td class="text-center">{{ $row->nama}}</td>
                                                    <td class="text-center">{{ $row->ruang}}</td>
                                                    <td class="text-center">{{ Carbon\Carbon::createFromTimeString($row->mulai)->isoformat('dddd,D MMMM Y')  }}</br>{{ date('H:i:s ',strtotime($row->mulai))}} - {{ date('H:i:s ',strtotime($row->selesai)) }}</td>
                                                    {{-- <td class="text-center">{{ $row->mulai }}</td>
                                                    <td class="text-center">{{ round((strtotime($row->selesai) - strtotime($row->mulai))/3600) }}</td> --}}
                                                    <td class="text-center">{{ $row->penanggungjawab }}</td>
                                                    <td >
                                                   
                                                        @if ($row->status == 'setuju')
                                                        <center>
                                                            <h3><a href="#edit{{$row->id}}" data-bs-toggle="modal" class="btn btn-success">Setuju</a></h3>
                                                            </center>
                                                            @include('includes\action')
                                                        @elseif ($row->status == 'tolak')
                                                        <h3><button type="button" class="btn btn-danger">Tolak</button></h3>
                                                        @else
                                                        <h3><button type="button" class="btn btn-warning">Proses</button></h3>
                                                        @endif
                                                </td>
                                                <td class="text-center">{{ $row->approvedby }}</td>
                                        {{-- <td class="text-center">
                                                        
                                            <div class="row mb-2">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ url('pinjam/tolak/'.$row->id) }}" method="POST">
                                                <a href="{{ url('pinjam/setuju/'.$row->id) }}" class="btn btn-sm btn-success">SETUJU</a>    
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-sm btn-warning ">TOLAK</button>
                                                
                                            </form>
                                            </div>
                                            
                                            <div class="row">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pinjam.destroy', $row->id) }}" method="POST">
                                                <a href="{{ route('pinjam.edit', $row->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ">HAPUS</button>
                                                
                                            </form>
                                            </div>
                                        </td> --}}
                                    </tr>
                                  @empty
                                      <div class="alert alert-danger">
                                          Data Peminjaman Ruang belum Tersedia.
                                      </div>
                                  @endforelse
                                </tbody>
                              </table>  
                                        @else
                                      
                                        <table class="table table-bordered">
                                            <thead>
                                              <tr>
                                                <th scope="col" class="text-center">NO</th>
                                                <th scope="col" class="text-center">NAMA KEGIATAN</th>
                                                <th scope="col" class="text-center">NAMA PEMINJAM</th>
                                                <th scope="col" class="text-center">NAMA RUANG</th>
                                                <th scope="col" class="text-center">MULAI KEGIATAN</th>
                                                <th scope="col" class="text-center">DURASI<br>(per jam)</th>
                                                <th scope="col" class="text-center">PENANGGUNG JAWAB</th>
                                                <th scope="col" class="text-center">STATUS</th>
                                               
                                              </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1; ?>
                                              @forelse ($pinjam as $row)
                                            
                                                <tr>
                                                    <td class="text-center">
                                                       {{ $no++}}
                                                    </td>
                                                    <td class="text-center">{{ $row->namakeg }}</td>
                                                    <td class="text-center">{{ $row->nama}}</td>
                                                    <td class="text-center">{{ $row->ruang}}</td>
                                                    <td class="text-center">{{ $row->mulai }}</td>
                                                    <td class="text-center">{{ round((strtotime($row->selesai) - strtotime($row->mulai))/3600) }}</td>
                                                    <td class="text-center">{{ $row->penanggungjawab }}</td>
                                                    <td >
                                                   
                                                        @if ($row->status == 'setuju')
                                                        <center>
                                    <h3><a href="#edit{{$row->id}}" data-bs-toggle="modal" class="btn btn-success">Setuju</a></h3>
                                                        </center>
                                    @include('includes\actionuser2')
                                    @elseif ($row->status == 'tolak')
                                    <h3><a href="#edit{{$row->id}}" data-bs-toggle="modal" class="btn btn-danger" >Tolak</a></h3>
                                    @include('includes\actionuser2')
                                    @else
                                       
                                        <a href="#edit{{$row->id}}" data-bs-toggle="modal"  class="btn btn-warning" >Proses</a>
                                        @include('includes\actionuser')
                                        @endif
                                                </td>
                                                    
                                    </tr>
                                  @empty
                                      <div class="alert alert-danger">
                                          Data Peminjaman Ruang belum Tersedia.
                                      </div>
                                  @endforelse
                                </tbody>
                              </table>  
                                        @endif
                                        {{-- {{ route('pinjam.setuju') }} --}}
                                       
                                   
                          {{ $pinjam->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes/modal')
    <script type="text/javascript">
        $('.livesearch').select2({
            placeholder: 'Select Ruang',
            value:"{{ old('ruang') }}",
            ajax: {
                url: '/ajax-autocomplete-search3',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text:item.nama,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
    @endsection

