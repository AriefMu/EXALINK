
<div class="modal fade" id="edit{{$row->id}}"aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pengajuan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalbody">
         
            <input type="hidden" name="id" value="{{$row->id}}">
            <div class="form-group">
                <label class="font-weight-bold">NAMA KEGIATAN</label>
                <input  class="form-control @error('nama_kegiatan') is-invalid @enderror" value="{{ old('nama_kegiatan',$row->namakeg) }}" name="namakeg" placeholder="Masukkan Nama Kegiatan" readonly>                                                           
            </div>
            <div class="form-group">
              <label class="font-weight-bold">NAMA RUANG</label>
              <div class="row">
                <div class="col-12">
              <select  class="livesearch5 form-control @error('ruang_id') is-invalid @enderror "  name="ruang_id" style="width:100%" disabled>
              <option value="{{old('ruang_id',$row->rid)}}" selected>{{$row->ruang}}</option>
            </select>
                </div>
              </div>
            </div>
            <div class="row">,
              <div class='col'>
                 <div class="form-group">
                   <label for="mulai" class="font-weight-bold">MULAI</label>
                    <div class='input-group' >
                       <input type='datetime-local' id="mulai" class="form-control" name="mulai"  value="{{ old('mulai', $row->mulai ) }}" readonly/>
                       
                       
                    </div>
                 </div>
              </div>
               </div>
          
              
              
                  
       <div class="form-group">
        
           <label class="font-weight-bold">DURASI (Dalam jam)</label>
           <input type="number" class="form-control @error('durasi') is-invalid @enderror" name="durasi" rows="5" placeholder="Masukkan Durasi" min="1" max="24" value="{{ old('durasi',round((strtotime($row->selesai) - strtotime($row->mulai))/3600))}}" readonly/>
         
        
       <div class="form-group mt-2">
      <label class="font-weight-bold">PENANGGUNG JAWAB</label> 
           
<div class="row">
          <div class="col">
               <select  class="livesearch6 form-control @error('penanggung_jawab') is-invalid @enderror"  name="penanggung_jawab" style="width: 100%" disabled>
              <option value="{{old('penanggungjawab',$row->penanggungjawab)}}">{{$row->penanggungjawab}}</option>
              </select>
          </div>
        </div>
          
       </div>
       <div class="form-group mt-2">
        <label class="font-weight-bold">ALASAN</label> 
             
  <div class="row">
            <div class="col">
              <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="20" readonly>{{$row->alasan}}</textarea>
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
       
        <div class="modal-footer">
          <div class="container text-center">
          <div class="row justify-content-center">
          
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
          {{-- <div class="col">
          <button type="submit" class="btn btn-primary">Simpan</button>
          </div> --}}
         
          @if($row->status == 'tolak' and $row->uid == Auth::user()->id)
          <div class="row">
            
            <a href="{{ url('pinjam/ajukan/'.$row->id) }}" class="btn btn-sm btn-secondary my-3" >Ajukan Kembali</a>
            
          </div>
          @endif
              
          
          
           
          </div>
        
      </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
 
  <script>
    var idtb= "{{$row->id}}";
    var idmodal='#edit'+idtb;
   
    $('.livesearch5').select2({
    //  let id = $(this).attr('data-attr'),
   
    dropdownParent: "#modalbody",
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
      // dropdownParent: $(".modal-body")
      dropdownParent: "#modalbody",
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
        $(document).ready(function(){
    $('.deletePinjamBtn').click(function(e){
        e.preventDefault();

        var pinjam_id = $(this).val();
        $('#pinjam_id').val(pinjam_id);
        $('#deleteModal').modal('show');
    });
    $('#closePinjamBtn').click(function(e){
        $('#deleteModal').modal('hide');
    });
});       
$(document).ready(function(){
    $('.tolakPinjamBtn').click(function(e){
        e.preventDefault();

        var pinjam_tolak_id = $(this).val();
        $('#pinjam_tolak_id').val(pinjam_tolak_id);
        $('#tolakModal').modal('show');
    });
    $('#closeTolakBtn').click(function(e){
        $('#tolakeModal').modal('hide');
    });
});       


</script>