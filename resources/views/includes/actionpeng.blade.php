<div class="modal fade" id="EditPeng{{$row->id}}" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pengguna</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body" id="modalbody">
          
            <form action="{{ route('pengguna.update',$row->id) }}" method="POST" enctype="multipart/form-data">
                        
                @csrf
                @method('PUT')
                {{-- <div class="form-group mt-2">
                    <label class="font-weight-bold">PENANGGUNG JAWAB</label>  --}}
                         {{-- <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror" name="penanggung_jawab"  rows="5" placeholder="Masukkan Penanggung Jawab"  value="{{ old('penanggung_jawab') }}"> --}}
              {{-- <div class="row">
                        <div class="col">
                             <select  class="livesearch7 form-control @error('penanggung_jawab') is-invalid @enderror"  name="penanggung_jawab" style="width: 100%"></select>
                        </div>
                      </div>
                        
                     </div> --}}
                <div class="form-group">
                    <label class="font-weight-bold">NAMA PENGGUNA</label>
                    <select data-dropdown-parent="#EditPeng{{$row->id}}" class="livesearch10 form-control @error('nip') is-invalid @enderror" name="nip"  style="width: 100%">
                        {{-- <option value="" disabled selected>--Pilih Nama Pengguna--</option>
                        @foreach($pegawai as $row)
                        
                        @endforeach --}}
                        <option value="{{old('nip',$row->nip_baru)}}" selected>{{$row->pegawai->nama}}</option>
                    </select>
                
                   
                    </div>
                <div class="form-group">
                    <label class="font-weight-bold">ROLE</label>
                    <select class="form-control @error('role') is-invalid @enderror" name="role"  value="{{ old('role') }}">
                        <option value="" disabled selected>Pilih Role</option>
                        @if($row->role == 'admin')
                        <option value="admin" selected>ADMIN</option>
                        <option value="user">USER</option>                            
                        @else
                        <option value="admin" >ADMIN</option>
                        <option value="user" selected>USER</option>           
                        @endif
                    </select>
                                             
            </div>
      

            
        <div class="modal-footer ">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">

$('.livesearch10').select2({
        // dropdownParent: $(".modal-body")
        // theme: 'bootstrap',
        // dropdownParent: "#modalbody",
              placeholder: 'Pilih Nama Pengguna',
            
              ajax: {
                
                  url: '/ajax-auto',
                  dataType: 'json',
                  delay: 250,
                  processResults: function (data) {
                      return {
                          results: $.map(data, function (item) {
                              return {
                                  text: item.nama,
                                  id: item.nip_baru
                              }
                          })
                      };
                  },
                  cache: true
              }
          });
</script>