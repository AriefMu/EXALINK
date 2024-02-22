<div class="modal fade" id="addNewPeng" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="layar modal-body">
            <form action="{{ route('pengguna.store') }}" method="POST" enctype="multipart/form-data">
                        
                @csrf
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
                    <select class="livesearch7 form-control @error('nip') is-invalid @enderror" name="nip"  value="{{ old('nip') }}" style="width: 100%">
                        {{-- <option value="" disabled selected>--Pilih Nama Pengguna--</option>
                        @foreach($pegawai as $row)
                        <option value="{{$row->nip_baru}}">{{$row->nama}}</option>
                        @endforeach --}}
                    </select>
                
                   
                    </div>
                <div class="form-group">
                    <label class="font-weight-bold">ROLE</label>
                    <select class="form-control @error('role') is-invalid @enderror" name="role"  value="{{ old('role') }}">
                        <option value="" disabled selected>Pilih Role</option>
                        
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
              

            
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <script>

$('.livesearch7').select2({
        // dropdownParent: $(".modal-body")
        dropdownParent: ".layar",
              placeholder: 'Pilih Nama Pengguna',
             
              ajax: {
                  url: '/ajax-autocomplete-search4',
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
</script>