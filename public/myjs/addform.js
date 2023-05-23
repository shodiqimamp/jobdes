$('[data-toggle="tooltip"]').tooltip();
$('#addTanggungJawab').click(function(e){          
    $form = $('#addField');
    $form.append("<div class='row'><div class='col-lg-6 mb-4'><div class='form-group'><textarea class='form-control form-control-sm allData' id='tanngunJawab' rows='2' name='tanggungJawab[]' placeholder='Tanggung Jawab Utama' required></textarea></div></div><div class='col-lg-6 mb-4'> <div class='row'><div class='col-lg-11'><div class='form-group'><textarea class='form-control form-control-sm allData' id='indikatorKinerja' rows='2' placeholder='Indikator Kinerja' name='indikatorKinerja[]' required></textarea></div></div><div class='col-lg-1'><i class='remove_tanggung_jawab fas fa-times float-right' style='color:red'></i></div></div></div></div>");                               
});

$('#addField').on('click', '.remove_tanggung_jawab', function(e){
    e.preventDefault();
    $tagRemove = $( this ).parent().parent().parent().parent( "div");
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_tanggung_jawab").val();
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {
        $tagRemoveType = "TANGGUNG JAWAB";            
        $('div#warningMessage').html($warningMessage+" tanggung jawab ?");
        $('#deleteModal').modal('toggle');     
    }
});

$('#addHubInternal').click(function(e){          
    $form = $('#fieldHubInternal');
    $form.append("<div class='row'><div class='col-lg-5 mb-4'><div class='form-group'><textarea class='form-control form-control-sm allData' id='internal' rows='2' name='internal[]' placeholder='Internal' required></textarea></div></div><div class='col-lg-7 mb-4'> <div class='row'><div class='col-lg-11'><div class='form-group'><textarea class='form-control form-control-sm allData' id='tujuanInternal' rows='2' placeholder='Tujuan' name='tujuanInternal[]' required></textarea></div></div><div class='col-lg-1'><i class='remove_internal fas fa-times float-right' style='color:red'></i></div></div></div></div>");                               
});

$('#fieldHubInternal').on('click', '.remove_internal', function(e){
    e.preventDefault();
    $tagRemove = $( this ).parent().parent().parent().parent( "div");
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_internal").val();
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {
        $tagRemoveType = "HUBUNGAN KERJA";            
        $('div#warningMessage').html($warningMessage+" internal ?");
        $('#deleteModal').modal('toggle');     
    }            
});

$('#addHubExternal').click(function(e){          
    $form = $('#fieldHubExternal');
    $form.append("<div class='row'><div class='col-lg-5 mb-4'><div class='form-group'><textarea class='form-control form-control-sm allData' id='external' rows='2' name='external[]' placeholder='External' required></textarea></div></div><div class='col-lg-7 mb-4'> <div class='row'><div class='col-lg-11'><div class='form-group'><textarea class='form-control form-control-sm allData' id='tujuanExternal' rows='2' placeholder='Tujuan' name='tujuanExternal[]' required></textarea></div></div><div class='col-lg-1'><i class='remove_external fas fa-times float-right' style='color:red'></i></div></div></div></div>");    
    
});

$('#fieldHubExternal').on('click', '.remove_external', function(e){
    e.preventDefault();
    $tagRemove = $( this ).parent().parent().parent().parent( "div");
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_external").val();
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {
        $tagRemoveType = "HUBUNGAN KERJA";            
        $('div#warningMessage').html($warningMessage+" external ?");
        $('#deleteModal').modal('toggle');     
    }
    
});


$('#addKewenangan').click(function(e){          
    $form = $('#addFieldKewenangan');
    $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control form-control-sm allData' id='kewenangan' name='kewenangan[]' placeholder='Kewenangan'></div></div><div class='col-lg-1'><i class='remove_kewenangan fas fa-times float-right' style='color:red'></i></div></div>");                                 
});

$('#addFieldKewenangan').on('click', '.remove_kewenangan', function(e){
    e.preventDefault();            
    $tagRemove = $( this ).parent().parent( "div");
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_kewenangan").val();
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {
        $tagRemoveType = "KEWENANGAN";            
        $('div#warningMessage').html($warningMessage+" kewenangan ?");
        $('#deleteModal').modal('toggle');     
    }
});

