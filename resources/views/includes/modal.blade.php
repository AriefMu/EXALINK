<div class="modal fade" id="addNew" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengajuan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('pinjam.store') }}" method="POST" enctype="multipart/form-data">
                        
            @csrf

            <div class="form-group">
                <label class="font-weight-bold">NAMA KEGIATAN</label>
                <input  class="form-control @error('nama_kegiatan') is-invalid @enderror" value="{{ old('nama_kegiatan') }}" name="nama_kegiatan" placeholder="Masukkan Nama Kegiatan">                                                           
            </div>
            <div class="form-group">
              <label class="font-weight-bold">NAMA RUANG</label>
              <div class="row">
                <div class="col-12">
              <select  class="livesearch2 form-control @error('ruang_id') is-invalid @enderror "  name="ruang_id" style="width:100%"></select>
                </div>
              </div>
            </div>
            <div class="row">,
              <div class='col'>
                 <div class="form-group">
                   <label for="mulai" class="font-weight-bold">MULAI</label>
                    <div class='input-group' >
                       <input class="form-control @error('mulai') is-invalid @enderror" type='datetime-local' id="mulai" class="form-control" name="mulai"  value="{{ old('mulai') }}"/>
                       
                       
                    </div>
                 </div>
              </div>
               </div>
          
              
              
                  
       <div class="form-group">
        
           <label class="font-weight-bold">DURASI (Dalam jam)</label>
           <input type="number" class="form-control @error('durasi') is-invalid @enderror" name="durasi" rows="5" placeholder="Masukkan Durasi" min="1" max="24"  value="{{ old('durasi') }}"/>
         
        
      
       <div class="form-group mt-2">
      <label class="font-weight-bold">PENANGGUNG JAWAB</label> 
           {{-- <input type="text" class="form-control @error('penanggung_jawab') is-invalid @enderror" name="penanggung_jawab"  rows="5" placeholder="Masukkan Penanggung Jawab"  value="{{ old('penanggung_jawab') }}"> --}}
<div class="row">
          <div class="col">
               <select  class="livesearch form-control @error('penanggung_jawab') is-invalid @enderror"  name="penanggung_jawab" style="width: 100%"></select>
          </div>
        </div>
          
       </div>
  
          
         
         {{-- {!! Form::open(['url'=>'save'])!!}
         <div class="mb-3">
          {!! Form::label('namakeg','Nama Kegiatan')!!}
          {!! Form::text('namakeg','',['class'=>'form-control','placeholder'=>'Masukkan Nama Kegiatan','required']) !!}
         </div>
         <div class="mb-3">
          {!! Form::label('ruang_id','Nama Ruang')!!}
          {!! Form::select('ruang_id','',['class'=>'livesearch2 form-control','placeholder'=>'Masukkan Nama Kegiatan','required']) !!}
         </div> --}}
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
     $('.livesearch').select2({
      // dropdownParent: $(".modal-body")
      dropdownParent: "#addNew",
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
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        
  $('.livesearch2').select2({
    dropdownParent: "#addNew",
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
</script>