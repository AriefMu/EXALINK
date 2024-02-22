@extends('layout/default')
@section('title','Peminjaman Ruang')
@section('content')
    <div class="container mb-1">
        {{ Breadcrumbs::render('ajukan',$pinjam) }}
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ url('pinjam/ajukankembali/'.$pinjam->id ) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="form-group">
                                <label class="font-weight-bold">NAMA KEGIATAN</label>
                               
                                <input type="text"  class="form-control @error('namakeg') is-invalid @enderror" name="namakeg" value="{{ old('namakeg', $pinjam->namakeg) }}" placeholder="Masukkan Nama Kegiatan">
                                
                                <!-- error message untuk title -->
                                @error('namakeg')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                            
                            <div class="form-group">
                                <label class="font-weight-bold">NAMA RUANG</label>
                                <br>
                                <select  class="livesearch5 form-control @error('ruang_id') is-invalid @enderror" name="ruang_id"  style="width: 25%">
                                    <option value="{{old('ruang_id',$pinjam->ruang_id)}}" selected>{{$pinjam->ruang->nama}}</option>
                                    @foreach($ruang as $row)
                                    <option value="{{$row->id}}">{{$row->nama}}</option>
                                    @endforeach 
                                </select>
                               
                               
                            </div>
                                    
                                  
                                      <div class="form-group">
                                        <label for="mulai" class="font-weight-bold">MULAI</label>
                                         <div class='input-group'  style="width: 25%">
                                           
                                            <input type='datetime-local' id="mulai" class="form-control" name="mulai"  value="{{ old('mulai', $pinjam->mulai ) }}" />
                                           
                                            
                                         </div>
                                      </div>
                                 
                                   
                               
                                 
                                      
                            <div class="form-group">
                               
                                <label for="mulai" class="font-weight-bold">DURASI</label>
                                
                                         <div class='input-group' style="width:25%">
                                            <input type='number' id="durasi" max="24"  class="form-control @error('durasi') is-invalid @enderror" name="durasi"  value="{{ old('durasi', round((strtotime($pinjam->selesai) - strtotime($pinjam->mulai))/3600) ) }}"/>
                                         </div>
                                            
                                
                                    
                               
                            </div>
                           
                            <div class="form-group">
                                <label class="font-weight-bold">PENANGGUNG JAWAB</label>
                                <br>
                                <select  class="livesearch6 form-control @error('penanggung_jawab') is-invalid @enderror"  name="penanggung_jawab" style="width: 25%">
                                    <option value="{{old('penanggungjawab',$pinjam->penanggungjawab)}}">{{$pinjam->penanggungjawab}}</option>
                                    </select>
                               
                            
                        </div>
                            <button type="submit" class="btn btn-md btn-primary">AJUKAN KEMBALI</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                          
                                   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // var idtb= "{{$row->id}}";
        // var idmodal='#edit'+idtb;
       
        $('.livesearch5').select2({
        //  let id = $(this).attr('data-attr'),
       
      
        placeholder: 'Pilih Ruang',
            
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
    
    
         $('.livesearch6').select2({
          
          
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