<div class="modal fade" id="addNewLantai" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Lantai</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('lantai.store') }}" method="POST" enctype="multipart/form-data">
                        
            @csrf

            <div class="form-group">
                <label class="font-weight-bold">NAMA</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Lantai">
            
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