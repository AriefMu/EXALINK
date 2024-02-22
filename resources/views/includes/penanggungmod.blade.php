<div class="modal fade" id="addNewPenanggungjawab" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Tambah Penanggung Jawab</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('penanggungjawab.store') }}" method="POST" enctype="multipart/form-data">
                        
            @csrf

            <div class="form-group">
                <label class="font-weight-bold">NAMA</label>
                <select  class="livesearch6 form-control @error('nama') is-invalid @enderror"  name="nama" style="width: 100%" >
                  {{-- <option value="{{old('penanggungjawab',$row->penanggungjawab)}}">{{$row->penanggungjawab}}</option> --}}
                  </select>
            
                <!-- error message untuk title -->
                @error('nama')
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
    dropdownParent: "#addNewPenanggungjawab",
          placeholder: 'Pilih Penanggung Jawab',
         
          ajax: {
              url: '/ajax-autocomplete-search5',
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