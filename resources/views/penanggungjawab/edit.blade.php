@extends('layout/default')
@section('title','Edit Ruang')
@section('content')

    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('ruang.index') }}" class="btn btn-md btn-danger mb-3">KEMBALI</a>
                        <form action="{{ route('ruang.update', $ruang->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="form-group">
                                <label class="font-weight-bold">NAMA RUANG</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $ruang->nama) }}" placeholder="Masukkan Nama Ruang">
                            
                                <!-- error message untuk title -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">LANTAI</label>
                                <input class="form-control @error('lantai') is-invalid @enderror" name="lantai" rows="5" value="{{ old('lantai', $ruang->lantai) }}" placeholder="Masukkan Lantai">
                            
                                <!-- error message untuk content -->
                                @error('lantai')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection