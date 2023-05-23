<div id="smartwizard">
    <ul>
        <li><a href="#step-1">Step 1<br /><small>Identifikasi Jabatan</small></a></li>
        <li><a href="#step-2">Step 2<br /><small>Tanggung Jawab Utama</small></a></li>
        <li><a href="#step-3">Step 3<br /><small>Dimensi Jabatan</small></a></li>
        <li><a href="#step-4">Step 4<br /><small>Hubungan Kerja</small></a></li>
        <li><a href="#step-5">Step 5<br /><small>Kewenangan</small></a></li>
        <li><a href="#step-6">Step 6<br /><small>Tantangan Jabatan</small></a></li>
        <li><a href="#step-7">Step 7<br /><small>Spesifikasi Jabatan</small></a></li>
        <li><a href="#step-8">Step 8<br /><small>Response</small></a></li>
    </ul>        
    <div>
        <div id="step-1" class="">
            @if(request()->is('pengajuan/*') && $jd->status == 'DITOLAK')
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revisi</h6>            
                </div>
                <div class="card-body"> 
                    <div class="row justify-content-center">
                        <textarea class="form-control form-control-sm" id="revisi" rows="2" name="revisi" readonly >{{$jd->revisi_atasan}}</textarea>
                    </div>                                                              
                </div>        
            </div>                               
            @endif
            @if(request()->is('approval/view/*') && $jd->status == 'REJECTED')
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revisi</h6>            
                </div>
                <div class="card-body"> 
                    <div class="row justify-content-center">
                        <textarea class="form-control form-control-sm" id="revisi" rows="2" name="revisi" readonly >{{$jd->feedback_admin}}</textarea>
                    </div>                                                              
                </div>        
            </div>                               
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Identifikasi Jabatan</h6>
                </div>
                <div class="card-body">                        
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="email">Nama Jabatan</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" id="namaJabatan" name="namaJabatan" value="{{$detailJabatan->nama_jabatan}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">ID Jabatan</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" id="idJabatan" name="idJabatan" value="{{$detailJabatan->id_jabatan}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Atasan Langsung</label>
                                <input type="text" value="{{$detailJabatan->atasan_langsung}}" class="form-control form-control-sm form-control form-control-sm-sm allData" id="atasanLangsung" name="atasanLangsung" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Atasan Tidak Langsung</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" id="atasanTidakLangsung" name="atasanTidakLangsung" readonly value="{{$detailJabatan->atasan_tidak_langsung}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Lokasi Kerja</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" id="lokasiKerja" name="lokasiKerja" value="{{$jd->lokasi_kerja}}">
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="email">Tanggal</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm" id="tanggal" name="tanggal" value="{{($jd->status == 'DISETUJUI') ? date('d-m-Y', strtotime($jd->tanggal_disetujui)) : '' }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Direktorat</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" id="direktorat" name="direktorat" readonly value="{{$detailJabatan->direktorat}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Divisi/Satuan/SBU</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" id="divisi" name="divisi" readonly value="{{$detailJabatan->divisi}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Bidang</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" id="bidang" name="bidang" readonly value="{{$detailJabatan->bidang}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Sub Bidang</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" id="subBidang" name="subBidang"  value="{{$detailJabatan->sub_bidang}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>    
        <div id="step-2" class="">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tujuan Jabatan</h6>
                    <input type="hidden" id="h_id_jd" name="hIdJd" value="{{$jd->id}}" class="allData">                    
                </div>
                <div class="card-body">
                    <div class="form-group">                
                    <textarea class="form-control form-control-sm allData" id="tujuanJabatan" rows="2" name="tujuanJabatan" required>{{$jd->tujuan_jabatan}}</textarea>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tanggung Jawab Utama</h6>
                    <div class="dropdown no-arrow">
                        <i class="fas fa-plus" style="color:blue" id="addTanggungJawab"></i>                
                    </div>
                </div>
                <div class="card-body" id="addField">
                    @for($i=0; $i<count($tgJawab); $i++)
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="form-group">                
                            <textarea class="form-control form-control-sm allData" id="tanngungJawab" rows="2" name="tanggungJawab[]" placeholder="Tanggung Jawab Utama" required>{{$tgJawab[$i]->tj_utama}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">  
                            <div class="row">
                                <input type="hidden" id="h_id_tanggung_jawab"  class="allData" name="hIdTanggungJawab[]" value="{{$tgJawab[$i]->id}}">                    
                                <div class="col-lg-11">
                                    <div class="form-group">                
                                    <textarea class="form-control form-control-sm allData" id="indikatorKinerja" rows="2" placeholder="Indikator Kinerja" name="indikatorKinerja[]" required>{{$tgJawab[$i]->indikator_kinerja}}</textarea>                    
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    @if($i!=0)
                                    <i class="fas fa-times remove_tanggung_jawab float-right" style="color:red" ></i>
                                    @endif
                                </div>                                        
                            </div>                                      
                        </div>                                                    
                    </div>  
                    @endfor  
                </div>        
            </div>            
        </div>
        <div id="step-3" class="">   
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dimensi Jabatan</h6>
                </div>
                <div class="card-body">
                    <h6 style="color:black" class="mb-3"><b>Dimensi Keuangan</b> <span class="asteris">*</span><i class="fas fa-question-circle fa-sm" data-toggle="tooltip" data-placement="right" title="Jika tidak ada anggaran yang dikelola atau tidak ditarget pendapatan, diisi 0" style="color:blue"></i></h6>

                    <h6 style="color:black" class="mb-3">Anggaran yang dikelola </h6>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="capex" class="col-form-label">Capex</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" id="capex" name="capex" value="{{number_format($jd->anggaran_capex,0,',','.')}}" required>
                            </div>
                        </div>                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="opex" class="col-form-label">Opex</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" id="opex" name="opex" value="{{number_format($jd->anggaran_opex,0,',','.')}}" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="capex" class="col-form-label">Target Pendapatan</label>
                                <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" id="target" name="target"  value="{{number_format($jd->target_pendapatan,0,',','.')}}" required >
                            </div>
                        </div>
                    </div>
                    <hr class="sidebar-divider">
                    <h6 style="color:black" class="mb-4 mt-4"><b>Dimensi Non Keuangan</b> <span class="asteris">*</span></h6>
                    <h6 style="color:black" class="mb-1">Jumlah SDM yang dikelola <i class="fas fa-question-circle fa-sm" data-toggle="tooltip" data-placement="right" title="Jika tidak ada SDM yang dikelola, diisi 0" style="color:blue"></i> </h6>
                    <!-- <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="officer" class="col-form-label">Officer</label>
                                <input type="number" class="form-control form-control-sm form-control form-control-sm-sm allData" id="officer" name="officer" value="{{$jd->jumlah_officer}}">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="engineer" class="col-form-label">Engineer</label>
                                <input type="number" class="form-control form-control-sm form-control form-control-sm-sm allData" id="engineer" name="engineer" value="{{$jd->jumlah_engineer}}">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="tko" class="col-form-label">TKO</label>
                                <input type="number" class="form-control form-control-sm form-control form-control-sm-sm allData" id="tko" name="tko"value="{{$jd->jumlah_tko}}">
                            </div>
                        </div>
                    </div> -->
                    @php
                    $i = 0;
                    @endphp
                    @if(count($bawahan) > 0)
                    <div id="fieldBawahan" class="mt-4">
                        @foreach ($bawahan as $des )
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                <select class="form-control form-control-sm allData classSatuan" id="jenisBawahan" name="jenisBawahan[]">
                                    <option selected disabled>Pilih Jenjang</option> 
                                    <option value="Manager" {{ ( $des->deskripsi == 'Manager') ? 'selected' : '' }}>Manager</option>
                                    <option value="Supervisor" {{ ( $des->deskripsi == 'Supervisor') ? 'selected' : '' }}>Supervisor</option>
                                    <option value="Officer" {{ ( $des->deskripsi == 'Officer') ? 'selected' : '' }}>Officer</option>
                                    <option value="Engineer" {{ ( $des->deskripsi == 'Engineer') ? 'selected' : '' }}>Engineer</option>
                                    <option value="TKO" {{ ( $des->deskripsi == 'TKO') ? 'selected' : '' }}>TKO</option>
                                </select>
                                </div>                                
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm allData" id="jumlahBawahan" name="jumlahBawahan[]" value="{{$des->jumlah}}" >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm allData"  value="Orang" readonly>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <input type="hidden" id="h_id_bawahan" name="hIdBawahan[]" value="{{$des->id}}" class="allData">
                            @if($i==0)
                            <div class="col-lg-1">
                                <span class="btn btn-primary btn-sm" id="addNewBawahan">
                                    <i class="fas fa-plus" ></i>
                                </span>
                            </div>
                            @else
                            <div class='col-lg-1'><span class='btn btn-danger btn-sm remove_bawahan'><i class='fas fa-times'></i></span></div>
                            @endif
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </div>
                    @else 
                    <div id="fieldBawahan" class="mt-4">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                <select class="form-control form-control-sm allData classSatuan" id="jenisBawahan" name="jenisBawahan[]">
                                    <option selected disabled>Pilih Jenjang</option> 
                                    <option value="Manager">Manager</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Officer">Officer</option>
                                    <option value="Engineer">Engineer</option>
                                    <option value="TKO">TKO</option>
                                </select>
                                </div>                                
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm allData" id="jumlahBawahan" name="jumlahBawahan[]" placeholder="jumlah">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm allData"  value="Orang" readonly>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <span class="btn btn-primary btn-sm" id="addNewBawahan">
                                    <i class="fas fa-plus" ></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <hr class="sidebar-divider">
                    <div id="fieldDimensi">
                        @php
                        $i = 0;
                        @endphp
                        @foreach ($nonKeu as $des )
                       
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" name="deskripsi[]"  value="{{$des->deskripsi}}">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm form-control form-control-sm-sm allData" name="jumlah[]"  value="{{$des->jumlah}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">                                
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                        <select class="form-control form-control-sm form-control form-control-sm-sm allData" id="satuan" name="satuan[]"> 
                                                @foreach($satuan as $sat )
                                                    @if($sat->name == $des->satuan)
                                                    <option selected value="{{$sat->name}}">{{$sat->name}}</option>
                                                    @else 
                                                    <option value="{{$sat->name}}">{{$sat->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if($i==0)
                                    <div class="col-lg-5">
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalSatuan">
                                        <i class="fas fa-plus" id="addNewSatuan"></i> Satuan
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" id="h_id_nonKeu" name="hIdNonKeu[]" value="{{$des->id}}" class="allData">
                            @if($i==0)
                            <div class="col-lg-1">
                                <span class="btn btn-primary btn-sm" id="addNewDimensi">
                                    <i class="fas fa-plus" ></i>
                                </span>
                            </div>
                            @else
                            <div class='col-lg-1'><span class='btn btn-danger btn-sm remove_dimensi'><i class='fas fa-times'></i></span></div>
                            @endif
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </div>
                </div>
            </div>    
        </div>
        <div id="step-4" class="">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Hubungan Kerja<span class="asteris">*</span> <i class="fas fa-question-circle fa-sm" data-toggle="tooltip" data-placement="right" title='Jika tidak ada, diisi "-"' style="color:blue"></i></h6>                            
                </div>
                <div class="card-body">                        
                <h6 style="color:black" class="mb-3"><b>Internal</b></h6>
                    <div id="fieldHubInternal">
                        @for($i=0; $i<count($hubKerjaInternal); $i++)                  
                        <div class="row">
                            <div class="col-lg-5 mb-4">
                                <div class="form-group">                
                                <textarea class="form-control form-control-sm allData" id="internal" rows="2" name="internal[]" required>{{$hubKerjaInternal[$i]->hk}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-7 mb-4">  
                                <div class="row">
                                    <input type="hidden" id="h_id_internal" name="hIdInternal[]" value="{{$hubKerjaInternal[$i]->id}}" class="allData">
                                    <div class="col-lg-11">
                                        <div class="form-group">                
                                            <textarea class="form-control form-control-sm allData" id="tujuanInternal" rows="2" name="tujuanInternal[]" required>{{$hubKerjaInternal[$i]->tujuan}}</textarea>                    
                                        </div>
                                    </div>  
                                    <div class="col-lg-1">
                                        @if($i==0)
                                        <i class="fas fa-plus float-right" style="color:blue" id="addHubInternal"></i>
                                        @else
                                        <i class="fas fa-times remove_internal float-right" style="color:red" ></i>
                                        @endif 
                                    </div>                      
                                </div>                                      
                            </div>                                                    
                        </div>
                        
                        @endfor
                    </div>    
                    <!-- <hr class="sidebar-divider">  -->
                    <h6 style="color:black" class="mb-3"><b>External</b></h6>  
                    <div id="fieldHubExternal">
                        @for($i=0; $i<count($hubKerjaExternal); $i++)  
                                        
                        <div class="row">
                            <div class="col-lg-5 mb-4">
                                <div class="form-group">                
                                <textarea class="form-control form-control-sm allData" id="external" rows="2" name="external[]" required>{{$hubKerjaExternal[$i]->hk}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-7 mb-4">  
                                <div class="row">
                                    <input type="hidden" id="h_id_external" name="hIdExternal[]" value="{{$hubKerjaExternal[$i]->id}}" class="allData">
                                    <div class="col-lg-11">
                                        <div class="form-group">                
                                            <textarea class="form-control form-control-sm allData" id="tujuanExternal" rows="2"  name="tujuanExternal[]" required>{{$hubKerjaExternal[$i]->tujuan}}</textarea>              
                                        </div>
                                    </div>  
                                    <div class="col-lg-1">
                                        @if($i==0)
                                        <i class="fas fa-plus float-right" style="color:blue" id="addHubExternal"></i>
                                        @else
                                        <i class="fas fa-times remove_external float-right" style="color:red" ></i>
                                        @endif 
                                    </div>                      
                                </div>                                      
                            </div>                                                    
                        </div>
                        
                        @endfor
                    </div>         
                </div>        
            </div> 

        </div>
        <div id="step-5" class="">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Kewenangan<span class="asteris">*</span> <i class="fas fa-question-circle fa-sm" data-toggle="tooltip" data-placement="right" title='Wajib diisi untuk jobdesc pada jabatan struktural' style="color:blue"></i></h6>
                    <div class="dropdown no-arrow">
                        <i class="fas fa-plus" style="color:blue" id="addKewenangan"></i>                
                    </div>
                </div>
                <div class="card-body" id="addFieldKewenangan">   
                    @for($i=0; $i<count($kewenangan); $i++) 
                    <div class="row">
                        <input type="hidden" id="h_id_kewenangan" name="hIdKewenangan[]" value="{{$kewenangan[$i]->id}}" class="allData">
                        <div class="col-lg-11">
                            <div class="form-group">                
                                <input type="text" class="form-control form-control-sm allData" name="kewenangan[]" placeholder="Kewenangan" value="{{$kewenangan[$i]->name}}">
                            </div>
                        </div>    
                        <div class="col-lg-1">
                            @if($i!=0)
                            <i class="fas fa-times remove_kewenangan float-right" style="color:red" ></i>
                            @endif
                        </div>      
                    </div>                                                                      
                    @endfor
                </div>        
            </div>    
        </div>
        <div id="step-6" class="">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tantangan Jabatan<span class="asteris">*</span> <i class="fas fa-question-circle fa-sm" data-toggle="tooltip" data-placement="right" title='Wajib diisi oleh seluruh posisi' style="color:blue"></i></h6>
                    <div class="dropdown no-arrow">
                        <i class="fas fa-plus" style="color:blue" id="addJabatan"></i>                
                    </div>
                </div>
                <div class="card-body" id="addFieldJabatan">   
                    @for($i=0; $i<count($tantanganJabatan); $i++)                 
                    <div class="row">
                        <input type="hidden" id="h_id_tantangan_jabatan" name="hIdTantanganJabatan[]" value="{{$tantanganJabatan[$i]->id}}" class="allData">
                        <div class="col-lg-11">
                            <div class="form-group">                
                                <input type="text" class="form-control form-control-sm allData"  name="tantanganJabatan[]" placeholder="Tantangan Jabatan" value="{{$tantanganJabatan[$i]->name}}">
                            </div>
                        </div> 
                        <div class="col-lg-1">
                            @if($i!=0)
                            <i class="fas fa-times remove_jabatan float-right" style="color:red" ></i>
                            @endif
                        </div>               
                    </div>   
                    @endfor                                                                   
                </div>        
            </div>  
        </div>
        <div id="step-7" class="">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Spesifikasi Jabatan</h6>            
                </div>
                <div class="card-body"> 
                    <h6 style="color:black" class="mb-3"><b>Pendidikan dan Pengalaman</b></h6>               
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan Formal</label>  
                                <input type="text" class="form-control form-control-sm col-sm-11 allData" id="pendidikan" name="pendidikan" value="{{$jd->pendidikan}}">
                            </div>
                            <div id="fieldSertifikasi">  
                                @for($i=0; $i<count($sertifikasi); $i++)                           
                                <div class="form-group">
                                    @if($i==0)
                                    <label for="sertifikasi">Sertifikasi</label>                       
                                    @endif
                                    <div class="row">
                                    <input type="hidden" id="h_id_sertifikasi" name="hIdSertifikasi[]" value="{{$sertifikasi[$i]->id}}" class="allData">
                                        <div class="col-lg-11">
                                            <input type="text" class="form-control form-control-sm allData"  name="sertifikasi[]" value="{{$sertifikasi[$i]->name}}">
                                        </div>
                                        <div class="col-lg-1">                       
                                            @if($i==0)
                                            <span class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus"></i>
                                            </span>
                                            @else
                                            <span class="btn btn-danger btn-sm remove_sertifikasi" >
                                            <i class="fas fa-times" ></i>
                                            </span>
                                            @endif                                            
                                        </div>                              
                                    </div>                            
                                </div>                        
                                @endfor
                            </div>                    
                        </div>                
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pendidikan">Pengalaman</label>  
                                <input type="text" class="form-control form-control-sm col-sm-11 allData" id="pengalaman" name="pengalaman" value="{{$jd->pengalaman}}" class="allData">
                            </div>
                            <div id="fieldPelatihan">
                                @for($i=0; $i<count($pelatihanWajib); $i++)
                                <div class="form-group">
                                    @if($i==0)
                                    <label for="pendidikan">Pelatihan Wajib</label>
                                    @endif
                                    <div class="row">
                                    <input type="hidden" id="h_id_pelatihan" name="hIdPelatihan[]" value="{{$pelatihanWajib[$i]->id}}" class="allData">
                                        <div class="col-lg-11">
                                            <input type="text" class="form-control form-control-sm allData" name="pelatihan[]" value="{{$pelatihanWajib[$i]->name}}">
                                        </div>
                                        <div class="col-lg-1">
                                            @if($i==0)
                                            <span class="btn btn-primary btn-sm" id="addPelatihan">
                                            <i class="fas fa-plus"></i>
                                            </span>
                                            @else 
                                            <span class="btn btn-danger btn-sm remove_pelatihan">
                                            <i class="fas fa-times "></i>
                                            </span>
                                            @endif
                                        </div>
                                    </div>                          
                                </div>
                                @endfor
                            </div>                    
                        </div>                
                    </div>    
                    <h6 style="color:black" class="mb-3 mt-3"><b>Pengetahuan, Keterampilan, Kemampuan & Kompetensi</b></h6>
                    <div id="fieldPengetahuan">            
                        @for($i=0; $i<count($pengetahuan); $i++)
                        <div class="form-group">
                            @if($i==0)
                            <label for="pengetahuan">Pengetahuan</label>
                            @endif
                            <div class="row">
                                <input type="hidden" id="h_id_pengetahuan" name="hIdPengetahuan[]" value="{{$pengetahuan[$i]->id}}" class="allData">
                                <div class="col-lg-11">
                                    <input type="text" class="form-control form-control-sm allData" name="pengetahuan[]" value="{{$pengetahuan[$i]->name}}">
                                </div>
                                <div class="col-lg-1">
                                    @if($i==0)
                                    <i class="fas fa-plus" style="color:blue" id="addPengetahuan"></i>
                                    @else 
                                    <i class="fas fa-times remove_pengetahuan" style="color:red" ></i>
                                    @endif 
                                </div>
                            </div>                          
                        </div>
                        @endfor
                    </div>        
                    <div id="fieldKeahlian">                
                        @for($i=0; $i<count($keahlian); $i++)
                        <div class="form-group">
                            @if($i==0)
                            <label for="keahlian">Keahlian</label>
                            @endif                    
                            <div class="row">
                                <input type="hidden" id="h_id_keahlian" name="hIdKeahlian[]" value="{{$keahlian[$i]->id}}" class="allData">
                                <div class="col-lg-11">
                                    <input type="text" class="form-control form-control-sm allData"  name="keahlian[]" placeholder="" value="{{$keahlian[$i]->name}}">
                                </div>
                                <div class="col-lg-1">
                                    @if($i==0)
                                        <i class="fas fa-plus" style="color:blue" id="addKeahlian"></i>
                                    @else
                                        <i class="fas fa-times remove_keahlian" style="color:red" ></i>
                                    @endif
                                </div>
                            </div>                   
                        </div>    
                        @endfor                                                        
                    </div>        
                    <div id="fieldKompetensi"> 
                        @for($i=0; $i<count($kompetensi); $i++)           
                        <div class="form-group">
                            @if($i==0)
                            <label for="kompetensi">Kompetensi</label>
                            @endif
                            <div class="row">
                            <input type="hidden" id="h_id_kompetensi" name="hIdKompetensi[]" value="{{$kompetensi[$i]->id}}" class="allData">
                                <div class="col-lg-11">
                                    <input type="text" class="form-control form-control-sm allData" name="kompetensi[]" value="{{$kompetensi[$i]->name}}">
                                </div>
                                <div class="col-lg-1">
                                    @if($i==0)
                                    <i class="fas fa-plus" style="color:blue" id="addKompetensi"></i>
                                    @else
                                    <i class="fas fa-times remove_kompetensi" style="color:red"></i>
                                    @endif
                                </div>
                            </div>                          
                        </div>
                        @endfor
                    </div>
                </div>        
            </div>      
        </div>
        <div id="step-8" class="">                     
            @include('admin/global/viewjs')

            @if(request()->is('approval/view/*'))                    
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Response</h6>            
                </div>
                <div class="card-body"> 
                    <div class="row justify-content-center">
                        <textarea class="form-control form-control-sm allData" id="revisi" rows="2" name="revisi" placeholder="Report" required></textarea>
                        <input type="hidden" id="approvalId" name="approval" value="" class="allData">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input allData" type="radio" id="rbDecline" value="DITOLAK" name="rb">
                            <label class="form-check-label" for="inlineRadio1">Decline</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input allData" type="radio" id="rbAccept" value="REVIEW" name="rb">
                            <label class="form-check-label" for="inlineRadio2">Accept</label>
                        </div>                            
                    </div>                                           
                    <div class="col-lg-3">
                        <button class="btn btn-success mb-3 ml-3" id="btnSave"> <span class="text">Submit</span></button>
                    </div>
                </div>        
            </div>         
            @endif                      
            
        </div>
    </div>
</div>    
<br>