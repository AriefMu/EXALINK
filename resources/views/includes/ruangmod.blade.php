<div class="modal fade" id="addNewRuang" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Ruang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('ruang.store') }}" method="POST" enctype="multipart/form-data">
                        
            @csrf

            <div class="form-group">
                <label class="font-weight-bold">NAMA RUANG</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Ruang">
            
                <!-- error message untuk title -->
                @error('nama')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="form-group">
              <label class="font-weight-bold">LANTAI</label>
              <div class="wrapper "><select name="lantai" id="" class="form-control @error('lantai') is-invalid @enderror" style="width: 100%" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
              {{-- <input type="text" class="form-control @error('lantai') is-invalid @enderror" name="lantai" value="{{ old('lantai') }}" rows="5" placeholder="Masukkan Lantai"> --}}
              {{-- <select  class="form-control @error('lantai') is-invalid @enderror"data-dropup-auto="false" data-size="5" name="lantai"  style="width: 100%"> --}}
                {{-- <option value="" disabled selected>--Pilih Nama Pengguna--</option>
                @foreach($pegawai as $row)
                
                @endforeach --}}
                <option value="" disabled selected>--Pilih Lantai--</option>
                @foreach ($lantai as $lan)
                <option value="{{old('lantai',$lan->id)}}" >{{$lan->nama}}</option>
                @endforeach
            </select>
          </div>
        
              <!-- error message untuk content -->
              @error('lantai')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
                </div> 
        <div class="modal-footer">
          <button type="Reset" class="btn btn-secondary" >Ulang</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $('.livesearch6').select2({
      // dropdownParent: $(".modal-body")
      dropdownParent: "#addNewRuang",
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