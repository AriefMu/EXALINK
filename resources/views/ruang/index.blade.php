
@extends('layout/default')

@section('title','Ruang')
@section('content')
<script>
  toastr.options = {
      "preventDuplicates":true
  };
  @if(count($errors)>0)
    @foreach($errors->all() as $error)
      toastr.error("{{$error}}");
    @endforeach
  @endif
  </script>
            <div class="card-body">
              {{ Breadcrumbs::render('ruang') }}
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                      @if (Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin')
                      <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addNewRuang">
                        TAMBAH RUANG
                      </button>
                     
                      {{-- <a href="{{ route('ruang.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a> --}}
                      <div class="card-header">
                        <form class="row cols-lg-auto g-1">
                          <div class=" col-3">
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
                            <th scope="col" class="text-center">NAMA RUANG</th>
                            <th scope="col" class="text-center">LANTAI</th>
                            <th scope="col" class="text-center">AKSI</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no=$ruan->firstItem(); ?>
                          @forelse ($ruan as $ruang)
                        
                            <tr>
                                <td class="text-center">
                                   {{ $no++}}
                                </td>
                                <td class="text-center">{{ $ruang->ruang }}</td>
                                <td class="text-center">{!! $ruang->lantai!!}</td>
                                <td >
                                  <center>
                                    {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('ruang.destroy', $ruang->id) }}" method="POST"> --}}
                                        {{-- <a href="{{ route('ruang.edit', $ruang->id) }}" class="btn btn-sm btn-primary">EDIT</a> --}}
                                        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#EditRuang{{$ruang->id}}">
                                          EDIT
                                        </button>
                                        
                                        {{-- @csrf
                                        @method('DELETE') --}}
                                        <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#HapusRuang{{$ruang->id}}">HAPUS</button>
                                    </form>
                                  </center>
                                  <div class="modal fade" id="HapusRuang{{$ruang->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <form action="{{ route('ruang.destroy',$ruang->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Ruang</h1>
                                          <button type="button" class="btn-close " id="closePinjamBtn"data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="ruang_delete_id" value="{{$ruang->id}}">
                                          <h5>Apakah anda yakin menghapus ini ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                          
                                          <button type="submit" class="btn btn-danger">Yes, Delete it</button>
                                        </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                    {{-- Modal Edit --}}
                                    <div class="modal fade" id="EditRuang{{$ruang->id}}" role="dialog">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Ruang</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="{{ route('ruang.update',$ruang->id) }}" method="POST" enctype="multipart/form-data">
                                                  
                                              @csrf
                                              @method('PUT')   
                                              <input type="hidden" name="idr" value="{{$ruang->id}}">
                                              <div class="form-group">
                                                  <label class="font-weight-bold">NAMA RUANG</label>
                                                  <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama',$ruang->ruang )}}" placeholder="Masukkan Nama Ruang">
                                              
                                                  <!-- error message untuk title -->
                                                  @error('nama')
                                                      <div class="alert alert-danger mt-2">
                                                          {{ $message }}
                                                      </div>
                                                  @enderror
                                              </div>
                                  
                                              <div class="form-group">
                                                  <label class="font-weight-bold">LANTAI</label>
                                                  <div class="wrapper "><select name="lantai" id="" class="form-control @error('lantai') is-invalid @enderror" style="width: 100%" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                                    {{-- <input type="text" class="form-control @error('lantai') is-invalid @enderror" name="lantai" value="{{ old('lantai') }}" rows="5" placeholder="Masukkan Lantai"> --}}
                                                    {{-- <select  class="form-control @error('lantai') is-invalid @enderror"data-dropup-auto="false" data-size="5" name="lantai"  style="width: 100%"> --}}
                                                      {{-- <option value="" disabled selected>--Pilih Nama Pengguna--</option>
                                                      @foreach($pegawai as $row)
                                                      
                                                      @endforeach --}}
                                                      <option value="" disabled >--Pilih Lantai--</option>
                                                      @foreach ($lantai as $lan)
                                                      @if ($lan->nama == $ruang->lantai)
                                                      <option value="{{old('lantai',$lan->id)}}" selected >{{$lan->nama}}</option>
                                                      @else
                                                     
                                                      <option value="{{old('lantai',$lan->id)}}" >{{$lan->nama}}</option>
                                                      @endif
                                                      @endforeach
                                                  </select>
                                              
                                                  <!-- error message untuk content -->
                                                  @error('lantai')
                                                      <div class="alert alert-danger mt-2">
                                                          {{ $message }}
                                                      </div>
                                                  @enderror
                                              </div>
                                          <div class="modal-footer">
                                            <button type="Reset" class="btn btn-secondary" >Ulang</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                          </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    {{-- END --}}
                                </td>
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data ruang belum Tersedia.
                              </div>
                          @endforelse
                        </tbody>
                      </table>  
                      @else
                      <div class="card-header">
                        <form class="row cols-lg-auto g-1">
                          <div class=" col-3">
                            <input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Search here..." />
                        </div>
                        <div class="col">
                            <button class="btn btn-success">Search</button>
                        </div>
                        </form>
                      </div>
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col" class="text-center">NO</th>
                            <th scope="col" class="text-center">NAMA RUANG</th>
                            <th scope="col" class="text-center">LANTAI</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                          @forelse ($ruan as $ruang)
                        
                            <tr>
                                <td class="text-center">
                                   {{ $no++}}
                                </td>
                                <td class="text-center">{{ $ruang->ruang }}</td>
                                <td class="text-center">{!! $ruang->lantai!!}</td>
                               
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data ruang belum Tersedia.
                              </div>
                          @endforelse
                        </tbody>
                      </table>  
                      @endif
                        
                       
                        
                          {{ $ruan->links() }}
                    </div>
                </div>
    </div>
    @if (Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin')
    @include('includes/ruangmod')
    @endif
    @endsection
   
   