$('#addJabatan').click(function(e){          
    $form = $('#addFieldJabatan');
    $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control form-control-sm allData' id='tantanganJabatan' name='tantanganJabatan[]' placeholder=''></div></div><div class='col-lg-1'><i class='remove_jabatan fas fa-times float-right' style='color:red'></i></div></div>");                                           
});

$('#addFieldJabatan').on('click', '.remove_jabatan', function(e){
    e.preventDefault();
    $tagRemove = $( this ).parent().parent( "div");
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_tantangan_jabatan").val();
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {
        $tagRemoveType = "TANTANGANJABATAN";            
        $('div#warningMessage').html($warningMessage+" tantangan jabatan ?");
        $('#deleteModal').modal('toggle');     
    }
});

$('#addSertifikasi').click(function(e){          
    $form = $('#fieldSertifikasi');
    $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control form-control-sm allData' id='sertifikasi' name='sertifikasi[]' placeholder=''></div></div><div class='col-lg-1'><span class='btn btn-danger btn-sm remove_sertifikasi'><i class='fas fa-times'></i></span></div></div>");                                           
});

$('#fieldSertifikasi').on('click', '.remove_sertifikasi', function(e){
    e.preventDefault();
    $tagRemove = $( this ).parent().parent( "div");            
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_sertifikasi").val();
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {
        $tagRemoveType = "SPESIFIKASI";
        $('div#warningMessage').html($warningMessage+" sertifikasi ?");
        $('#deleteModal').modal('toggle');                              
    }
});

$('#addPelatihan').click(function(e){          
    $form = $('#fieldPelatihan');
    $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control form-control-sm allData' id='pelatihan' name='pelatihan[]' placeholder=''></div></div><div class='col-lg-1'><span class='btn btn-danger btn-sm remove_pelatihan'><i class='fas fa-times'></i></span></div></div>");                                           
});

$('#fieldPelatihan').on('click', '.remove_pelatihan', function(e){
    e.preventDefault();
    $tagRemove = $( this ).parent().parent( "div");            
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_pelatihan").val();
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {
        $tagRemoveType = "SPESIFIKASI";
        $('div#warningMessage').html($warningMessage+" pelatihan wajib ?");
        $('#deleteModal').modal('toggle');                              
    }
});

$('#addPengetahuan').click(function(e){           
    $form = $('#fieldPengetahuan');
    $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control form-control-sm allData' id='pengetahuan' name='pengetahuan[]' placeholder=''></div></div><div class='col-lg-1'><i class='remove_pengetahuan fas fa-times' style='color:red'></i></div></div>");                                           
});

$('#fieldPengetahuan').on('click', '.remove_pengetahuan', function(e){
    e.preventDefault();
    $tagRemove = $( this ).parent().parent( "div");
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_pengetahuan").val();
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {
        $tagRemoveType = "SPESIFIKASI";            
        $('div#warningMessage').html($warningMessage+" pengetahuan ?");
        $('#deleteModal').modal('toggle');                              
    }
});

$('#addKompetensi').click(function(e){          
    $form = $('#fieldKompetensi');
    $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control form-control-sm allData' id='kompetensi' name='kompetensi[]' placeholder=''></div></div><div class='col-lg-1'><i class='remove_kompetensi fas fa-times' style='color:red'></i></div></div>");                                           
});

$('#fieldKompetensi').on('click', '.remove_kompetensi', function(e){
    e.preventDefault();
    $tagRemove = $( this ).parent().parent( "div");            
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_kompetensi").val();
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {
        $tagRemoveType = "SPESIFIKASI";
        $('div#warningMessage').html($warningMessage+" kompetensi ?");
        $('#deleteModal').modal('toggle');                               
    }
    
    
});

$('#addKeahlian').click(function(e){          
    $form = $('#fieldKeahlian');
    $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control form-control-sm allData' id='keahlian' name='keahlian[]' placeholder=''></div></div><div class='col-lg-1'><i class='remove_keahlian fas fa-times' style='color:red'></i></div></div>");                                           
});

