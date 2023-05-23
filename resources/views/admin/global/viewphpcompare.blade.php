        @if($jd->feedback_admin != "")
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Revisi</h6>            
            </div>
            <div class="card-body"> 
            <h6 style="font-size:13px"><b>Admin</b></h6>
                <div class="row">                        
                    <div class="col-sm-12">
                        <textarea class="form-control form-control-sm" rows="2" readonly >{{$jd->feedback_admin}}</textarea>                
                    </div>                        
                </div>
                <br>
                <h6 style="font-size:13px"><b>User</b></h6>
                <div class="row">
                    <div class="col-sm-12">
                        <textarea class="form-control form-control-sm" name="revisi" readonly >{{$jd->revisi_atasan}}</textarea>                
                    </div>  
                </div>
            </div>        
        </div> 
        @endif
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
                        <td id="tblNamaJabatan">{{$detailJabatan->nama_jabatan}}</td>
                    </tr>
                    <tr>
                        <td style="float: right;">ID Jabatan</td>
                        <td>:</td>
                        <td style="float: left;" id="tblIdJabatan">{{$detailJabatan->id_jabatan}}</td>
                    </tr>
                    <tr>
                        <td style="float: right;">Atasan Langsung</td>
                        <td>:</td>
                        <td id="tblAtasanLangsung">{{$detailJabatan->atasan_langsung}}</td>
                    </tr>
                    <tr>
                        <td style="float: right;">Atasan Tidak Langsung</td>
                        <td>:</td>
                        <td id="tblAtasanTidakLangsung" style="float: left;">{{$detailJabatan->atasan_tidak_langsung}}</td>
                    </tr>  
                    <tr>
                        <td style="float: right;">Lokasi Kerja</td>
                        <td>:</td>
                        <td>{{$jd->lokasi_kerja}}</td>
                    </tr>                          
                </tbody>
            </table>
            <br>
            <h6 style="color:black" class="mb-2 mt-3"><b>Tujuan Jabatan</b> </h6>
            <table class="table table-striped table-sm"  width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td id="tblTujuanJabatan">{{$jd->tujuan_jabatan}}</td>                                
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="row justify-content-end pr-3">
                <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="collapse" data-target="#collTujuanJabatan" aria-expanded="false" aria-controls="collapseExample">
                    Draft
                </button>
            </div>
            
            <div class="collapse" id="collTujuanJabatan">
                <div class="card card-body">
                    {{$draft->tujuan_jabatan}}
                </div>
            </div>
            <h6 style="color:black" class="mb-3 mt-5"><b>Tanggung Jawab Utama</b></h6>
            <table class="table table-striped table-sm table-bordered"  width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">Tanggung Jawab Utama</th>
                        <th scope="col">Indikator Kinerja</th>
                    </tr>
                </thead>
                <tbody id="tblTanggungJawab">
                @for($i=0; $i<count($tgJawab); $i++)
                    <tr>
                        <td>{{$tgJawab[$i]->tj_utama}}</td>
                        <td>{{$tgJawab[$i]->indikator_kinerja}}</td>
                    </tr>
                @endfor
                </tbody>
            </table>
            <div class="row justify-content-end pr-3">
                <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="collapse" data-target="#collTanggungJawab" aria-expanded="false" aria-controls="collapseExample">
                    Draft
                </button>
            </div>
            <div class="collapse" id="collTanggungJawab">
                <div class="card">
                <div class="card-header">
                        <h7><b>Draft Tanggung Jawab</b></h7>
                    </div>
                    <table class="table table-striped table-sm table-bordered"  width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Tanggung Jawab Utama</th>
                                <th scope="col">Indikator Kinerja</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $tj = json_decode($draft->tanggung_jawab);
                            $ik = json_decode($draft->indikator_kinerja);
                        @endphp
                        @for($i=0; $i<count($tj); $i++)
                            <tr>
                                <td>{{$tj[$i]}}</td>
                                <td>{{$ik[$i]}}</td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
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
                <tbody>
                    <tr>
                        <td style="float: right;">Anggaran Capex</td>
                        <td width="2%">:</td>
                        <td style="float: left;" id="tblCapex">{{number_format($jd->anggaran_capex,2,",",".")}}</td>
                    </tr>
                    <tr>
                        <td style="float: right;">Target Pendapatan</td>
                        <td>:</td>
                        <td style="float: left;" id="tblPendapatan">{{number_format($jd->target_pendapatan,2,",",".")}}</td>
                    </tr>
                    <tr>
                        <td style="float: right;">Anggaran Opex</td>
                        <td>:</td>
                        <td style="float: left;" id="tblOpex">{{number_format($jd->anggaran_opex,2,",",".")}}</td>
                    </tr>
                    <!-- <tr>
                        <td style="float: right;">Jumlah Officer</td>
                        <td>:</td>
                        <td id="tblOfficer" style="float: left;">{{$jd->jumlah_officer}} Orang</td>
                    </tr>
                    <tr>
                        <td style="float: right;">Jumlah TKO</td>
                        <td>:</td>
                        <td style="float: left;" id="tblTko">{{$jd->jumlah_tko}} Orang</td>
                    </tr>
                    <tr>
                        <td style="float: right;">Jumlah Engineer</td>
                        <td>:</td>
                        <td style="float: left;" id="tblEngineer">{{$jd->jumlah_engineer}} Orang</td>
                    </tr>      -->
                    @foreach($bawahan as $dimen)
                    <tr>
                        <td style="float: right;">Jumlah {{$dimen->deskripsi}}</td>
                        <td>:</td>
                        <td style="float: left;" id="tblEngineer">{{$dimen->jumlah}} {{$dimen->satuan}} </td>
                    </tr>
                    @endforeach
                    @foreach($nonKeu as $dimen)
                    <tr>
                        <td style="float: right;">{{$dimen->deskripsi}}</td>
                        <td>:</td>
                        <td style="float: left;" id="tblEngineer">{{$dimen->jumlah}} {{$dimen->satuan}} </td>
                    </tr>
                    @endforeach                       
                </tbody>
            </table>
            <div class="row justify-content-end pr-3">
                <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="collapse" data-target="#collDimensi" aria-expanded="false" aria-controls="collapseExample">
                    Draft
                </button>
            </div>
            <div class="collapse" id="collDimensi">
                <div class="card">
                    <div class="card-header">
                        <h7><b>Draft Dimensi Jabatn</b></h7>
                    </div>
                    <table class="table table-striped table-sm"  width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width=49%></th>
                                <th width=2%></th>
                                <th width=49%></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="float: right;">Anggaran Capex</td>
                                <td width="2%">:</td>
                                <td style="float: left;" id="tblCapex">{{number_format($draft->anggaran_capex,2,",",".")}}</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Target Pendapatan</td>
                                <td>:</td>
                                <td style="float: left;" id="tblPendapatan">{{number_format($draft->target_pendapatan,2,",",".")}}</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Anggaran Opex</td>
                                <td>:</td>
                                <td style="float: left;" id="tblOpex">{{number_format($draft->anggaran_opex,2,",",".")}}</td>
                            </tr>
                            <!-- <tr>
                                <td style="float: right;">Jumlah Officer</td>
                                <td>:</td>
                                <td id="tblOfficer" style="float: left;">{{$draft->jumlah_officer}} Orang</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Jumlah TKO</td>
                                <td>:</td>
                                <td style="float: left;" id="tblTko">{{$draft->jumlah_tko}} Orang</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Jumlah Engineer</td>
                                <td>:</td>
                                <td style="float: left;" id="tblEngineer">{{$draft->jumlah_engineer}} Orang</td>
                            </tr>      -->
                            @php
                                $dimen = json_decode($draft->deskripsi);
                                $jumlah = json_decode($draft->jumlah);
                                $satuan = json_decode($draft->satuan);
                                $bawahan= json_decode($draft->bawahan);
                                $jumlahBawahan = json_decode($draft->jumlah_bawahan);
                            @endphp
                                           
                            @for($i=0; $i<count($dimen); $i++)
                            <tr>
                                <td style="float: right;">{{$dimen[$i]}}</td>
                                <td>:</td>
                                <td style="float: left;" id="tblEngineer">{{$jumlah[$i]}} {{$satuan[$i]}} </td>
                            </tr>
                            @endfor                                  
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <h6 style="color:black" class="mb-3 mt-3"><b>Hubungan Kerja Internal</b></h6>
            <table class="table table-striped table-sm table-bordered"  width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">Pihak Internal</th>
                        <th scope="col">Tujuan</th>
                    </tr>
                </thead>
                <tbody>
                @for($i=0; $i<count($hubKerjaInternal); $i++)                  
                    <tr>
                        <td>{{$hubKerjaInternal[$i]->hk}}</td>
                        <td>{{$hubKerjaInternal[$i]->tujuan}}</td>
                    </tr>
                @endfor
                </tbody>
            </table>
            <div class="row justify-content-end pr-3">
                <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="collapse" data-target="#collHubKerjaIn" aria-expanded="false" aria-controls="collapseExample">
                    Draft
                </button>
            </div>
            <div class="collapse" id="collHubKerjaIn">
                <div class="card">
                <div class="card-header">
                        <h7><b>Draft Hubungan Kerja Internal</b></h7>
                    </div>
                    <table class="table table-striped table-sm table-bordered"  width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Pihak Internal</th>
                                <th scope="col">Tujuan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $hubIn = json_decode($draft->hubungan_kerja_internal);
                            $tujIn = json_decode($draft->tujuan_kerja_internal);
                        @endphp
                        @for($i=0; $i<count($hubIn); $i++)
                            <tr>
                                <td>{{$hubIn[$i]}}</td>
                                <td>{{$tujIn[$i]}}</td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <h6 style="color:black" class="mb-3 mt-3"><b>Hubungan Kerja External</b></h6>
            <table class="table table-striped table-sm table-bordered"  width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">Pihak External</th>
                        <th scope="col">Tujuan</th>
                    </tr>
                </thead>
                <tbody id="tblHkExternal">
                @for($i=0; $i<count($hubKerjaExternal); $i++)                  
                    <tr>
                        <td>{{$hubKerjaExternal[$i]->hk}}</td>
                        <td>{{$hubKerjaExternal[$i]->tujuan}}</td>
                    </tr>
                @endfor
                </tbody>
            </table>
            <div class="row justify-content-end pr-3">
                <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="collapse" data-target="#collHubKerjaEx" aria-expanded="false" aria-controls="collapseExample">
                    Draft
                </button>
            </div>
            <div class="collapse" id="collHubKerjaEx">
                <div class="card">
                <div class="card-header">
                        <h7><b>Draft Hubungan Kerja External</b></h7>
                    </div>
                    <table class="table table-striped table-sm table-bordered"  width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Pihak External</th>
                                <th scope="col">Tujuan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $hubEx = json_decode($draft->hubungan_kerja_external);
                            $tujEx = json_decode($draft->tujuan_kerja_external);
                        @endphp
                        @for($i=0; $i<count($hubEx); $i++)
                            <tr>
                                <td>{{$hubEx[$i]}}</td>
                                <td>{{$tujEx[$i]}}</td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <h6 style="color:black" class="mb-3 mt-3"><b>Kewenangan</b></h6>
            <table class="table table-striped table-sm"  width="100%" cellspacing="0">                        
                <tbody id="tblKewenangan">  
                @for($i=0; $i<count($kewenangan); $i++) 
                    <tr><td>{{$kewenangan[$i]->name}}</td></tr>
                @endfor                          
                </tbody>
            </table>
            <div class="row justify-content-end pr-3">
                <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="collapse" data-target="#collKewenangan" aria-expanded="false" aria-controls="collapseExample">
                    Draft
                </button>
            </div>
            <div class="collapse" id="collKewenangan">
                <div class="card">
                <div class="card-header">
                        <h7><b>Draft Kewenangan</b></h7>
                    </div>
                    <table class="table table-striped table-sm table-bordered"  width="100%" cellspacing="0">                    
                        <tbody>
                        @php
                            $kwnangan = json_decode($draft->kewenangan);                            
                        @endphp
                        @for($i=0; $i<count($kwnangan); $i++)
                            <tr>
                                <td>{{$kwnangan[$i]}}</td>                                
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <h6 style="color:black" class="mb-3 mt-3"><b>Tantangan Jabatan</b></h6>
            <table class="table table-striped table-sm"  width="100%" cellspacing="0">                        
                <tbody id="tblTantanganJabatan">
                @for($i=0; $i<count($tantanganJabatan); $i++) 
                    <tr><td>{{$tantanganJabatan[$i]->name}}</td></tr>
                @endfor                            
                </tbody>
            </table>
            <div class="row justify-content-end pr-3">
                <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="collapse" data-target="#collTantanganJabatan" aria-expanded="false" aria-controls="collapseExample">
                    Draft
                </button>
            </div>
            <div class="collapse" id="collTantanganJabatan">
                <div class="card">
                <div class="card-header">
                        <h7><b>Draft Tantangan Jabatan</b></h7>
                    </div>
                    <table class="table table-striped table-sm table-bordered"  width="100%" cellspacing="0">                    
                        <tbody>
                        @php
                            $Draftantangan = json_decode($draft->tantangan_jabatan);
                        @endphp
                        @for($i=0; $i<count($Draftantangan); $i++)
                            <tr>
                                <td>{{$Draftantangan[$i]}}</td>                                
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
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
                <tbody>
                    <tr>
                        <td style="float: right;">Pendidikan Formal</td>
                        <td>:</td>
                        <td style="float: left;" id="tblPendidikan">{{$jd->pendidikan}}</td>
                    </tr>
                    <tr>
                        <td style="float: right;">Pengalaman</td>
                        <td>:</td>
                        <td style="float: left;" id="tblPengalaman">{{$jd->pengalaman}}  Tahun</td>
                    </tr>
                    @for($i=0; $i<count($sertifikasi); $i++)                           
                        @if($i==0)
                        <tr>
                            <td style="float: right;"><b>Sertifikasi</b></td>
                            <td>:</td>
                            <td style="float: left;" id="tblSertifikasi">- {{$sertifikasi[$i]->name}}</td>
                        </tr>
                        @else 
                        <tr>
                            <td style="float: right;"></td>
                            <td></td>
                            <td style="float: left;" id="tblSertifikasi">- {{$sertifikasi[$i]->name}}</td>
                        </tr>
                        @endif
                    @endfor
                    @for($i=0; $i<count($pelatihanWajib); $i++)                           
                        @if($i==0)
                        <tr>
                            <td style="float: right;"><b>Pelatihan Wajib</b></td>
                            <td>:</td>
                            <td style="float: left;" id="tblSertifikasi">- {{$pelatihanWajib[$i]->name}}</td>
                        </tr>
                        @else 
                        <tr>
                            <td style="float: right;"></td>
                            <td></td>
                            <td style="float: left;" id="tblSertifikasi">- {{$pelatihanWajib[$i]->name}}</td>
                        </tr>
                        @endif
                    @endfor                   
                    @for($i=0; $i<count($pengetahuan); $i++)                           
                        @if($i==0)
                        <tr>
                            <td style="float: right;"><b>Pengetahuan</b></td>
                            <td>:</td>
                            <td style="float: left;" id="tblSertifikasi">- {{$pengetahuan[$i]->name}}</td>
                        </tr>
                        @else 
                        <tr>
                            <td style="float: right;"></td>
                            <td></td>
                            <td style="float: left;" id="tblSertifikasi">- {{$pengetahuan[$i]->name}}</td>
                        </tr>
                        @endif
                    @endfor                   
                    @for($i=0; $i<count($keahlian); $i++)                           
                        @if($i==0)
                        <tr>
                            <td style="float: right;"><b>Keahlian</b></td>
                            <td>:</td>
                            <td style="float: left;" id="tblSertifikasi">- {{$keahlian[$i]->name}}</td>
                        </tr>
                        @else 
                        <tr>
                            <td style="float: right;"></td>
                            <td></td>
                            <td style="float: left;" id="tblSertifikasi">- {{$keahlian[$i]->name}}</td>
                        </tr>
                        @endif
                    @endfor 
                    @for($i=0; $i<count($kompetensi); $i++)                           
                        @if($i==0)
                        <tr>
                            <td style="float: right;"><b>Kompetensi</b></td>
                            <td>:</td>
                            <td style="float: left;" id="tblSertifikasi">- {{$kompetensi[$i]->name}}</td>
                        </tr>
                        @else 
                        <tr>
                            <td style="float: right;"></td>
                            <td></td>
                            <td style="float: left;" id="tblSertifikasi">- {{$kompetensi[$i]->name}}</td>
                        </tr>
                        @endif
                    @endfor                                                     
                </tbody>
            </table>

            <div class="row justify-content-end pr-3">
                <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="collapse" data-target="#collSpecJabatan" aria-expanded="false" aria-controls="collapseExample">
                    Draft
                </button>
            </div>

            <div class="collapse" id="collSpecJabatan">
                <div class="card">
                <div class="card-header">
                        <h7><b>Draft Spesifikasi Jabatan</b></h7>
                    </div>
                    <table class="table table-striped table-sm"  width="100%" cellspacing="0">   
                        <thead>
                            <tr>
                                <th width=49%></th>
                                <th width=2%></th>
                                <th width=49%></th>
                            </tr>
                        </thead>                 
                        <tbody>
                            <tr>
                                <td style="float: right;">Pendidikan Formal</td>
                                <td>:</td>
                                <td style="float: left;" id="tblPendidikan">{{$jd->pendidikan}}</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Pengalaman</td>
                                <td>:</td>
                                <td style="float: left;" id="tblPengalaman">{{$jd->pengalaman}} Tahun</td>
                            </tr>
                            @php
                                $draftsertifikasi = json_decode($draft->sertifikasi);
                                $draftPelatihan = json_decode($draft->pelatihan_wajib);
                                $draftPengetahuan = json_decode($draft->pengetahuan);
                                $draftKeahlian = json_decode($draft->keahlian);
                                $draftKompetensi = json_decode($draft->kompetensi);
                            @endphp
                            @for($i=0; $i<count($draftsertifikasi); $i++)
                                @if($i==0)
                                <tr>
                                    <td style="float: right;"><b>Sertifikasi</b></td>
                                    <td>:</td>
                                    <td style="float: left;" id="tblSertifikasi">- {{$draftsertifikasi[$i]}}</td>
                                </tr>
                                @else 
                                <tr>
                                    <td style="float: right;"></td>
                                    <td></td>
                                    <td style="float: left;" id="tblSertifikasi">- {{$draftsertifikasi[$i]}}</td>
                                </tr>
                                @endif
                            @endfor                      
                            @for($i=0; $i<count($draftPelatihan); $i++)                           
                                @if($i==0)
                                <tr>
                                    <td style="float: right;"><b>Pelatihan Wajib</b></td>
                                    <td>:</td>
                                    <td style="float: left;" id="tblSertifikasi">- {{$draftPelatihan[$i]}}</td>
                                </tr>
                                @else 
                                <tr>
                                    <td style="float: right;"></td>
                                    <td></td>
                                    <td style="float: left;" id="tblSertifikasi">- {{$draftPelatihan[$i]}}</td>
                                </tr>
                                @endif
                            @endfor  
                            @for($i=0; $i<count($draftPengetahuan); $i++)                           
                                @if($i==0)
                                <tr>
                                    <td style="float: right;"><b>Pengetahuan</b></td>
                                    <td>:</td>
                                    <td style="float: left;" id="tblSertifikasi">- {{$draftPengetahuan[$i]}}</td>
                                </tr>
                                @else 
                                <tr>
                                    <td style="float: right;"></td>
                                    <td></td>
                                    <td style="float: left;" id="tblSertifikasi">- {{$draftPengetahuan[$i]}}</td>
                                </tr>
                                @endif
                            @endfor                   
                            @for($i=0; $i<count($draftKeahlian); $i++)                           
                                @if($i==0)
                                <tr>
                                    <td style="float: right;"><b>Keahlian</b></td>
                                    <td>:</td>
                                    <td style="float: left;" id="tblSertifikasi">- {{$draftKeahlian[$i]}}</td>
                                </tr>
                                @else 
                                <tr>
                                    <td style="float: right;"></td>
                                    <td></td>
                                    <td style="float: left;" id="tblSertifikasi">- {{$draftKeahlian[$i]}}</td>
                                </tr>
                                @endif
                            @endfor 
                            @for($i=0; $i<count($draftKompetensi); $i++)                           
                                @if($i==0)
                                <tr>
                                    <td style="float: right;"><b>Kompetensi</b></td>
                                    <td>:</td>
                                    <td style="float: left;" id="tblSertifikasi">- {{$draftKompetensi[$i]}}</td>
                                </tr>
                                @else 
                                <tr>
                                    <td style="float: right;"></td>
                                    <td></td>
                                    <td style="float: left;" id="tblSertifikasi">- {{$draftKompetensi[$i]}}</td>
                                </tr>
                                @endif
                            @endfor    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Response</h6>            
                </div>
                <div class="card-body"> 
                <input type="hidden" id="h_id_jd" name="hIdJd" value="{{$jd->id}}" class="allData">                    
                    <div class="row justify-content-center">
                        <textarea class="form-control form-control-sm allData" id="revisi" rows="2" name="revisi" placeholder="Response Admin" required></textarea>
                        <input type="hidden" id="approvalId" name="approval" value="" class="allData">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input allData" type="radio" id="rbDecline" value="REJECTED" name="rb">
                            <label class="form-check-label" for="inlineRadio1">Decline</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input allData" type="radio" id="rbAccept" value="DISETUJUI" name="rb">
                            <label class="form-check-label" for="inlineRadio2">Accept</label>
                        </div>                            
                    </div>                                           
                    <div class="col-lg-3">
                        <button class="btn btn-success mb-3 ml-3" id="btnSave"> <span class="text">Submit</span></button>
                    </div>
                </div>        
            </div>         
    </div>