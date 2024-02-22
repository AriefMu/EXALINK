@extends('layout/default')
@section('title','Peminjaman Ruang')
@section('content')

        

    <div class="container  mb-5">
        {{ Breadcrumbs::render('pinjamtambah') }}
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('pinjam.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">NAMA KEGIATAN</label>
                            
                                <input  class="form-control @error('nama_kegiatan') is-invalid @enderror" value="{{ old('nama_kegiatan') }}" name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan">                                                           
                            </div>
                            {{-- <div class="form-group">
                                <label class="font-weight-bold">NAMA PEMINJAM</label>
                                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id"  value="{{ old('user_id') }}">
                                    <option value="" disabled selected>--Pilih Nama Peminjam--</option>
                                    @foreach($user as $row)
                                    <option value="{{$row->id}}">{{$row->pegawai->nama}}</option>
                                    @endforeach
                                </select>
                              
                            </div> --}}
                            <div class="form-group">
                                <label class="font-weight-bold">NAMA RUANG</label>
                                <br>
                                <select style="width:700px" class="livesearch11 form-control p-3 @error('ruang_id') is-invalid @enderror mx-5"  name="ruang_id"></select>
                                {{-- <select  class="form-control @error('ruang_id') is-invalid @enderror" name="ruang_id"  value="{{ old('ruang_id') }}">
                                    <option value="" disabled selected>--Pilih Nama Ruang--</option>
                                    @foreach($ruang as $row)
                                    <option value="{{$row->id}}">{{$row->nama}}</option>
                                    @endforeach
                                </select> --}}
                               
                            </div>
                                    <div class="row">,
                                   <div class='col-sm-3'>
                                      <div class="form-group">
                                        <label for="mulai" class="font-weight-bold">MULAI</label>
                                         <div class='input-group' >
                                            <input  class="form-control @error('mulai') is-invalid @enderror"  type='datetime-local' id="mulai" class="form-control" name="mulai"  value="{{ old('mulai') }}"/>
                                            
                                            
                                         </div>
                                      </div>
                                   </div>
                                    </div>
                               
                                    </div>
                                   
                                        <div class='col-sm-3'>
                            <div class="form-group">
                               
                                <label class="font-weight-bold">DURASI (Dalam jam)</label>
                                <input type="number" class="form-control @error('durasi') is-invalid @enderror" name="durasi" rows="5" placeholder="Masukkan Durasi" min="1" max="24"  value="{{ old('durasi') }}"/>
                              
                                </div>
                            </div>
                            <div class='col-sm-12'>
                            <div class="form-group">
                                <label class="font-weight-bold">PENANGGUNG JAWAB</label>
                                {{-- <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror" name="penanggung_jawab"  rows="5" placeholder="Masukkan Penanggung Jawab"  value="{{ old('penanggung_jawab') }}"> --}}
                            </br>
                                    <select style="width:700px" class="livesearch10 form-control p-3 @error('penanggung_jawab') is-invalid @enderror"  name="penanggung_jawab"></select>
                             
                               
                            </div>
                        </div>
                        <div class='col-sm-12 mb-5'>
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.livesearch10').select2({
            placeholder: 'Pilih Penanggung Jawab',
            value:"{{ old('penanggung_jawab') }}",
            ajax: {
                url: '/ajax-autocomplete-search2',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.nip_baru+" "+item.nama,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('.livesearch11').select2({
            placeholder: 'Pilih Ruang',
            value:"{{ old('ruang') }}",
            ajax: {
                url: '/ajax-autocomplete-search3',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text:item.nama,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>

@endsection