@extends('admin/admin')
@section('judul_halaman','Input Job Description')
@section('content')
@include('admin/global/forminput')
@endsection
@section('modals')
    @include('admin.global.modaladdsatuan')
@endsection

@section('scripts')

    <script type="text/javascript" src="{{asset('myjs/rupiahformat.js')}}"></script>
    <script type="text/javascript" src="{{asset('dist/js/jquery.smartWizard.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="{{asset('myjs/viewjs.js')}}"></script>
    <script type="text/javascript">
        
        function clearKetJabatan(){
            $('#idJabatan').val("");
            $('#atasanLangsung').val("");
            $('#atasanTidakLangsung').val("");
        }
        
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
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
                        clearKetJabatan();
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
                        clearKetJabatan();
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
                        clearKetJabatan();
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
                        clearKetJabatan();
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
                        $('#idJabatan').val(response.data[0].id_jabatan);
                        $('#atasanLangsung').val(response.data[0].atasan_langsung);
                        $('#atasanTidakLangsung').val(response.data[0].atasan_tidak_langsung);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    }
                });
            });

            $('#btnSave').click(function(e){
                var result = confirm("Are you sure?");
                if (result) {
                    // $("#loadModal").modal('show');

                    var fd = new FormData();
                    $x = $('.allData');
                    for (var i = 0; i < $x.length; i++) {
                        fd.append($x[i].name, $x[i].value);
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'addJobDesc',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // $("#loadModal").modal('hide');
                            if(response.status == "success"){                                
                                swal({
                                    title: "Data Berhasil Disimpan",
                                    type: "success"
                                }).then (function() {
                                    window.location.href = "{{url('/')}}";
                                });
                            } else if(response.status == "error") {
                                alert(response.msg.join("\n"));                                
                            }else if(response.status == "exist") {
                                alert(response.msg);
                            }
                        }
                    });
                }
            });

            $('#btnSaveSatuan').click(function(){
                var fd = new FormData();
                var satuan = $('#addSatuan').val();        
                if(satuan != ""){
                    fd.append('satuan', satuan);
                    $.ajax({
                        type: 'POST',
                        url: 'save-satuan',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#modalSatuan').modal('hide');
                            if(response.status == "success"){
                                swal({
                                    title: "Satuan Berhasil Disimpan",
                                    type: "success"
                                }).then (function() {                                    
                                    $satuans = $('textarea[name^="satuan"]');                                    
                                        for(var j=0; j<response.data.length; j++){                                            
                                            $('.classSatuan').append('<option value="'+response.data[j].name+'">'+response.data[j].name+'</option>');
                                        }
                                });
                            } 
                        }
                    });
                } else {
                    alert('Field satuan tidak boleh kosong');
                }
            });

            // Smart Wizard
            $('#smartwizard').smartWizard({
                    selected: 0,
                    theme: 'dots',
                    transitionEffect:'fade',
                    showStepURLhash: true,
                    keyboardSettings: {
                        keyNavigation: false,
                        keyLeft: [37], // Left key code
                        keyRight: [39] // Right key code
                    },
                    lang: {
                        next: 'Next',
                        previous: 'Previous'
                    },
            });

            $('#smartwizard').on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                if(stepNumber == "6" && stepDirection == "forward") {                
                    setSummary();
                }                                
            });

            $("#lsNamaJabatan").change(function(){
                $('#namaJabatan').val($("#lsNamaJabatan option:selected").text());
                $('#h_nama_jabatan').val($("#lsNamaJabatan option:selected").text());

            });

            $('#addTanggungJawab').click(function(e){
                $form = $('#addField');
                $form.append("<div class='row'><div class='col-lg-6'><div class='form-group border'><textarea class='form-control allData' id='tanngungJawab' rows='2' name='tanggungJawab[]' placeholder='Tanggung Jawab Utama' required></textarea></div></div><div class='col-lg-6'> <div class='row'><div class='col-lg-11'><div class='form-group'><textarea class='form-control allData' id='indikatorKinerja' rows='2' placeholder='Indikator Kinerja' name='indikatorKinerja[]' required></textarea></div></div><div class='col-lg-1'><i class='remove_button fas fa-times float-right' style='color:red'></i></div></div></div></div>");
            });

            $('#addField').on('click', '.remove_button', function(e){
                e.preventDefault();
                $( this ).parent().parent().parent().parent( "div").remove();

            });

            $('#addNewBawahan').click(function(e){
                             
                $form = $('#fieldBawahan');
                $form.append("<div class='row'><div class='col-lg-5'><div class='form-group'><select class='form-control form-control-sm allData classSatuan' id='jenisBawahan' name='jenisBawahan[]'><option selected disabled>Pilih Jenjang</option><option value='Manager'>Manager</option><option value='Supervisor'>Supervisor</option><option value='Officer'>Officer</option><option value='Engineer'>Engineer</option><option value='TKO'>TKO</option></select></div></div><div class='col-lg-2'><div class='form-group'><input type='number' class='form-control form-control-sm allData' id='jumlahBawahan' name='jumlahBawahan[]' placeholder='jumlah'></div></div><div class='col-lg-4'><div class='row'><div class='col-lg-7'><div class='form-group'><input type='text' class='form-control form-control-sm' value='Orang' readonly></div></div></div></div><div class='col-lg-1'><span class='btn btn-danger btn-sm remove_bawahan'><i class='fas fa-times'></i></span></div></div>");
                                 
            });

            $('#fieldBawahan').on('click', '.remove_bawahan', function(e){
                e.preventDefault();
                $( this ).parent().parent( "div").remove();
                

            });

            $('#addNewDimensi').click(function(e){
                $.ajax({
                    type: "GET",
                    url: "{{url('get-satuan')}}",
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){
                        $add="";
                        for(var i=0; i<response.data.length; i++){
                            $add=$add+("<option value='"+response.data[i].name+"'>"+response.data[i].name+"</option>");
                        }                        
                        $form = $('#fieldDimensi');
                        $form.append("<div class='row'><div class='col-lg-5'><div class='form-group'><input type='text' class='form-control form-control-sm allData' id='deskripsi' name='deskripsi[]' placeholder='deskripsi'></div></div><div class='col-lg-2'><div class='form-group'><input type='number' class='form-control form-control-sm allData' id='jumlah' name='jumlah[]' placeholder='jumlah'></div></div><div class='col-lg-4'><div class='row'><div class='col-lg-7'><div class='form-group'><select class='form-control form-control-sm allData classSatuan' id='satuan' name='satuan[]'><option selected disabled>Pilih Satuan</option>"+$add+"</select></div></div></div></div><div class='col-lg-1'><span class='btn btn-danger btn-sm remove_dimensi'><i class='fas fa-times'></i></span></div></div>");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    }
                });                
            });

            $('#fieldDimensi').on('click', '.remove_dimensi', function(e){
                e.preventDefault();
                $( this ).parent().parent( "div").remove();                
            });

            $('#addHubInternal').click(function(e){
                $form = $('#fieldHubInternal');
                $form.append("<div class='row'><div class='col-lg-5'><div class='form-group'><textarea class='form-control allData' id='internal' rows='2' name='internal[]' placeholder='Internal' required></textarea></div></div><div class='col-lg-7'> <div class='row'><div class='col-lg-11'><div class='form-group'><textarea class='form-control allData' id='tujuanInternal' rows='2' placeholder='Tujuan' name='tujuanInternal[]' required></textarea></div></div><div class='col-lg-1'><i class='remove_internal fas fa-times float-right' style='color:red'></i></div></div></div></div>");
            });

            $('#fieldHubInternal').on('click', '.remove_internal', function(e){
                e.preventDefault();
                $( this ).parent().parent().parent().parent( "div").remove();

            });

            $('#addHubExternal').click(function(e){
                $form = $('#fieldHubExternal');
                $form.append("<div class='row'><div class='col-lg-5'><div class='form-group'><textarea class='form-control allData' id='external' rows='2' name='external[]' placeholder='External' required></textarea></div></div><div class='col-lg-7'> <div class='row'><div class='col-lg-11'><div class='form-group'><textarea class='form-control allData' id='tujuanExternal' rows='2' placeholder='Tujuan' name='tujuanExternal[]' required></textarea></div></div><div class='col-lg-1'><i class='remove_external fas fa-times float-right' style='color:red'></i></div></div></div></div>");

            });

            $('#fieldHubExternal').on('click', '.remove_external', function(e){
                e.preventDefault();
                $( this ).parent().parent().parent().parent( "div").remove();
            });

            $('#addKewenangan').click(function(e){
                $form = $('#addFieldKewenangan');
                $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control allData' id='kewenangan' name='kewenangan[]' placeholder='Kewenangan' required></div></div><div class='col-lg-1'><i class='remove_kewenangan fas fa-times float-right' style='color:red'></i></div></div>");
            });

            $('#addFieldKewenangan').on('click', '.remove_kewenangan', function(e){
                e.preventDefault();
                $( this ).parent().parent( "div").remove();
            });

            $('#addJabatan').click(function(e){
                $form = $('#addFieldJabatan');
                $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control allData' id='jabatan' name='tantanganJabatan[]' placeholder='Tantangan Jabatan' required></div></div><div class='col-lg-1'><i class='remove_jabatan fas fa-times float-right' style='color:red'></i></div></div>");
            });

            $('#addFieldJabatan').on('click', '.remove_jabatan', function(e){
                e.preventDefault();
                $( this ).parent().parent( "div").remove();
            });

            $('#addSertifikasi').click(function(e){
                $form = $('#fieldSertifikasi');
                $form.append("<div class='row'><div class='col-lg-10'><div class='form-group'><input type='text' class='form-control allData' id='sertifikasi' name='sertifikasi[]' placeholder='' required></div></div><div class='col-lg-1'><span class='remove_sertifikasi btn btn-danger btn-sm'><i class='fas fa-times'></i></span>");
            });

            $('#fieldSertifikasi').on('click', '.remove_sertifikasi', function(e){
                e.preventDefault();
                $( this ).parent().parent( "div").remove();
            });

            $('#addPelatihan').click(function(e){
                $form = $('#fieldPelatihan');
                $form.append("<div class='row'><div class='col-lg-10'><div class='form-group'><input type='text' class='form-control allData' id='sertifikasi' name='pelatihan[]' placeholder='' required></div></div><div class='col-lg-1'><span class='remove_pelatihan btn btn-danger btn-sm'><i class='fas fa-times'></i></span></div></div>");
            });

            $('#fieldPelatihan').on('click', '.remove_pelatihan', function(e){
                e.preventDefault();
                $( this ).parent().parent( "div").remove();
            });

            $('#addPengetahuan').click(function(e){
                $form = $('#fieldPengetahuan');
                $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control allData' id='pengetahuan' name='pengetahuan[]' placeholder='' required></div></div><div class='col-lg-1'><i class='remove_pengetahuan fas fa-times' style='color:red'></i></div></div>");
            });

            $('#fieldPengetahuan').on('click', '.remove_pengetahuan', function(e){
                e.preventDefault();
                $( this ).parent().parent( "div").remove();
            });

            $('#addKompetensi').click(function(e){
                $form = $('#fieldKompetensi');
                $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control allData' id='kompetensi' name='kompetensi[]' placeholder='' required></div></div><div class='col-lg-1'><i class='remove_kompetensi fas fa-times' style='color:red'></i></div></div>");
            });

            $('#fieldKompetensi').on('click', '.remove_kompetensi', function(e){
                e.preventDefault();
                $( this ).parent().parent( "div").remove();
            });

            $('#addKeahlian').click(function(e){
                $form = $('#fieldKeahlian');
                $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control allData' id='keahlian' name='keahlian[]' placeholder='' required></div></div><div class='col-lg-1'><i class='remove_keahlian fas fa-times' style='color:red'></i></div></div>");
            });

            $('#fieldKeahlian').on('click', '.remove_keahlian', function(e){
                e.preventDefault();
                $( this ).parent().parent( "div").remove();
            });
        });
    </script>
@endsection
