@extends('app')
@section('content')
<style>
     @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}

body {
  height: 94.5vmin;
    background: linear-gradient(to top, #c9c9ff 50%, #9090fa 90%) no-repeat
}

.container {
   margin-top: 50px;
   

}

.panel-heading {
    text-align: center;
    margin-bottom: 10px
}

#forgot {
    min-width: 100px;
    margin-left: auto;
    text-decoration: none
}

a:hover {
    text-decoration: none
}

.form-inline label {
    padding-left: 10px;
    margin: 0;
    cursor: pointer
}

.btn.btn-primary {
    margin-top: 20px;
    border-radius: 15px
}

.panel {
    min-height: 380px;
    box-shadow: 20px 20px 80px rgb(218, 218, 218);
    border-radius: 12px
}

.input-field {
    border-radius: 5px;
    padding: 5px;
    display: flex;
    align-items: center;
    cursor: pointer;
    border: 1px solid #ddd;
    color: #4343ff
}



.fa-eye-slash.btn {
    border: none;
    outline: none;
    box-shadow: none
}

img {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 50%;
    position: relative
}

a[target='_blank'] {
    position: relative;
    transition: all 0.1s ease-in-out
}

.bordert {
    border-top: 1px solid #aaa;
    position: relative
}

.bordert:after {
    content: "or connect with";
    position: absolute;
    top: -13px;
    left: 33%;
    background-color: #fff;
    padding: 0px 8px
}

@media(max-width: 360px) {
    #forgot {
        margin-left: 0;
        padding-top: 10px
    }

    body {
        height: 100%
    }

    .container {
      margin: 50px 0
    }

    .bordert:after {
        left: 25%
    }
}
    </style>
<div class="container pt-5">
 
    <div class="row">
       
        <div class="offset-md-2 col-lg-5 col-md-8  offset-md-3">
           
            <div class="panel border bg-white">
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
    </div>
</div>
{{-- <div class="login-dark">
    
    <form action="{{ route('login.action') }}" method="POST">
        @csrf
        <h2 class="sr-only">Login Form</h2>
        <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
        <div class="form-group"><input class="form-control" type="username" name="username" placeholder="Username"></div>
        <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
        <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></form>
</div>
 --}}
{{-- <div class="row align-items-center mt-5">
    <div class="col">
    </div>
        <div class="col-6">
<div class="card-body " >
    <div class="card border-0 shadow rounded ">
        <div class="card-body ">
            
       
        <center>
        <h1>@yield('title', $title)</h1>
        </center>
        <form action="{{ route('login.action') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label><strong>Username</strong> <span class="text-danger">*</span></label>
                <input class="form-control" type="username" name="username" value="{{ old('username') }}" />
            </div>
            <div class="mb-3">
                <label><strong>Password</strong><span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="password" />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary"><strong>Login</strong></button>
                <a class="btn btn-danger" href="{{ route('home') }}"><strong>Back</strong></a>
            </div>
        </form>
    

        </div>
    </div>
</div>
        </div>
        <div class="col">
        </div>
</div> --}}

@endsection