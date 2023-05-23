<div class="card shadow mb-4">
    <div class="card-body">
        <h6 style="color:black" class="mb-3 mt-3"><b>Identifikasi Jabatan</b></h6>
        <table class="table table-striped table-sm" cellspacing="0">
            <thead>
                <tr>
                    <th width=49%></th>
                    <th width=2%></th>
                    <th width=49%></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="float: right;"> Nama Jabatan</td>
                    <td>:</td>
                    <td id="tblNamaJabatan"></td>
                </tr>
                <tr>
                    <td style="float: right;">ID Jabatan</td>
                    <td>:</td>
                    <td style="float: left;" id="tblIdJabatan"></td>
                </tr>
                <tr>
                    <td style="float: right;">Atasan Langsung</td>
                    <td>:</td>
                    <td id="tblAtasanLangsung"></td>
                </tr>
                <tr>
                    <td style="float: right;">Atasan Tidak Langsung</td>
                    <td>:</td>
                    <td id="tblAtasanTidakLangsung" style="float: left;"></td>
                </tr>                            
            </tbody>
        </table>
        <br>
        <h6 style="color:black" class="mb-2 mt-3"><b>Tujuan Jabatan</b></h6>
        <table class="table table-striped table-sm"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <td id="tblTujuanJabatan"></td>                                
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <h6 style="color:black" class="mb-3 mt-3"><b>Tanggung Jawab Utama</b></h6>
        <table class="table table-striped table-sm"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">Tanggung Jawab Utama</th>
                    <th scope="col">Indikator Kinerja</th>
                </tr>
            </thead>
            <tbody id="tblTanggungJawab">

            </tbody>
        </table>
        <br>
        <h6 style="color:black" class="mb-3 mt-3"><b>Dimensi Jabatan</b></h6>
        <table class="table table-striped table-sm"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th width=49%></th>
                    <th width=2%></th>
                    <th width=49%></th>
                </tr>
            </thead>
            <tbody id="tblNonKeu">
                <tr>
                    <td style="float: right;">Anggaran Capex</td>
                    <td width="2%">:</td>
                    <td style="float: left;" id="tblCapex"></td>
                </tr>               
                <tr>
                    <td style="float: right;">Anggaran Opex</td>
                    <td>:</td>
                    <td style="float: left;" id="tblOpex"></td>
                </tr>
                <tr>
                    <td style="float: right;">Target Pendapatan</td>
                    <td>:</td>
                    <td style="float: left;" id="tblPendapatan"></td>
                </tr>
                <!-- <tr>
                    <td style="float: right;">Jumlah Officer</td>
                    <td>:</td>
                    <td id="tblOfficer" style="float: left;"></td>
                </tr>
                <tr>
                    <td style="float: right;">Jumlah TKO</td>
                    <td>:</td>
                    <td style="float: left;" id="tblTko"></td>
                </tr>
                <tr>
                    <td style="float: right;">Jumlah Engineer</td>
                    <td>:</td>
                    <td style="float: left;" id="tblEngineer"></td>
                </tr>                             -->
            </tbody>
        </table>
        <br>
        <h6 style="color:black" class="mb-3 mt-3"><b>Hubungan Kerja Internal</b></h6>
        <table class="table table-striped table-sm"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">Pihak Internal</th>
                    <th scope="col">Tujuan</th>
                </tr>
            </thead>
            <tbody id="tblHkInternal">
            </tbody>
        </table>
        <br>
        <h6 style="color:black" class="mb-3 mt-3"><b>Hubungan Kerja External</b></h6>
        <table class="table table-striped table-sm"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">Pihak External</th>
                    <th scope="col">Tujuan</th>
                </tr>
            </thead>
            <tbody id="tblHkExternal">
            </tbody>
        </table>
        <br>
        <h6 style="color:black" class="mb-3 mt-3"><b>Kewenangan</b></h6>
        <table class="table table-striped table-sm table"  width="100%" cellspacing="0">                        
            <tbody id="tblKewenangan">                            
            </tbody>
        </table>
        <br>
        <h6 style="color:black" class="mb-3 mt-3"><b>Tantangan Jabatan</b></h6>
        <table class="table table-striped table-sm"  width="100%" cellspacing="0">                        
            <tbody id="tblTantanganJabatan">                           
            </tbody>
        </table>
        <br>
        <h6 style="color:black" class="mb-3 mt-3"><b>Spesifikasi Jabatan</b></h6>
        <table class="table table-striped table-sm"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th width=49%></th>
                    <th width=2%></th>
                    <th width=49%></th>
                </tr>
            </thead>
            <tbody id="tblSpec">
                <tr>
                    <td style="float: right;">Pendidikan Formal</td>
                    <td>:</td>
                    <td style="float: left;" id="tblPendidikan"></td>
                </tr>
                <tr>
                    <td style="float: right;">Pengalaman</td>
                    <td>:</td>
                    <td style="float: left;" id="tblPengalaman"></td>
                </tr>                           
                <tr id="rowSertifikasi"> 
                    <td style="float: right;" ><b>Sertifikasi</b></td>
                    <td>:</td>
                    <td id="tblSertifikasi"></td>
                </tr>
                <tr id="rowPelatihan">
                    <td style="float: right;" ><b>Pelatihan Wajib</b></td>
                    <td>:</td>
                    <td id="tblPelatihan"></td>
                </tr>
                <tr id="rowPengetahuan">
                    <td style="float: right;" ><b>Pengetahuan</b></td>
                    <td>:</td>
                    <td id="tblPengetahuan"></td>
                </tr>
                <tr id="rowKeahlian">
                    <td style="float: right;" ><b>Keahlian</b></td>
                    <td>:</td>
                    <td id="tblKeahlian"></td>
                </tr>
                <tr id="rowKompetensi">
                    <td style="float: right;" ><b>Kompetensi</b></td>
                    <td>:</td>
                    <td id="tblKompetensi"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-3">
        @if(request()->is('inputjd') || request()->is('pengajuan/*') )
        <button class="btn btn-success mb-3 ml-3" id="btnSave"> <span class="text">Submit</span></button>
        @elseif(request()->is('edit/*'))
            @if(date('Y') ==  date('Y', strtotime($jd->created_at)))
            <button class="btn btn-success mb-3 ml-3" id="btnSave"> <span class="text">Update</span></button>  
            @else
            <button class="btn btn-success mb-3 ml-3" id="btnDuplicate"> <span class="text">Duplicate</span></button>       
            @endif
        @endif        
    </div>

</div>