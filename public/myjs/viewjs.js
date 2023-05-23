function setSummary(){
    $('#tblIdJabatan').html($('#idJabatan').val());
    $('#tblNamaJabatan').html($('#namaJabatan').val());
    $('#tblAtasanLangsung').html($('#atasanLangsung').val());
    $('#tblAtasanTidakLangsung').html($('#atasanTidakLangsung').val());
    $('#tblNamaJabatan').html($('#namaJabatan').val());
    $('#tblTujuanJabatan').html($('#tujuanJabatan').val());
    $('#tblCapex').html("Rp  "+$('#capex').val());
    $('#tblOpex').html("Rp  "+$('#opex').val());
    // $('#tblOfficer').html($('#officer').val()+" Orang");
    // $('#tblTko').html($('#tko').val()+" Orang");
    // $('#tblEngineer').html($('#engineer').val()+" Orang");
    $('#tblPendapatan').html("Rp  "+$('#target').val());
    $('#tblPendidikan').html($('#pendidikan').val());
    $('#tblPengalaman').html($('#pengalaman').val());
    
    $tanggungJawab = $('textarea[name^="tanggungJawab"]');   
    $indikatorKinerja = $('textarea[name^="indikatorKinerja"]');                     
    $('#tblTanggungJawab').empty();
    for(var i = 0; i<$tanggungJawab.length; i++){
        $('#tblTanggungJawab').append('<tr><td>'+$tanggungJawab[i].value+'</td><td>'+$indikatorKinerja[i].value+'</td></tr>');
    }

    $internal = $('textarea[name^="internal"]');   
    $tujuanInternal = $('textarea[name^="tujuanInternal"]');                     
    $('#tblHkInternal').empty();
    for(var i = 0; i<$internal.length; i++){
        $('#tblHkInternal').append('<tr><td>'+$internal[i].value+'</td><td>'+$tujuanInternal[i].value+'</td></tr>');
    }    

    $external = $('textarea[name^="external"]');   
    $tujuanExternal = $('textarea[name^="tujuanExternal"]');                     
    $('#tblHkExternal').empty();
    for(var i = 0; i<$external.length; i++){
        $('#tblHkExternal').append('<tr><td>'+$external[i].value+'</td><td>'+$tujuanExternal[i].value+'</td></tr>');
    }

    $tantanganJabatan = $('input[name^="tantanganJabatan"]');            
    $('#tblTantanganJabatan').empty();
    for(var i = 0; i<$tantanganJabatan.length; i++){
        $('#tblTantanganJabatan').append('<tr><td>'+$tantanganJabatan[i].value+'</td></tr>');               
    }            

    $kewenangan = $('input[name^="kewenangan"]'); 
    $('#tblKewenangan').empty();       
    for(var i = 0; i<$kewenangan.length; i++){                
        $('#tblKewenangan').append('<tr><td></td><td>'+$kewenangan[i].value+'</td></tr>');               
    } 


    $jumBawahan = $('input[name^="jumlahBawahan"]'); 
    $jenBawahan = $('select[name^="jenisBawahan"]');             
    $('#tblNonKeu .bawahan').empty();       
    for(var i = 0; i<$jenBawahan.length; i++){  
        if($jenBawahan[i].value != 'Pilih Jenjang'){
            $('#tblNonKeu').append('<tr class="bawahan"><td style="float: right; vertical-align:top">Jumlah'+$jenBawahan[i].value+'</td><td>:</td><td style="float: left;">'+$jumBawahan[i].value+'  Orang</td></tr>');               
        }              
        
    } 

    
    $des = $('input[name^="deskripsi"]'); 
    $jum = $('input[name^="jumlah"]'); 
    $sat = $('select[name^="satuan"]'); 
    $('#tblNonKeu .des').empty();       
    for(var i = 0; i<$des.length; i++){                
        $('#tblNonKeu').append('<tr class="des"><td style="float: right; vertical-align:top">'+$des[i].value+'</td><td>:</td><td style="float: left;">'+$jum[i].value+'  '+$sat[i].value+'</td></tr>');               
    } 
    

    $('#tblSpec .spec').empty();
    $sertifikasi = $('input[name^="sertifikasi"]');                    
    for(var i = 0; i<$sertifikasi.length; i++){                
        if(i == 0){
            $('#tblSertifikasi').html('- '+$sertifikasi[i].value);                    
        }else {
            $('<tr class="spec"><td style="float: right;"></td><td></td><td style="float: left;" >- '+$sertifikasi[i].value+'</td></tr>').insertAfter($('#rowSertifikasi'));
        }                
    }
    
    $pelatihan = $('input[name^="pelatihan"]');                    
    for(var i = 0; i<$pelatihan.length; i++){                
        if(i == 0){
            $('#tblPelatihan').html('- '+$pelatihan[i].value);                    
        }else {
            $('<tr class="spec"><td style="float: right;"></td><td></td><td style="float: left;" >- '+$pelatihan[i].value+'</td></tr>').insertAfter($('#rowPelatihan'));
        }                
    }
    $pengetahuan = $('input[name^="pengetahuan"]');                    
    for(var i = 0; i<$pengetahuan.length; i++){                
        if(i == 0){
            $('#tblPengetahuan').html('- '+$pengetahuan[i].value);                    
        }else {
            $('<tr class="spec"><td style="float: right;"></td><td></td><td style="float: left;" >- '+$pengetahuan[i].value+'</td></tr>').insertAfter($('#rowPengetahuan'));
        }                
    }
    $keahlian = $('input[name^="keahlian"]');                    
    for(var i = 0; i<$keahlian.length; i++){                
        if(i == 0){
            $('#tblKeahlian').html('- '+$keahlian[i].value);                    
        }else {
            $('<tr class="spec"><td style="float: right;"></td><td></td><td style="float: left;" >- '+$keahlian[i].value+'</td></tr>').insertAfter($('#rowKeahlian'));
        }                
    }

    $kompetensi = $('input[name^="kompetensi"]');                    
    for(var i = 0; i<$kompetensi.length; i++){                
        if(i == 0){
            $('#tblKompetensi').html('- '+$kompetensi[i].value);                    
        }else {
            $('<tr class="spec"><td style="float: right;"></td><td></td><td style="float: left;" >- '+$kompetensi[i].value+'</td></tr>').insertAfter($('#rowKompetensi'));
        }                
    }


    
}