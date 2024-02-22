@extends('layout/default')
@push('head')
<script src="{{ asset('js/pizza.js')}}"></script>
    
@endpush
@section('title','Pinjam')
@section('content')


  <div class="container">
    <div class="row">
        {{-- <div class="col-auto"> --}}
            <div class="col">
        {{ Breadcrumbs::render('pinjam') }}
        </div>
    </div>
</div>

    <div class="container ">
        <div class="row">
            <div class="col-xl-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        
                        @if($desc == true)
                            
                        <div class="row mb-2 ">
                        <h3>Menampilkan Hasil Penelusuran :  {{$desc}}</h3>
                        </div>
                       

                        @endif
                        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addNew">
                            TAMBAH PENGAJUAN
                          </button>
                        {{-- <a href="{{ route('pinjam.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a> --}}
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
                                <div class="col-2">
                                    <select class="livesearch3 form-select " name="ruang_id" style="height: 50px">
                                        {{-- <option value="">Semua Ruang</option>
                                        @foreach($ruang as $ruang)
                                        @if($ruang->id==$ruang_id)
                                        <option value="{{ $ruang->id }}" selected>{{ $ruang->nama }}</option>
                                        @else
                                        <option value="{{ $ruang->id }}">{{ $ruang->nama }}</option>
                                        @endif
                                        @endforeach --}}
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
                        <table class="table table-striped table-hover table-bordered align-middle">
                            <thead>
                              <tr>
                                <th scope="col" class="text-center">NO</th>
                                <th scope="col" class="col-2 text-center">NAMA KEGIATAN</th>
                                <th scope="col" class=" text-center">NAMA PEMINJAM</th>
                                <th scope="col" class="text-center">NAMA RUANG</th>
                                <th scope="col" class="col-2 text-center">WAKTU KEGIATAN</th>
                                {{-- <th scope="col" class="text-center">DURASI<br>(dalam jam)</th> --}}
                                <th scope="col" class="text-center">PENANGGUNG JAWAB</th>
                                <th scope="col" class="text-center">STATUS</th>
                                <th scope="col" class="text-center">ApprovedBy</th>
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
                                    {{-- <td class="text-center">{{ round((strtotime($row->selesai) - strtotime($row->mulai))/3600) }}</td> --}}
                                    <td class="text-center">{{ $row->penanggungjawab}}</td>
                                    @if(Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin')
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
                                         
                                        {{-- <div class="modal fade" id="pilihModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog ">
                                              <div class="modal-content">
                                                
                                                <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Aksi</h1>
                                                  <button type="button" class="btn-close " id="closePinjamBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" id='mediumBody'>
                                                   <form action="{{ route('pinjam.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">NAMA KEGIATAN</label>
                                                        <input  class="form-control @error('nama_kegiatan') is-invalid @enderror" value="{{ old('nama_kegiatan') }}" name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan">                                                           
                                                    </div>
                                                   </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="pinjam_delete_id" id="pinjam_id">
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ url('pinjam/tolak/'.$row->id) }}" method="POST">
                                                        <div class="row mx-auto">
                                                        <a href="{{ url('pinjam/setuju/'.$row->id) }}" class="btn btn-sm btn-success col-xl mx-1">SETUJU</a>    
                                                        @csrf
                                                        @method('GET')
                                                        <button type="submit" class="btn btn-sm col-xl btn-danger mx-1 ">TOLAK</button>
                                                        </div>
                                                    </form>
                                                 
                                                </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div> --}}
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
                                <td class="text-center">{{ $row->approvedby }}</td>
                                    {{-- <td class="text-center">
                                        @if (Auth::user()->role == 'admin') --}}
                                            {{-- <div class="row mb-2">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ url('pinjam/tolak/'.$row->id) }}" method="POST">
                                                <a href="{{ url('pinjam/setuju/'.$row->id) }}" class="btn btn-sm btn-success">SETUJU</a>    
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-sm btn-warning ">TOLAK</button>
                                                
                                            </form>
                                            </div> --}}
                                            
                                            {{-- <div class="row mx-auto">
                                                <a href="{{ route('pinjam.edit', $row->id) }}" class="btn btn-sm btn-primary col pt-2">EDIT</a> --}}
                                            {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pinjam.destroy', $row->id) }}" method="POST">
                                                
                                                
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ">HAPUS</button>
                                                
                                            </form> --}}
                                            {{-- <a data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="{{ route('delete', $row->id) }}" title="Delete Project">
                                                <i class="fas fa-trash text-danger  fa-lg"></i>
                                            </a> --}}
                                            {{-- <button type="button" class="btn btn-danger"
                                            onclick="loadDeleteModal({{ $row->id }}, `{{ $row->namakeg }}`)">حذف
                                    </button> --}}
                                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNew">
                                        Launch demo modal
                                      </button> --}}
                                            {{-- <button type="button" class="btn btn-danger col  deletePinjamBtn" value="{{$row->id}}">Hapus</button>
                                            </div>
                                            @if($row->status == 'tolak')
                                            <div class="row mx-auto">
                                                <a href="{{ url('pinjam/ajukan/'.$row->id) }}" class="btn btn-sm btn-secondary my-3" >Ajukan Kembali</a>
                                                </div>
                                                @endif   
                                        @else
                                        
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pinjam.destroy', $row->id) }}" method="POST">
                                                <a href="{{ route('pinjam.edit', $row->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ">HAPUS</button>
                                                
                                            </form>
                                            @if($row->status == 'tolak')
                                            <div class="row mx-auto">
                                                <a href="{{ url('pinjam/ajukan/'.$row->id) }}" class="btn btn-sm btn-secondary my-3" >Ajukan Kembali</a>
                                                </div>
                                                @endif  
                                            
                                        
                                            
                                        @endif --}}
                                     {{-- {{ route('pinjam.setuju') }}  --}}
                                       
                                    {{-- </td> --}}
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Peminjaman Ruang belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>                           
                          </table>  
                          {{ $pinjam->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="deleteCategory" data-backdrop="static" tabindex="-1" role="dialog"
             aria-labelledby="deleteCategory" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">This action is not reversible.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <span id="modal-category_name"></span>?
                        <input type="hidden" id="category" name="category_id">
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('pinjam.destroy', $row->id) }}" method="POST">
                            @csrf
                             @method('DELETE')
                        <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" id="modal-confirm_delete" >Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        @include('includes/modal')
        <script>
           
            $('.livesearch3').select2({
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
   
 {{-- @section('footerjs') --}}
  
    {{-- @endsection  --}}
    