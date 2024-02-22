<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>EXALINK - @yield('title')</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/3.0.3/css/bootstrap-combined.min.css">
        <link
          rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"
          integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK"
          crossorigin="anonymous"
        />
       
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
        />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" 
       href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
   
    {{-- <script src="{{ asset('js/pizza.js')}}" ></script>
    @stack('head') --}}
   
    @include('includes/style') 
        <style>
        
        </style>
      </head>
      <body style="background: lightgray">
        <div>
          <div class="sidebar p-4 bg-primary" id="sidebar">
            <a href="{{ url('/dashboard')}}"> <h4 class="mb-3 text-white">ExaLink</h4></a>
            <a href="{{url('profil')}}" >
            <div class="card border-0 shadow rounded">
                <div class="text-center">
                  @if (Auth::user()->imgprofil == true)
                  <img src={{Storage::url('public/').Auth::user()->imgprofil }} class="rounded-circle mb-1 mt-3" style="width: 85px;"alt="Avatar" />
                     
                  @else
                  <img src='https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg' class="rounded-circle mb-1 mt-3" style="width: 85px;"alt="Avatar" />   
                  
                  @endif
                
                <h4 class="mb-1 "><strong>{{Auth::user()->pegawai->nama ?? 'null'}}</strong></h4>
                <p class="text-muted"><strong>{{strtoupper(Auth::user()->role ?? 'null')}}
                </strong></p>
                </div>
            </div>
          </a>
            <li>
              <a class="text-white" href="{{ url('/dashboard')}}">
                <i class="bi bi-house mr-2"></i>
                Dashboard
              </a>
            </li>
            <li>
            <a class="dropdown-btn  bg-primary text-white"><i class="bi bi-calendar-plus mr-2"></i> Peminjaman Ruang
              <i class="fa fa-caret-down mt-1"></i>
            </a>
            <div class="dropdown-container bg-primary">
              <ul>
                <li>
                  <a class="text-white" href="{{ route('pinjam.create')}}">Tambah Pengajuan</a>
                </li>
                @if (Auth::user()->role == 'admin')
                <li>
                  <a class="text-white" href="{{url('/pinjam/indexproses') }}">Proses Pengajuan</a>
                </li>    
                @endif
                

                <li>
                  <a class="text-white" href="{{ route('pinjam.index')}}">Laporan Pengajuan</a>
                </li>
{{-- 
              <li>
              <a class="text-white" href="{{url('/pinjam/indexsetuju') }}">Setuju</a>
              </li>

            

              <li>
              <a class="text-white" href="{{url('/pinjam/indextolak') }}">Tolak</a>
            </li> --}}
              </ul>
            </div>
            
            <li>
              <a class="text-white" href="{{ route('ruang.index')}}">
                <i class="bi bi-door-open mr-2"></i>
                Ruang
              </a>
            </li>
            @if (Auth::user()->role == 'superadmin')
            <li>
              <a class="text-white" href="{{ route('pengguna.index')}}">
                <i class="bi bi-person mr-2"></i>
               Pengguna
              </a>
            </li>
            <li>
              <a class="text-white" href="{{ route('penanggungjawab.index')}}">
                <i class="bi bi-people mr-2"></i>
               Penanggung Jawab
              </a>
            </li>
            <li>
              <a class="text-white" href="{{ route('lantai.index')}}">
                <i class="bi bi-building mr-2"></i>
               Lantai
              </a>
            </li>
            <li>
              <a class="text-white" href="{{ route('status.index')}}">
                <i class="bi bi-bell mr-2"></i>
               Status
              </a>
            </li>
            
                
            @endif
           
          </div>
        </div>
        <section  id="main-content">
          <div class="sticky-top">
           
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 p-4 static-top  ">

          
          <button class="btn btn-primary" id="button-toggle">
            <i class="bi bi-list"></i>
          </button>
          <div class="col-11">
            <a href="{{ route('logout') }}" class="btn btn-outline-danger me-2  float-right  ">Logout</a>
          </div>
          </nav>
          
            
          </div>
         
          <div class="card-body mt-2 p-4" >
              @yield('content')
             
            
              
            </body>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            {{-- <script>
                
              
            </script> --}}
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
            
        @include('includes/js')
        
        </div>
        </section>
        
       
        

        {{-- @yield('footerjs') --}}
        
        </body>
        </html>