$('#fieldKeahlian').on('click', '.remove_keahlian', function(e){
    e.preventDefault();
    $tagRemove = $( this ).parent().parent( "div");
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_keahlian").val();            
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {                
        $tagRemoveType = "SPESIFIKASI";
        $('div#warningMessage').html($warningMessage+" keahlian ?");
        $('#deleteModal').modal('toggle');                                   
    }                
});


// $('#addNewDimensi').click(function(e){
//     $form = $('#fieldDimensi');
//     $form.append("<div class='row'><div class='col-lg-5'><div class='form-group'><input type='text' class='form-control form-control-sm allData' id='deskripsi' name='deskripsi[]' placeholder='deskripsi'></div></div><div class='col-lg-2'><div class='form-group'><input type='number' class='form-control form-control-sm allData' id='jumlah' name='jumlah[]' placeholder='jumlah'></div></div><div class='col-lg-4'><div class='row'><div class='col-lg-7'><div class='form-group'><select class='form-control form-control-sm allData' id='satuan' name='satuan[]'><option selected disabled>Pilih Satuan</option>@foreach($satuan as $sat )<option value='{{$sat->name}}'y>{{$sat->name}}</option>@endforeach</select></div></div></div></div><div class='col-lg-1'><span class='btn btn-danger btn-sm remove_dimensi'><i class='fas fa-times'></i></span></div></div>");
// });

$('#addNewDimensi').click(function(e){
    $.ajax({
        type: "GET",
        url: '/job_description/public/get-satuan',
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
            $form.append("<div class='row'><div class='col-lg-5'><div class='form-group'><input type='text' class='form-control form-control-sm allData' id='deskripsi' name='deskripsi[]' placeholder='deskripsi'></div></div><div class='col-lg-2'><div class='form-group'><input type='text' class='form-control form-control-sm allData' id='jumlah' name='jumlah[]' placeholder='jumlah'></div></div><div class='col-lg-4'><div class='row'><div class='col-lg-7'><div class='form-group'><select class='form-control form-control-sm allData classSatuan' id='satuan' name='satuan[]'><option selected disabled>Pilih Satuan</option>"+$add+"</select></div></div></div></div><div class='col-lg-1'><span class='btn btn-danger btn-sm remove_dimensi'><i class='fas fa-times'></i></span></div></div>");
            
        },
        error: function (xhr, ajaxOptions, thrownError) {
        }
    });
});

$('#fieldDimensi').on('click', '.remove_dimensi', function(e){
    e.preventDefault();
    $tagRemove = $( this ).parent().parent( "div");
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_nonKeu").val();
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {
        $tagRemoveType = "DIMENSI";            
        $('div#warningMessage').html($warningMessage+" non keuangan ?");
        $('#deleteModal').modal('toggle');     
    }                
});

$('#addNewBawahan').click(function(e){                             
    $form = $('#fieldBawahan');
    $form.append("<div class='row'><div class='col-lg-5'><div class='form-group'><select class='form-control form-control-sm allData classSatuan' id='jenisBawahan' name='jenisBawahan[]'><option selected disabled>Pilih Jenjang</option><option value='Manager'>Manager</option><option value='Supervisor'>Supervisor</option><option value='Officer'>Officer</option><option value='Engineer'>Engineer</option><option value='TKO'>TKO</option></select></div></div><div class='col-lg-2'><div class='form-group'><input type='number' class='form-control form-control-sm allData' id='jumlahBawahan' name='jumlahBawahan[]' placeholder='jumlah'></div></div><div class='col-lg-4'><div class='row'><div class='col-lg-7'><div class='form-group'><input type='text' class='form-control form-control-sm' value='Orang' readonly></div></div></div></div><div class='col-lg-1'><span class='btn btn-danger btn-sm remove_bawahan'><i class='fas fa-times'></i></span></div></div>");                     
});

$('#fieldBawahan').on('click', '.remove_bawahan', function(e){
    e.preventDefault();
    $tagRemove = $( this ).parent().parent( "div");
    $valTagRemove=$( this ).parent().parent( "div").children("#h_id_bawahan").val();
    if (typeof $valTagRemove === "undefined") {
        $tagRemove.remove();  
    }else {
        $tagRemoveType = "BAWAHAN";            
        $('div#warningMessage').html($warningMessage+" jumlah sdm yang d kelola ?");
        $('#deleteModal').modal('toggle');     
    }                
});