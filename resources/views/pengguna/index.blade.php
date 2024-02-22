
@extends('layout/default')
@section('title','Pengguna')
@section('content')
{{ Breadcrumbs::render('pengguna') }}
                <div class="card border-0 shadow rounded">
                
                    <div class="card-body">
                      <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addNewPeng">
                        TAMBAH PENGGUNA
                      </button>
                        {{-- <a href="{{ route('pengguna.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a> --}}
                        {{-- <a href="{{ route('pinjam.index') }}" class="btn btn-md btn-primary mb-3">PINJAM</a> --}}
                        <a href="{{url('pengguna/updpg')}}" class="btn btn-md btn-warning mb-3">UPDATE</a>
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
                                <th scope="col" class="text-center">NAMA PEGAWAI</th>
                                <th scope="col" class="text-center">ROLE</th>
                                <th scope="col" class="text-center">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $no=$user->firstItem(); ?>
                              @forelse ($user as $row)
                              
                            
                                <tr>
                                    
                                    <td class="text-center">
                                       {{ $no++}}
                                    </td>
                                    <td class="text-center">{{ $row->pegawai_nip }}</td>
                                    
                                    <td class="text-center">{!! optional($row->pegawai)->nama !!}</td>
                                    
                                    <td class="text-center">{{ $row->role}}</td>
                                    <td >
                                      
                                        <center>
                                            {{-- <a href="{{ route('pengguna.edit', $row->id) }}" class="btn btn-sm btn-primary">EDIT</a> --}}
                                            <button type="button" class="btn btn-sm btn-primary"data-bs-toggle="modal" data-bs-target="#EditPeng{{$row->id}}">EDIT</button>
                                            
                                            
                                            <button type="button" class="btn btn-sm btn-danger"data-bs-toggle="modal" data-bs-target="#HapusPeng{{$row->id}}">HAPUS</button>
                                        </center>
                                           
                                        <div class="modal fade" id="HapusPeng{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                              <form action="{{ route('pengguna.destroy',$row->id) }}" method="POST">
                                                  @method('delete')
                                                  @csrf
                                              <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pengguna</h1>
                                                <button type="button" class="btn-close " id="closePinjamBtn"data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                  <input type="hidden" name="pengguna_delete_id" value="{{$row->id}}">
                                                <h5>Apakah anda yakin menghapus ini ? </h5>
                                              </div>
                                              <div class="modal-footer">
                                                
                                                <button type="submit" class="btn btn-danger">Yes, Delete it</button>
                                              </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                        @include('includes/actionpeng')
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data pengguna belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table> 
                          @if($user->hasPages())
                          <div class="card-footer"> 
                          {{ $user->links() }}
                        </div>
                        @endif
                    </div>
                </div>
                @include('includes/modpeng')
@endsection