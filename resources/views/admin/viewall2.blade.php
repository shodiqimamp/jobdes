@extends('admin/admin')
@section('judul_halaman','All Job Description')
@section('content')
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"> Identifikasi Jabatan</h6>
      </div>
      <div class="card-body">
          <br>
          <div class="row">
              <div class="col-lg-5">
                  <div class="form-group">
                      <label for="email">Direktorat</label>
                      <select class="form-control  form-control-sm selectpicker allData" required id="direktorat" name="direktorat">
                          <option disabled="disabled" selected="selected" value="">Pilih direktorat</option>
                          @foreach($dir as $direktorat )
                          <option value="{{$direktorat->direktorat}}">{{$direktorat->direktorat}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="divis">Divisi/Satuan/SBU</label>
                      <select class="form-control form-control-sm allData"   id="divisi" name="divisi">
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="email">Bidang</label>
                      <select class="form-control form-control-sm allData"  required id="bidang" name="bidang">
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="email">Sub Bidang</label>
                      <select class="form-control form-control-sm allData"  required id="subBidang" name="subBidang">
                      </select>
                  </div>                  
              </div>
              <div class="col-lg-1"></div>
              <div class="col-lg-5">         
                  <div class="form-group">
                      <label for="email">Nama Jabatan</label>
                      <select class="form-control form-control-sm  allData"  required id="namaJabatan" name="namaJabatan">
                      </select>
                  </div>                           
                  <div class="form-group">
                      <label for="email">Atasan Langsung</label>
                      <input type="text" class="form-control form-control-sm" id="atasanLangsung" name="atasanLangsung" readonly>
                  </div>
                  <div class="form-group">
                      <label for="email">Atasan Tidak Langsung</label>
                      <input type="text" class="form-control form-control-sm" id="atasanTidakLangsung" name="atasanTidakLangsung" readonly>
                      <input type="hidden" class="form-control form-control-sm" id="idJabatan" name="idJabatan">
                  </div>
                  <div class="row justify-content-center mt-lg-5">
                        <div class="col-4">
                            <button class="btn btn-info btn-block btn-sm" id="btnView">View</button>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-4">
                            <button class="btn btn-success btn-sm btn-block" id="btnPDF">PDF</button>
                        </div>                                            
                  </div>                  
              </div>
          </div>
      </div>
  </div>
@endsection
@section('modals')
  <div class="modal" id="modalViewJobDesc" tabindex="-1" role="dialog" aria-labelledby="modalViewJobDesc" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nama Jabatan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">                                
                    @include('admin.global.viewjs')          
              </div>
          </div>
      </div>
  </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('myjs/viewjsajax.js')}}"></script>
    <script type="text/javascript">
        function clearKetJabatan(){
            $('#atasanTidakLangsung').val("");
            $('#atasanLangsung').val("");  
            $('#idJabatan').val("");    
        }
        function convertToRupiah(angka){
            var rupiah = '';		
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }
        $(document).ready(function() {
            $("#divisi").prop('disabled', true);
            $("#bidang").prop('disabled', true);
            $("#subBidang").prop('disabled', true);
            $("#namaJabatan").prop('disabled', true);

            $('#direktorat').change(function(){
                $.ajax({
                    type: "GET",
                    url: "{{url('getDivisi')}}"+"/"+$("#direktorat").val(),
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){
                        $("#divisi").prop('disabled', false);
                        $("#bidang").prop('disabled', true);
                        $("#subBidang").prop('disabled', true);
                        $("#namaJabatan").prop('disabled', true);

                        $("#divisi").children().remove();
                        $("#bidang").children().remove();
                        $("#subBidang").children().remove();
                        $("#namaJabatan").children().remove();
                        $('#divisi').append('<option value="" disabled="disabled" selected="selected">Pilih Divisi</option>');
                        for(var i=0; i<response.data.length; i++){
                            $('#divisi').append('<option value="'+response.data[i].divisi+'">'+response.data[i].divisi+'</option>');
                        }                      
                        clearKetJabatan()  
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    }
                });
            });

            $('#divisi').change(function(){
                $.ajax({
                    type: "GET",
                    url: "{{url('getDivisi')}}"+"/"+$("#direktorat").val()+"/getBidang/"+$("#divisi").val(),
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                            e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){

                        $("#bidang").prop('disabled', false);
                        $("#subBidang").prop('disabled', true);
                        $("#namaJabatan").prop('disabled', true);

                        $("#bidang").children().remove();
                        $("#subBidang").children().remove();
                        $("#namaJabatan").children().remove();

                        $('#bidang').append('<option value="" disabled="disabled" selected="selected">Pilih Bidang</option>');
                        for(var i=0; i<response.data.length; i++){
                            $('#bidang').append('<option value="'+response.data[i].bidang+'">'+response.data[i].bidang+'</option>');
                        }   
                        clearKetJabatan()                     
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    }
                });
            });

            $('#bidang').change(function(){

                $.ajax({
                    type: "GET",
                    url: "{{url('getDivisi')}}"+"/"+$("#direktorat").val()+"/getBidang/"+$("#divisi").val()+"/getSubbidang/"+$("#bidang").val(),
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){

                        $("#subBidang").prop('disabled', false);
                        $("#namaJabatan").prop('disabled', true);

                        $("#subBidang").children().remove();
                        $("#namaJabatan").children().remove();

                        $('#subBidang').append('<option value="" disabled="disabled" selected="selected">Pilih Sub Bidang</option>');
                        for(var i=0; i<response.data.length; i++){
                            $('#subBidang').append('<option value="'+response.data[i].sub_bidang+'">'+response.data[i].sub_bidang+'</option>');
                        }               
                        clearKetJabatan()         
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    }
                });
            });

            $('#subBidang').change(function(){

                $.ajax({
                    type: "GET",
                    url: "{{url('getDivisi')}}"+"/"+$("#direktorat").val()+"/getBidang/"+$("#divisi").val()+"/getSubbidang/"+$("#bidang").val()+"/getJabatan/"+$("#subBidang").val(),
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){

                        $("#namaJabatan").prop('disabled', false);

                        $("#namaJabatan").children().remove();

                        $('#namaJabatan').append('<option value="" disabled="disabled" selected="selected">Pilih Jabatan</option>');
                        for(var i=0; i<response.data.length; i++){
                            $('#namaJabatan').append('<option value="'+response.data[i].nama_jabatan+'">'+response.data[i].nama_jabatan+'</option>');
                        }     
                        clearKetJabatan()                   
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    }
                });
            });

            $('#namaJabatan').change(function(){
                $.ajax({
                    type: "GET",
                    url: "{{url('getDivisi')}}"+"/"+$("#direktorat").val()+"/getBidang/"+$("#divisi").val()+"/getSubbidang/"+$("#bidang").val()+"/getJabatan/"+$("#subBidang").val()+"/jabatan/"+$('#namaJabatan').val(),
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){               
                        $('#atasanLangsung').val(response.data[0].atasan_langsung);
                        $('#atasanTidakLangsung').val(response.data[0].atasan_tidak_langsung);
                        $('#idJabatan').val(response.data[0].id_jabatan);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    }
                });
            });

            $('#btnView').click(function(){                     
              if($('#namaJabatan').val() != null){
                $.ajax({
                    type: "GET",
                    url: "{{url('get-data-job')}}"+"/"+$('#idJabatan').val(),
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){
                      if(response.status=="success"){
                        setData(response);
                        $('#modalViewJobDesc').modal('show');
                      }else {
                        alert("Job Desc pada posisi jabatan "+$('#namaJabatan').val()+" untuk tahun ini belum tersedia");
                      }                            
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    }
                });
              } else {
                alert("Silahkan pilih jabatan terlebih dahulu");
              }
              

            });

            $('#btnPDF').click(function(){
                if($('#namaJabatan').val() != null){
                    $.ajax({
                        type: "GET",
                        url: "{{url('get-data-job')}}"+"/"+$('#idJabatan').val(),
                        dataType: "json",
                        beforeSend: function(e) {
                            if(e && e.overrideMimeType) {
                            e.overrideMimeType("application/json;charset=UTF-8");
                            }
                        },
                        success: function(response){
                        if(response.status=="success"){                                                        
                            window.open("{{url('view-pdf')}}"+"/"+response.jd.id);
                        }else {
                            alert("Job Desc pada posisi jabatan "+$('#namaJabatan').val()+" untuk tahun ini belum tersedia");
                        }                            
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                        }
                    });
              } else {
                alert("Silahkan pilih jabatan terlebih dahulu");
              }                               
            });

        })
    </script>
@endsection
