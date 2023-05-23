<html>
    <style>

        .headTable{
            color:#00008B;            
        }
        .marginTable{
            height:20px;
        }

        td{
            padding-left:4px;
            padding-right:4px;
        }
    </style>
    <body>  
        <h5></h5>          
        <table border="1" cellpadding="3">
            <tr><td colspan="2" class="headTable"><b>5.  DIMENSI JABATAN</b></td></tr>
            <tr><td colspan="2" class="headTable"><b>5.a. Dimensi Keuangan:</b></td></tr>
            <tr>
                <td style="text-align:center;" class="headTable">Lingkup Dimensi</td>
                <td style="text-align:center;" class="headTable">Jumlah</td>
            </tr>
            <tr>
                <td>Capex</td>
                <td style="text-align:right; padding-right:20px">Rp  {{number_format($jd->anggaran_capex,0,',','.')}}</td>
            </tr>
            <tr>
                <td>Opex</td>
                <td style="text-align:right; padding-right:20px">Rp   {{number_format($jd->anggaran_opex,0,',','.')}}</td>
            </tr>
            <tr>
                <td>Target Pendapatan</td>
                <td style="text-align:right; padding-right:20px">Rp   {{number_format($jd->target_pendapatan,0,',','.')}}</td>
            </tr>            
            <tr><td colspan="2" class="headTable"><b>5.a. Dimensi Non Keuangan:</b></td></tr>
            <tr>
                <td style="text-align:center;" class="headTable">Deskripsi</td>
                <td style="text-align:center;" class="headTable">Jumlah</td>
            </tr>
            @foreach($nonKeu as $data)
            <tr>
                <td>{{$data->deskripsi}}</td>
                <td>{{$data->jumlah}}  {{$data->satuan}}</td>
            </tr>
            @endforeach
           
        </table>                              
        <table><tr class="marginTable"><td></td></tr></table>     
        <table border="1" cellpadding="3">
            <tr><td colspan="2" class="headTable"><b>6.  HUBUNGAN KERJA</b></td></tr>            
            <tr>
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
                        <tr>
                            <td rowspan="{{$spanInternal[$i]->row_span}}">{{$hubKerjaInternal[$j]->hk}}</td>
                            <td>{{$hubKerjaInternal[$j]->tujuan}}</td>
                        </tr>             
                        @php $newLine=false; @endphp   
                        @else 
                        <tr>                            
                            <td>{{$hubKerjaInternal[$j]->tujuan}}</td>
                        </tr>             
                        @endif                                    
                    @endif                            
                @endfor
            @endfor
            <tr>
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
                        <tr>
                            <td rowspan="{{$spanExternal[$i]->row_span}}">{{$hubKerjaExternal[$j]->hk}}</td>
                            <td>{{$hubKerjaExternal[$j]->tujuan}}</td>
                        </tr>             
                        @php $newLine=false; @endphp   
                        @else 
                        <tr>                            
                            <td>{{$hubKerjaExternal[$j]->tujuan}}</td>
                        </tr>             
                        @endif                                    
                    @endif                            
                @endfor
            @endfor
        </table>               
        <table><tr class="marginTable"><td></td></tr></table>     
        <table border="1" cellpadding="3">
            <tr><td class="headTable"><b>7.  KEWENANGAN</b></td></tr>
            @foreach($kewenangan as $data)
            <tr><td>-   {{$data->name}}</td></tr>
            @endforeach
        </table>                  
        <table><tr class="marginTable"><td></td></tr></table>     
        <table border="1" cellpadding="3">
            <tr><td class="headTable"><b>8.  TANTANGAN JABATAN</b></td></tr>
            @foreach($tantanganJabatan as $data)
            <tr><td>-   {{$data->name}}</td></tr>
            @endforeach
        </table>                
        <table><tr class="marginTable"><td></td></tr></table>     
        <table border="1" cellpadding="3">
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