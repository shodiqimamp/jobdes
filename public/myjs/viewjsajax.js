function setData(data, textStatus, XMLHttpRequest){    
    $('#tblIdJabatan').html($('#idJabatan').val());
    $('#tblNamaJabatan').html($('#namaJabatan').val());
    $('#tblAtasanLangsung').html($('#atasanLangsung').val());
    $('#tblAtasanTidakLangsung').html($('#atasanTidakLangsung').val());
        
    $('#tblTujuanJabatan').html(data.jd.tujuan_jabatan);
    $('#tblCapex').html("Rp " +convertToRupiah(data.jd.anggaran_capex));
    $('#tblOpex').html("Rp "+convertToRupiah(data.jd.anggaran_opex));
    // $('#tblOfficer').html(data.jd.jumlah_officer+" Orang");
    // $('#tblTko').html(data.jd.jumlah_tko+" Orang");
    // $('#tblEngineer').html(data.jd.jumlah_engineer+" Orang");
    $('#tblPendapatan').html("Rp "+convertToRupiah(data.jd.target_pendapatan));
    $('#tblPendidikan').html(data.jd.pendidikan);
    $('#tblPengalaman').html(data.jd.pengalaman+" Tahun");
    
    $tanggungJawab = data.tgJawab;       
    $('#tblTanggungJawab').empty();
    for(var i = 0; i<$tanggungJawab.length; i++){
        $('#tblTanggungJawab').append('<tr><td>'+$tanggungJawab[i].tj_utama+'</td><td>'+$tanggungJawab[i].indikator_kinerja+'</td></tr>');
    }

    $internal = data.hubKerjaInternal;
    $('#tblHkInternal').empty();
    for(var i = 0; i<$internal.length; i++){
        $('#tblHkInternal').append('<tr><td>'+$internal[i].hk+'</td><td>'+$internal[i].tujuan+'</td></tr>');
    }    

    $external = data.hubKerjaExternal;                        
    $('#tblHkExternal').empty();
    for(var i = 0; i<$external.length; i++){
        $('#tblHkExternal').append('<tr><td>'+$external[i].hk+'</td><td>'+$external[i].tujuan+'</td></tr>');
    }

    $tantanganJabatan = data.tantanganJabatan;            
    $('#tblTantanganJabatan').empty();
    for(var i = 0; i<$tantanganJabatan.length; i++){
        $('#tblTantanganJabatan').append('<tr><td>'+$tantanganJabatan[i].name+'</td></tr>');               
    }            

    $kewenangan = data.kewenangan; 
    $('#tblKewenangan').empty();       
    for(var i = 0; i<$kewenangan.length; i++){                
        $('#tblKewenangan').append('<tr><td>'+(i+1)+'</td><td>'+$kewenangan[i].name+'</td></tr>');               
    } 

    $bawahan = data.bawahan;
    $('#tblNonKeu .bawahan').empty();       
    for(var i = 0; i<$bawahan.length; i++){  
        if($bawahan[i].deskripsi != 'Pilih Jenjang'){
            $('#tblNonKeu').append('<tr class="bawahan"><td style="float: right; vertical-align:top">Jumlah'+$bawahan[i].deskripsi+'</td><td>:</td><td style="float: left;">'+$bawahan[i].jumlah+'  Orang</td></tr>');               
        }                      
    } 

    $des = data.nonKeu;    
    $('#tblNonKeu .des').empty();       
    for(var i = 0; i<$des.length; i++){                
        $('#tblNonKeu').append('<tr class="des"><td style="float: right;">'+$des[i].deskripsi+'</td><td>:</td><td style="float: left;">'+$des[i].jumlah+'  '+$des[i].satuan+'</td></tr>');
    } 

    $('#tblSpec .spec').empty();
    $sertifikasi = data.sertifikasi;                    
    for(var i = 0; i<$sertifikasi.length; i++){                
        if(i == 0){
            $('#tblSertifikasi').html('- '+$sertifikasi[i].name);                    
        }else {
            $('<tr class="spec"><td style="float: right;"></td><td></td><td style="float: left;" >- '+$sertifikasi[i].name+'</td></tr>').insertAfter($('#rowSertifikasi'));
        }                
    }
    
    $pelatihan = data.pelatihanWajib;
    for(var i = 0; i<$pelatihan.length; i++){                
        if(i == 0){
            $('#tblPelatihan').html('- '+$pelatihan[i].name);                    
        }else {
            $('<tr class="spec"><td style="float: right;"></td><td></td><td style="float: left;" >- '+$pelatihan[i].name+'</td></tr>').insertAfter($('#rowPelatihan'));
        }                
    }
    $pengetahuan = data.pengetahuan;
    for(var i = 0; i<$pengetahuan.length; i++){                
        if(i == 0){
            $('#tblPengetahuan').html('- '+$pengetahuan[i].name);                    
        }else {
            $('<tr class="spec"><td style="float: right;"></td><td></td><td style="float: left;" >- '+$pengetahuan[i].name+'</td></tr>').insertAfter($('#rowPengetahuan'));
        }                
    }
    $keahlian = data.keahlian;
    for(var i = 0; i<$keahlian.length; i++){                
        if(i == 0){
            $('#tblKeahlian').html('- '+$keahlian[i].name);                    
        }else {
            $('<tr class="spec"><td style="float: right;"></td><td></td><td style="float: left;" >- '+$keahlian[i].name+'</td></tr>').insertAfter($('#rowKeahlian'));
        }                
    }

    $kompetensi = data.kompetensi;
    for(var i = 0; i<$kompetensi.length; i++){                
        if(i == 0){
            $('#tblKompetensi').html('- '+$kompetensi[i].name);                    
        }else {
            $('<tr class="spec"><td style="float: right;"></td><td></td><td style="float: left;" >- '+$kompetensi[i].name+'</td></tr>').insertAfter($('#rowKompetensi'));
        }                
    }


    
}