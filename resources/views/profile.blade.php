@extends('layout/default')
@section('title','Profile')
@section('content')
{{-- <a href="{{ url('/dashboard')}}" class="btn btn-md btn-danger mb-1 ml-3">KEMBALI</a> --}}

    
       
       

<div class="card-body">
    {{ Breadcrumbs::render('profil') }}
    <div class="card border-0 shadow rounded">

        <div class="card-body">
            
                
                <form action="{{ route('update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="row">
                    <div class="col-md-3 text-center">
                        @if (Auth::user()->imgprofil == true)
                        <img src={{Storage::url('public/').Auth::user()->imgprofil }} class="rounded-circle mb-1 mt-3" style="width: 85px;"alt="Avatar" />  
                        @else
                        <img src='https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg' class="rounded-circle mb-1 mt-3" style="width: 85px;"alt="Avatar" />   
                        @endif
                        
                        <div class="form-group">
                            <label class="font-weight-bold">FOTO PROFIL</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                        
                            <!-- error message untuk title -->
                            @error('image')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-9">
                    <div class="form-group">
                        <label class="font-weight-bold">NAMA</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', Auth::user()->pegawai->nama) }}" placeholder="Masukkan Nama Ruang" readonly="readonly">
                    
                        <!-- error message untuk title -->
                        @error('nama')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">ROLE</label>
                        <input class="form-control @error('role') is-invalid @enderror" name="role" rows="5" value="{{ old('role', Auth::user()->role) }}" placeholder="Masukkan role" readonly="readonly">
                    
                        <!-- error message untuk content -->
                        @error('role')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">USERNAME</label>
                        <input class="form-control @error('role') is-invalid @enderror" name="role" rows="5" value="{{ old('role', Auth::user()->username) }}" placeholder="Masukkan role" readonly="readonly">
                    
                        <!-- error message untuk content -->
                        @error('role')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    <a href="{{url('/gantipassword')}}" class="btn btn-secondary text-white">Ganti Password</a>

                </form> 
        </div>
    </div>
        </div>
    </div>
</div>
@endsection