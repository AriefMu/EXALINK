@extends('layout/default')
@section('title','Peminjaman Ruang')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
           
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('pinjam.update', $pinjam->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="col-12">
                            <div class="form-group">
                                <label class="font-weight-bold">NAMA KEGIATAN</label>
                                
                                <input type="text"  class="form-control @error('namakeg') is-invalid @enderror" name="namakeg" value="{{ old('namakeg', $pinjam->namakeg) }}" placeholder="Masukkan Nama Kegiatan">
                                </div>
                                <!-- error message untuk title -->
                                @error('namakeg')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> 
                            <div class="col-5">                           
                            <div class="form-group">
                                <label class="font-weight-bold">NAMA RUANG</label>
                                {{-- <select class="livesearch form-control p-3 @error('ruang_id') is-invalid @enderror" name="ruang_id"  rows="5" placeholder="Masukkan Penanggung Jawab"  >
                                    <option value="{{old('ruang_id',$pinjam->ruang_id)}}"selected>{{$pinjam->ruang->nama}}</option>
                                    </select> --}}
                                <select  class="form-control @error('ruang_id') is-invalid @enderror" name="ruang_id"  >
                                    <option value="{{old('ruang_id',$pinjam->ruang_id)}}" selected>{{$pinjam->ruang->nama}}</option>
                                    @foreach($ruang as $row)
                                    <option value="{{$row->id}}">{{$row->nama}}</option>
                                    @endforeach 
                                </select>
                                </div>
                               
                            </div>
                                    
                            <div class="col-3">
                                      <div class="form-group">
                                        <label for="mulai" class="font-weight-bold">MULAI</label>
                                         <div class='input-group'>
                                           
                                            <input type='datetime-local' id="mulai" class="form-control" name="mulai"  value="{{ old('mulai', $pinjam->mulai ) }}"/>
                                            </div>
                                            
                                         </div>
                                      </div>
                                 
                                   
                                      <div class="col-3">
                                      <div class="form-group">
                               
                                        <label class="font-weight-bold">DURASI (Dalam jam)</label>
                                        <input type="number" class="form-control @error('durasi') is-invalid @enderror" name="durasi" rows="5" placeholder="Masukkan Durasi" min="1" max="24"  value={{ old('durasi',round((strtotime($pinjam->selesai) - strtotime($pinjam->mulai))/3600))}} />
                                      
                                        </div>
                                      </div>
                                      <div class="col-5">
                            <div class="form-group">
                                <label class="font-weight-bold">PENANGGUNG JAWAB</label>
                              
                                <select class="livesearch form-control p-3 @error('penanggung_jawab') is-invalid @enderror" name="penanggung_jawab"  rows="5" placeholder="Masukkan Penanggung Jawab"  >
                                <option value="{{old('penanggungjawab',$pinjam->penanggungjawab)}}"selected>{{$pinjam->penanggungjawab}}</option>
                                </select>
                                
                               
                            </div>
                        </div>
                        <div class="col-5">
                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </div>
                        </form> 
                          
                                   
                    </div>
                </div>
           
        </div>
    </div>
    <script type="text/javascript">
        $('.livesearch').select2({
            
           
            ajax: {
                url: '/ajax-autocomplete-search2',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                          
                                text: item.nama,
                                id: item.nama
                            }
                        })
                    };
                },
                cache: true
            }
        });
        $('.livesearch2').select2({
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