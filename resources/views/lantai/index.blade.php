
@extends('layout/default')

@section('title','lantai')
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
              {{ Breadcrumbs::render('lantai') }}
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                      @if (Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin')
                      <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addNewLantai">
                        TAMBAH LANTAI
                      </button>
                     
                      {{-- <a href="{{ route('lantai.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a> --}}
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
                            <th scope="col" class=" text-center">NO</th>
                            <th scope="col" class="col-5 text-center">NAMA</th>
      
                            <th scope="col" class="col-5 text-center">AKSI</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no=$lantai->firstItem(); ?>
                          @forelse ($lantai as $lan)
                        
                            <tr>
                                <td class=" text-center">
                                   {{ $no++}}
                                </td>
                                <td class=" text-center">{{ $lan->nama }}</td>
                               
                                <td >
                                  <center>
                                    {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('lantai.destroy', $lan->id) }}" method="POST"> --}}
                                        {{-- <a href="{{ route('lantai.edit', $lan->id) }}" class="btn btn-sm btn-primary">EDIT</a> --}}
                                       
                                        
                                        {{-- @csrf
                                        @method('DELETE') --}}
                                        <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#Hapuslantai{{$lan->id}}">HAPUS</button>
                                    </form>
                                  </center>
                                  <div class="modal fade" id="Hapuslantai{{$lan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <form action="{{ route('lantai.destroy',$lan->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus lantai</h1>
                                          <button type="button" class="btn-close " id="closePinjamBtn"data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="lantai_delete_id" value="{{$lan->id}}">
                                          <h5>Apakah anda yakin menghapus ini ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                          
                                          <button type="submit" class="btn btn-danger">Yes, Delete it</button>
                                        </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                   
                                </td>
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data Lantai belum Tersedia.
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
                            <th scope="col" class="text-center">NAMA</th>
                           
                            
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                          @forelse ($lantai as $lan)
                        
                            <tr>
                                <td class="text-center">
                                   {{ $no++}}
                                </td>
                                <td class="text-center">{{ $lan->nama }}</td>
                             
                               
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data lantai belum Tersedia.
                              </div>
                          @endforelse
                        </tbody>
                      </table>  
                      @endif
                        
                       
                        
                          {{ $lantai->links() }}
                    </div>
                </div>
    </div>
    @if(Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin')
    @include('includes/lantaimod')
    @endif
    @endsection
   
   
