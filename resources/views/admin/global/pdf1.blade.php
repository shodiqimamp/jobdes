<html>
    <style>
        h5{            
            font-size:18px;
        }   
        .headTable{
            color:#00008B;            
        }
        .marginTable{
            height:18px;
        }

        td{
            padding-left:4px;
            padding-right:4px;
        }
    </style>
    <body>
           
        <table>
            <tr><td style="text-align:center; color:#00008B; font-size:17px;font-weight: bold;">URAIAN JABATAN</td></tr>
            <tr>
                <td style="text-align:center; color:#00008B; font-size:17px; font-weight: bold;">PT INDONESIA COMNETS PLUS</td>
            </tr>
        </table>     
        <table><tr style="height:50px"><td></td></tr></table>
        <table border="1" cellpadding="4">
            <tr>
                <td colspan="6" class="headTable" ><b>1.  IDENTIFIKASI JABATAN</b></td>
            </tr>
            <tr>
                <td style="width:126px">Nama Jabatan</td>
                <td style="width:15px;">:</td>
                <td style="width:150px">{{$jd->nama_jabatan}}</td>
                <td style="width:112px">Tanggal</td>
                <td style="width:15px;">:</td>
                <td style="width:121px">{{$jd->tanggal_disetujui}}</td>
            </tr>
            <tr>
                @php 
                $dir = $detailJabatan->direktorat;
                $arr = explode(' ',trim($dir));
                @endphp 
                <td>ID Jabatan</td>
                <td>:</td>
                <td>{{$jd->id_jabatan}}</td>
                <td>Direktorat</td>
                <td>:</td>
                @if($arr[0] == 'Direktorat')
                <td>{{substr($detailJabatan->direktorat,11)}}</td>
                @else 
                <td>{{$detailJabatan->direktorat}}</td>
                @endif                                                
            </tr>
            <tr>
                <td>Atasan Langsung</td>
                <td>:</td>
                <td>{{$detailJabatan->atasan_langsung}}</td>
                <td>Divisi/Satuan/SBU</td>
                <td>:</td>
                <td>{{$detailJabatan->divisi}}</td>
            </tr>
            <tr>
                <td>Atasan Tidak Langsung</td>
                <td>:</td>
                <td>{{$detailJabatan->atasan_tidak_langsung}}</td>
                <td>Bidang</td>
                <td>:</td>                            
                @php 
                $dat = $detailJabatan->bidang;
                $arr = explode(' ',trim($dat));
                @endphp 
                @if($arr[0] == 'Bidang')
                <td>{{substr($detailJabatan->bidang, 7)}}</td>
                @else 
                <td>{{$detailJabatan->bidang}}</td>
                @endif                 
            </tr>
            <tr>
                <td>Lokasi Kerja</td>
                <td>:</td>
                <td>{{$jd->lokasi_kerja}}</td>
                <td>Sub Bidang</td>
                <td>:</td>
                
                @php 
                $dat = $detailJabatan->sub_bidang;
                $arr = explode(' ',trim($dat));
                @endphp 
                @if($arr[0] == 'Sub' && $arr[1] == 'Bidang')
                <td>{{substr($detailJabatan->sub_bidang,11)}}</td>
                @else 
                <td>{{$detailJabatan->sub_bidang}}</td>
                @endif
                
            </tr>            
        </table>
        <table><tr class="marginTable"><td></td></tr></table>
        <table border="1" cellpadding="4">
            <tr><td colspan="3" class="headTable"><b>2.  PERSETUJUAN</b></td></tr>
            <tr>
                <td style="text-align:center" class="headTable"><b>Disiapkan oleh:</b></td>
                <td style="text-align:center" class="headTable"><b>Direview oleh:</b></td>
                <td style="text-align:center" class="headTable"><b>Disetujui oleh:</b></td>
            </tr>
            <tr style="height:100px">
                <td style="text-align:center"><img src="img/approve.png" style="height:50px; width:auto;"></td>
                <td style="text-align:center"><img src="img/approve.png" style="height:50px; width:auto;"></td>
                <td style="text-align:center"><img src="img/approve.png" style="height:50px; width:auto;"></td>
            </tr>
            <tr>
                <td class="headTable">Nama: {{$jd->nama_pic}} <br>Jabatan : {{$jabatanPic->nama_jabatan}} </td>
                <td class="headTable">Nama: {{$jd->nama_approval}} <br>Jabatan : {{$jabatanApproval->nama_jabatan}}</td>
                <td class="headTable">Nama: {{$jd->nama_reviewer}} <br>Jabatan : {{$jabatanReviewer->nama_jabatan}}</td>                
            </tr>
        </table>
        <table><tr class="marginTable"><td></td></tr></table>
        <table border="1" cellpadding="4">
            <tr nobr="true"><td class="headTable"><b>3.  TUJUAN JABATAN</b></td></tr>
            <tr nobr="true"><td>{{$jd->tujuan_jabatan}}</td></tr>        
        </table>
        <table><tr class="marginTable"><td></td></tr></table>
        <table border="1" cellpadding="4">
            <tr nobr="true"><td colspan="2" class="headTable"><b>4.  TANGGUNG JAWAB UTAMA</b></td></tr>
            <tr nobr="true">
                <td style="text-align:center; font-size:9px;background-color:#ADD8E6;" class="headTable"><b>TANGGUNG JAWAB UTAMA</b></td>
                <td style="text-align:center; font-size:9px;background-color:#ADD8E6;" class="headTable"><b>INDKATOR KINERJA</b></td>
            </tr>
            
            @for($i=0; $i<count($spanTj);$i++)   
                @php
                    $newLine = true;
                @endphp                                
                @for($j=0; $j<count($tgJawab);$j++)                         
                    @if($tgJawab[$j]->tj_utama == $spanTj[$i]->tj_utama)
                        @if($newLine)
                        <tr nobr="true">
                            <td rowspan="{{$spanTj[$i]->row_span}}">{{$tgJawab[$j]->tj_utama}}</td>
                            <td>{{$tgJawab[$j]->indikator_kinerja}}</td>
                        </tr>             
                        @php $newLine=false; @endphp   
                        @else 
                        <tr nobr="true">                            
                            <td>{{$tgJawab[$j]->tj_utama}}</td>
                        </tr>             
                        @endif                                    
                    @endif                            
                @endfor
            @endfor
        </table>
        <table><tr class="marginTable"><td></td></tr></table>
        <table border="1" cellpadding="4" nobr="true"> 
            <tr nobr="true"><td colspan="2" class="headTable"><b>5.  DIMENSI JABATAN</b></td></tr>
            <tr nobr="true"><td colspan="2" class="headTable"><b>5.a. Dimensi Keuangan:</b></td></tr>
            <tr>
                <td style="text-align:center;" class="headTable">Lingkup Dimensi</td>
                <td style="text-align:center;" class="headTable">Jumlah</td>
            </tr>
            <tr nobr="true">
                <td>Capex</td>
                <td style="text-align:right; padding-right:20px">Rp  {{number_format($jd->anggaran_capex,0,',','.')}}</td>
            </tr>
            <tr nobr="true">
                <td>Opex</td>
                <td style="text-align:right; padding-right:20px">Rp   {{number_format($jd->anggaran_opex,0,',','.')}}</td>
            </tr>
            <tr nobr="true">
                <td>Target Pendapatan</td>
                <td style="text-align:right; padding-right:20px">Rp   {{number_format($jd->target_pendapatan,0,',','.')}}</td>
            </tr>            
            <tr nobr="true"><td colspan="2" class="headTable"><b>5.a. Dimensi Non Keuangan:</b></td></tr>
            <tr nobr="true">
                <td style="text-align:center;" class="headTable">Deskripsi</td>
                <td style="text-align:center;" class="headTable">Jumlah</td>
            </tr>
            <!-- <tr nobr="true">
                <td>Engineer</td>
                <td>{{$jd->jumlah_engineer}} Orang</td>
            </tr>
            <tr nobr="true">
                <td>Officer</td>
                <td>{{$jd->jumlah_officer}} Orang</td>
            </tr>
            <tr nobr="true">
                <td>TKO</td>
                <td>{{$jd->jumlah_tko}} Orang</td>
            </tr> -->
            @foreach($bawahan as $data)
            <tr nobr="true">
                <td>Jumlah {{$data->deskripsi}}</td>
                <td>{{$data->jumlah}}  {{$data->satuan}}</td>
            </tr>
            @endforeach
            @foreach($nonKeu as $data)
            <tr nobr="true">
                <td>{{$data->deskripsi}}</td>
                <td>{{$data->jumlah}}  {{$data->satuan}}</td>
            </tr>
            @endforeach
           
        </table>                              
        <table><tr class="marginTable"><td></td></tr></table>     
        <table border="1" cellpadding="4" nobr="true">
            <tr nobr="true"><td colspan="2" class="headTable"><b>6.  HUBUNGAN KERJA</b></td></tr>            
            <tr nobr="true">
                <td style="text-align:center;" class="headTable">Internal</td>
                <td style="text-align:center;" class="headTable">Tujuan</td>
            </tr>                 
            @for($i=0; $i<count($spanInternal);$i++)   
                @php
                    $newLine = true;
                @endphp                                
                @for($j=0; $j<count($hubKerjaInternal);$j++)                         
                    @if($hubKerjaInternal[$j]->hk == $spanInternal[$i]->hk)
                        @if($newLine)
                        <tr nobr="true">
                            <td rowspan="{{$spanInternal[$i]->row_span}}">{{$hubKerjaInternal[$j]->hk}}</td>
                            <td>{{$hubKerjaInternal[$j]->tujuan}}</td>
                        </tr>             
                        @php $newLine=false; @endphp   
                        @else 
                        <tr nobr="true">                            
                            <td>{{$hubKerjaInternal[$j]->tujuan}}</td>
                        </tr>             
                        @endif                                    
                    @endif                            
                @endfor
            @endfor
            <tr nobr="true">
                <td style="text-align:center;" class="headTable">External</td>
                <td style="text-align:center;" class="headTable">Tujuan</td>
            </tr> 
            @for($i=0; $i<count($spanExternal);$i++)   
                @php
                    $newLine = true;
                @endphp                                
                @for($j=0; $j<count($hubKerjaExternal);$j++)                         
                    @if($hubKerjaExternal[$j]->hk == $spanExternal[$i]->hk)
                        @if($newLine)
                        <tr nobr="true">
                            <td rowspan="{{$spanExternal[$i]->row_span}}">{{$hubKerjaExternal[$j]->hk}}</td>
                            <td>{{$hubKerjaExternal[$j]->tujuan}}</td>
                        </tr>             
                        @php $newLine=false; @endphp   
                        @else 
                        <tr nobr="true">                            
                            <td>{{$hubKerjaExternal[$j]->tujuan}}</td>
                        </tr>             
                        @endif                                    
                    @endif                            
                @endfor
            @endfor
        </table>               
        <table><tr class="marginTable"><td></td></tr></table>     
        <table border="1" cellpadding="4">
            <tr nobr="true"><td class="headTable"><b>7.  KEWENANGAN</b></td></tr>
            @foreach($kewenangan as $data)
            <tr nobr="true"><td>-   {{$data->name}}</td></tr>
            @endforeach
        </table>                  
        <table><tr class="marginTable"><td></td></tr></table>     
        <table border="1" cellpadding="4">
            <tr nobr="true"><td class="headTable"><b>8.  TANTANGAN JABATAN</b></td></tr>
            @foreach($tantanganJabatan as $data)
            <tr nobr="true"><td>-   {{$data->name}}</td></tr>
            @endforeach
        </table>                
        <table><tr class="marginTable"><td></td></tr></table>     
        <table border="1" cellpadding="3" nobr="true">
            <tr nobr="true"><td colspan="2" class="headTable"><b>9.  SPESIFIKASI JABATAN</b></td></tr>            
            <tr nobr="true">
                <td style="text-align:center;" class="headTable">Pendidikan dan Pengalaman</td>
                <td style="text-align:center;" class="headTable">Pengetahuan, Keterampilan, Kemampuan & Kompetensi</td>
            </tr>
            <tr nobr="true">
                <td><b>- Pendidikan Formal(min):</b> {{$jd->pendidikan}}<br><br><b>- Pengalaman (min):</b> {{$jd->pengalaman}} Tahun<br><br><b>- Seritifikasi:</b>
                        @foreach($sertifikasi as $data)
                            {{$data->name}},
                        @endforeach<br><br><b>- Pelatihan Wajib:</b>
                        @foreach($pelatihanWajib as $data)
                            {{$data->name}},
                        @endforeach<br><br>
                </td>
                <td><b>- Pengetahuan:</b>
                        @foreach($pengetahuan as $data)
                            {{$data->name}},
                        @endforeach<br><br><b>- Ketrampilan:</b>
                        @foreach($keahlian as $data)
                            {{$data->name}},
                        @endforeach<br><br><b>- Komptensi:</b>
                        @foreach($kompetensi as $data)
                            {{$data->name}},
                        @endforeach<br><br>
                </td>
            </tr>            
        </table>      
    </body>
</html>