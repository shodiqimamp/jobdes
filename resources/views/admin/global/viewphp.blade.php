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
                </tbody>
            </table>
            <br>
            <h6 style="color:black" class="mb-2 mt-3"><b>Tujuan Jabatan</b></h6>
            <table class="table table-striped table-sm"  width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <td id="tblTujuanJabatan">{{$jd->tujuan_jabatan}}</td>                                
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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
                        <td style="float: left;" id="tblCapex">Rp {{number_format($jd->anggaran_capex,2,",",".")}}</td>
                    </tr>                    
                    <tr>
                        <td style="float: right;">Anggaran Opex</td>
                        <td>:</td>
                        <td style="float: left;" id="tblOpex">Rp {{number_format($jd->anggaran_opex,2,",",".")}}</td>
                    </tr>
                    <tr>
                        <td style="float: right;">Target Pendapatan</td>
                        <td>:</td>
                        <td style="float: left;" id="tblPendapatan">Rp {{number_format($jd->target_pendapatan,2,",",".")}}</td>
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
                    @foreach($bawahan as $bw)
                    <tr>
                        <td style="float: right;">Jumlah {{$bw->deskripsi}}</td>
                        <td>:</td>
                        <td style="float: left;" id="tblEngineer">{{$bw->jumlah}} {{$bw->satuan}} </td>
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
            <br>
            <h6 style="color:black" class="mb-3 mt-3"><b>Hubungan Kerja Internal</b></h6>
            <table class="table table-striped table-sm table-bordered"  width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">Pihak Internal</th>
                        <th scope="col">Tujuan</th>
                    </tr>
                </thead>
                <tbody id="tblHkInternal">
                @for($i=0; $i<count($hubKerjaInternal); $i++)                  
                    <tr>
                        <td>{{$hubKerjaInternal[$i]->hk}}</td>
                        <td>{{$hubKerjaInternal[$i]->tujuan}}</td>
                    </tr>
                @endfor
                </tbody>
            </table>
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
            <br>
            <h6 style="color:black" class="mb-3 mt-3"><b>Kewenangan</b></h6>
            <table class="table table-striped table-sm"  width="100%" cellspacing="0">                        
                <tbody id="tblKewenangan">  
                @for($i=0; $i<count($kewenangan); $i++) 
                    <tr><td>{{$kewenangan[$i]->name}}</td></tr>
                @endfor                          
                </tbody>
            </table>
            <br>
            <h6 style="color:black" class="mb-3 mt-3"><b>Tantangan Jabatan</b></h6>
            <table class="table table-striped table-sm"  width="100%" cellspacing="0">                        
                <tbody id="tblTantanganJabatan">
                @for($i=0; $i<count($tantanganJabatan); $i++) 
                    <tr><td>{{$tantanganJabatan[$i]->name}}</td></tr>
                @endfor                            
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
                <tbody>
                    <tr>
                        <td style="float: right;"><b>Pendidikan Formal</b></td>
                        <td>:</td>
                        <td style="float: left;" id="tblPendidikan">{{$jd->pendidikan}}</td>
                    </tr>
                    <tr>
                        <td style="float: right;"><b>Pengalaman<b></td>
                        <td>:</td>
                        <td style="float: left;" id="tblPengalaman">{{$jd->pengalaman}} Tahun</td>
                    </tr>
                    @for($i=0; $i<count($sertifikasi); $i++)                           
                        @if($i==0)
                        <tr>
                            <td style="float: right;"><b>Sertifikasi</b></td>
                            <td>:</td>
                            <td style="float: left;" id="tblSertifikasi">{{$sertifikasi[$i]->name}}</td>
                        </tr>
                        @else 
                        <tr>
                            <td style="float: right;"></td>
                            <td></td>
                            <td style="float: left;" id="tblSertifikasi">{{$sertifikasi[$i]->name}}</td>
                        </tr>
                        @endif
                    @endfor
                    @for($i=0; $i<count($pelatihanWajib); $i++)                           
                        @if($i==0)
                        <tr>
                            <td style="float: right;"><b>Pelatihan Wajib</b></td>
                            <td>:</td>
                            <td style="float: left;" id="tblSertifikasi">{{$pelatihanWajib[$i]->name}}</td>
                        </tr>
                        @else 
                        <tr>
                            <td style="float: right;"></td>
                            <td></td>
                            <td style="float: left;" id="tblSertifikasi">{{$pelatihanWajib[$i]->name}}</td>
                        </tr>
                        @endif
                    @endfor                   
                    @for($i=0; $i<count($pengetahuan); $i++)                           
                        @if($i==0)
                        <tr>
                            <td style="float: right;"><b>Pengetahuan</b></td>
                            <td>:</td>
                            <td style="float: left;" id="tblSertifikasi">{{$pengetahuan[$i]->name}}</td>
                        </tr>
                        @else 
                        <tr>
                            <td style="float: right;"></td>
                            <td></td>
                            <td style="float: left;" id="tblSertifikasi">{{$pengetahuan[$i]->name}},</td>
                        </tr>
                        @endif
                    @endfor                   
                    @for($i=0; $i<count($keahlian); $i++)                           
                        @if($i==0)
                        <tr>
                            <td style="float: right;"><b>Keahlian</b></td>
                            <td>:</td>
                            <td style="float: left;" id="tblSertifikasi">{{$keahlian[$i]->name}}</td>
                        </tr>
                        @else 
                        <tr>
                            <td style="float: right;"></td>
                            <td></td>
                            <td style="float: left;" id="tblSertifikasi">{{$keahlian[$i]->name}}</td>
                        </tr>
                        @endif
                    @endfor 
                    @for($i=0; $i<count($kompetensi); $i++)                           
                        @if($i==0)
                        <tr>
                            <td style="float: right;"><b>Kompetensi</b></td>
                            <td>:</td>
                            <td style="float: left;" id="tblSertifikasi">{{$kompetensi[$i]->name}}</td>
                        </tr>
                        @else 
                        <tr>
                            <td style="float: right;"></td>
                            <td></td>
                            <td style="float: left;" id="tblSertifikasi">{{$kompetensi[$i]->name}}</td>
                        </tr>
                        @endif
                    @endfor                                                     
                </tbody>
            </table>
        </div>
        @if(request()->is('view/*') && $jd->status != 'PENGAJUAN' && $jd->status != 'REVIEW' && Session::get('role') != 'PEGAWAI' && Session::get('role') != 'PEGAWAI')
        <div class="col-lg-3">
            <a class="btn btn-success mb-3 ml-3" id="btnSave" style="color:white" href="{{url('edit',$jd->id)}}"> Edit</a>
        </div>
        @endif


    </div>