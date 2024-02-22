@extends('layout/default')
@section('title','Ganti Password')
@section('content')

    <div class="row d-flex justify-content-center">
<div class="col-md-6">
   
<div class="card-body justify-content-center">
    {{ Breadcrumbs::render('ganpas') }}
    <div class="card border-0 shadow rounded">
        <a href="{{ url('/profil')}}" class="btn btn-md btn-danger mb-1 ml-3 mt-2 col-2">KEMBALI</a>
        <div class="card-body  ">
            
                
                <form action="{{ route('updatepw')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="row">                    
                    <div class="col-md-12">
                    <div class="form-group">
                        <label class="font-weight-bold">Password Sekarang</label>
                        <div class="row mb-2">
                            <div class="col-10 ml-2">
                        <input  name="passcur" type="password" id="password" class="form-control @error('passcur') is-invalid @enderror"  value="{{ old('passwordsekarang') }}" placeholder="Masukkan Password Sekarang" >
                            </div>
                        <div class="col-1 float-right">
                        <input type="checkbox" id="togglePw_current" onclick="showPassword('password')"/>
                            </div>                            
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Password Baru</label>
                        <div class="row mb-2">
                            <div class="col-10 ml-2">
                        <input  name="passnew" type="password" id="passwordnew" class="form-control @error('passnew') is-invalid @enderror"  value="{{ old('passwordbaru') }}" placeholder="Masukkan Password Baru" >
                            </div>
                        <div class="col-1 float-right">
                        <input type="checkbox" id="togglePw_current" onclick="showPassword('passwordnew')"/>
                            </div>
                    
                       
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Ulangi Password Baru</label>
                        

                            <div class="row mb-5">
                                <div class="col-10 ml-2">
                            <input  name="passulang" type="password" id="passwordulang" class="form-control @error('passulang') is-invalid @enderror"  value="{{ old('passwordulang') }}" placeholder="Masukkan Ulang Password Baru" >
                                </div>
                            <div class="col-1 float-right">
                            <input type="checkbox" id="togglePw_current" onclick="showPassword('passwordulang')"/>
                                </div>
                       
                    </div>
                        
                                     
                    
                    <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                </form> 
                
                
                
        </div>
    </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection