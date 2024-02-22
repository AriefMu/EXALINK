
@extends('layout/default')

@section('title','Penanggung Jawab')
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
              {{ Breadcrumbs::render('penanggungjawab') }}
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                      @if (Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin')
                      <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addNewPenanggungjawab">
                        TAMBAH PENANGGUNG JAWAB
                      </button>
                     
                      {{-- <a href="{{ route('penanggungjawab.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a> --}}
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
                            <th scope="col" class="text-center">NIP</th>
                            <th scope="col" class="text-center">NAMA</th>
                            <th scope="col" class="text-center">AKSI</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no=$penjaw->firstItem(); ?>
                          @forelse ($penjaw as $penanggungjawab)
                        
                            <tr>
                                <td class="text-center">
                                   {{ $no++}}
                                </td>
                                <td class="text-center">{{ $penanggungjawab->nip }}</td>
                                <td class="text-center">{!! $penanggungjawab->nama!!}</td>
                                <td >
                                  <center>
                                    {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('penanggungjawab.destroy', $penanggungjawab->id) }}" method="POST"> --}}
                                        {{-- <a href="{{ route('penanggungjawab.edit', $penanggungjawab->id) }}" class="btn btn-sm btn-primary">EDIT</a> --}}
                                        {{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#Editpenanggungjawab{{$penanggungjawab->id}}">
                                          EDIT
                                        </button> --}}
                                        
                                        {{-- @csrf
                                        @method('DELETE') --}}
                                        <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#Hapuspenanggungjawab{{$penanggungjawab->id}}">HAPUS</button>
                                    </form>
                                  </center>
                                  <div class="modal fade" id="Hapuspenanggungjawab{{$penanggungjawab->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <form action="{{ route('penanggungjawab.destroy',$penanggungjawab->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Penanggung Jawab</h1>
                                          <button type="button" class="btn-close " id="closePinjamBtn"data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="penanggungjawab_delete_id" value="{{$penanggungjawab->id}}">
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
                                    {{-- <div class="modal fade" id="Editpenanggungjawab{{$penanggungjawab->id}}" role="dialog">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit penanggungjawab</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="{{ route('penanggungjawab.update',$penanggungjawab->id) }}" method="POST" enctype="multipart/form-data">
                                                  
                                              @csrf
                                              @method('PUT')   
                                              <input type="hidden" name="idr" value="{{$penanggungjawab->id}}">
                                              <div class="form-group">
                                                  <label class="font-weight-bold">NAMA penanggungjawab</label>
                                                  <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama',$penanggungjawab->nama )}}" placeholder="Masukkan Nama penanggungjawab">
                                              
                                                  <!-- error message untuk title -->
                                                  @error('nama')
                                                      <div class="alert alert-danger mt-2">
                                                          {{ $message }}
                                                      </div>
                                                  @enderror
                                              </div>
                                  
                                              <div class="form-group">
                                                  <label class="font-weight-bold">LANTAI</label>
                                                  <input type="text" class="form-control @error('lantai') is-invalid @enderror" name="lantai" value="{{ old('lantai',$penanggungjawab->lantai) }}" rows="5" placeholder="Masukkan Lantai">
                                              
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
                                    </div> --}}
                                    {{-- END --}}
                                </td>
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data Penanggung Jawab belum Tersedia.
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
                            <th scope="col" class="text-center">NIP</th>
                            <th scope="col" class="text-center">NAMA</th>
                           
                            
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                          @forelse ($penjaw as $penanggungjawab)
                        
                            <tr>
                                <td class="text-center">
                                   {{ $no++}}
                                </td>
                                <td class="text-center">{{ $penanggungjawab->nip }}</td>
                                <td class="text-center">{!! $penanggungjawab->nama!!}</td>
                               
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data Penanggung Jawab belum Tersedia.
                              </div>
                          @endforelse
                        </tbody>
                      </table>  
                      @endif
                        
                       
                        
                          {{ $penjaw->links() }}
                    </div>
                </div>
    </div>
    @if(Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin')
    @include('includes/penanggungmod')
    @endif
    @endsection
   
   
