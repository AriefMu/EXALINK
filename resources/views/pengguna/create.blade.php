@extends('layout/default')
@section('title','Pengguna')
@section('content')

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('pengguna.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf
                            <div class="form-group mt-2">
                                <label class="font-weight-bold">PENANGGUNG JAWAB</label> 
                                     {{-- <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror" name="penanggung_jawab"  rows="5" placeholder="Masukkan Penanggung Jawab"  value="{{ old('penanggung_jawab') }}"> --}}
                          <div class="row">
                                    <div class="col">
                                         <select  class="livesearch7 form-control @error('penanggung_jawab') is-invalid @enderror"  name="penanggung_jawab" style="width: 100%"></select>
                                    </div>
                                  </div>
                                    
                                 </div>
                            <div class="form-group">
                                <label class="font-weight-bold">NAMA PENGGUNA</label>
                                <select class="form-control @error('nip') is-invalid @enderror" name="nip"  value="{{ old('nip') }}">
                                    <option value="" disabled selected>--Pilih Nama Pengguna--</option>
                                    @foreach($pegawai as $row)
                                    <option value="{{$row->nip_baru}}">{{$row->nama}}</option>
                                    @endforeach
                                </select>
                            
                               
                                </div>
                            <div class="form-group">
                                <label class="font-weight-bold">ROLE</label>
                                <select class="form-control @error('role') is-invalid @enderror" name="role"  value="{{ old('role') }}">
                                    <option value="" disabled selected>--Pilih Role--</option>
                                    
                                    <option value="admin">ADMIN</option>
                                    <option value="user">USER</option>
                                </select>
                              
                            </div>                                 
                            <div class="form-group">
                                <label class="font-weight-bold">USERNAME</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"  rows="5" placeholder="Masukkan Username"  value="{{ old('username') }}">
                            
                               
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">PASSWORD</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror" name="password"  rows="5" placeholder="Masukkan Password"  value="{{ old('password') }}">
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $('.livesearch7').select2({
        // dropdownParent: $(".modal-body")
        // dropdownParent: "#modalbody",
              placeholder: 'Pilih Penanggung Jawab',
             
              ajax: {
                  url: '/ajax-autocomplete-search2',
                  dataType: 'json',
                  delay: 250,
                  processResults: function (data) {
                      return {
                          results: $.map(data, function (item) {
                              return {
                                  text: item.nip_baru+" "+item.nama,
                                  id: item.nama
                              }
                          })
                      };
                  },
                  cache: true
              }
          });
</script>
@endsection