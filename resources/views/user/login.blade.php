@extends('app2')
@section('content')

<div class="container ">
            <div class="panel border bg-white p-2">
                <div class="panel-heading">
                    <h4 class="pt-3 font-weight-bold">APLIKASI PEMINJAMAN RUANG RAPAT</h4>
                    <h4 class=" font-weight-bold">Login</h4>
                </div>
                <div class="panel-body p-3">
                    @error('salah')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
                    <form action="{{ route('login.action') }}" method="POST">
                        @csrf
                        <div class="form-group py-2">
                            <input class="form-control" type="username" name="username" placeholder="Username">
                            @error('username')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="form-group py-1 pb-2">
                            <input class="form-control" type="password" name="password" placeholder="Password">
                            @error('password')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                      
                        <button type="submit" class="btn btn-primary btn-block mt-3">Login</button>
                       
                    </form>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
                <script>toastr.options = {  "showDuration": "300"}</script>
            </div>
</div>
@endsection