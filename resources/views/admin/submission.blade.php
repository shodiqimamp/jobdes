@extends('admin/admin')
@section('judul_halaman','Pengajuan')
@section('content')
<div id="smartwizard">
    <ul>
        <li><a href="#step-1">Step 1<br /><small>Identifikasi Jabatan</small></a></li>
        <li><a href="#step-2">Step 2<br /><small>Tanggung Jawab Utama</small></a></li>
        <li><a href="#step-3">Step 3<br /><small>Dimensi Jabatan</small></a></li>
        <li><a href="#step-4">Step 4<br /><small>Hubungan Kerja</small></a></li>
        <li><a href="#step-5">Step 5<br /><small>Kewenangan</small></a></li>
        <li><a href="#step-6">Step 6<br /><small>Tantangan Jabatan</small></a></li>
        <li><a href="#step-7">Step 7<br /><small>Spesifikasi Jabatan</small></a></li>
        <li><a href="#step-8">Step 8<br /><small>Summary</small></a></li>
    </ul>        
    <div>
        <div id="step-1" class="">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Identifikasi Jabatan</h6>
                </div>
                <div class="card-body">                        
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="email">Nama Jabatan</label>
                                <input type="text" class="form-control form-control-sm" id="namaJabatan" name="namaJabatan" value="{{$detailJabatan->jabatan}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">ID Jabatan</label>
                                <input type="text" class="form-control form-control-sm" id="idJabatan" name="idJabatan" value="-" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Atasan Langsung</label>
                                <input type="text" value="{{$detailJabatan->atasan_langsung}}" class="form-control form-control-sm" id="atasanLangsung" name="atasanLangsung" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Atasan Tidak Langsung</label>
                                <input type="text" class="form-control form-control-sm" id="atasanTidakLangsung" name="atasanTidakLangsung" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Lokasi Kerja</label>
                                <input type="text" class="form-control form-control-sm" id="lokasiKerja" name="lokasiKerja" value="{{$detailJabatan->unit}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="email">Tanggal</label>
                                <input type="text" class="form-control form-control-sm" id="tanggal" name="tanggal" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Direktorat</label>
                                <input type="text" class="form-control form-control-sm" id="direktorat" name="direktorat" readonly value="{{$detailJabatan->direktorat}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Divisi/Satuan/SBU</label>
                                <input type="text" class="form-control form-control-sm" id="divisi" name="divisi" readonly value="{{$detailJabatan->divisi}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Bidang</label>
                                <input type="text" class="form-control form-control-sm" id="bidang" name="bidang" readonly value="{{$detailJabatan->bidang}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Sub Bidang</label>
                                <input type="text" class="form-control form-control-sm" id="subBidang" name="subBidang"  value="{{$detailJabatan->sub_bidang}}" readonly>
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
                    <input type="hidden" id="h_id_jd" name="hIdJd" value="{{$jd->id}}">                    
                </div>
                <div class="card-body">
                    <div class="form-group">                
                    <textarea class="form-control" id="tujuanJabatan" rows="2" name="tujuanJabatan" required>{{$jd->tujuan_jabatan}}</textarea>
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
                            <textarea class="form-control" id="tanngungJawab" rows="2" name="tanggungJawab[]" placeholder="Tanggung Jawab Utama" required>{{$tgJawab[$i]->tj_utama}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">  
                            <div class="row">
                                <input type="hidden" id="h_id_tanggung_jawab" name="hIdTanggungJawab[]" value="{{$tgJawab[$i]->id}}">                    
                                <div class="col-lg-11">
                                    <div class="form-group">                
                                    <textarea class="form-control" id="indikatorKinerja" rows="2" placeholder="Indikator Kinerja" name="indikatorKinerja[]" required>{{$tgJawab[$i]->indikator_kinerja}}</textarea>                    
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
                    <h6 style="color:black" class="mb-3"><b>Dimensi Keuangan</b></h6>               
                    <h6 style="color:black" class="mb-3">Anggaran yang dikelola </h6>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="capex" class="ccol-form-label">Capex</label>                        
                                <input type="text" class="form-control form-control-sm" id="capex" name="capex" placeholder="Rp" value="{{number_format($jd->anggaran_capex,0,',','.')}}">
                            </div>        
                        </div>            
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="opex" class="col-form-label">Opex</label>      
                                <input type="text" class="form-control form-control-sm" id="opex" name="opex" placeholder="Rp" value="{{number_format($jd->anggaran_opex,0,',','.')}}">                        
                            </div>
                        </div>
                    </div> 
                    <hr class="sidebar-divider">  
                    <h6 style="color:black" class="mb-3 mt-4"><b>Dimensi Non Keuangan</b></h6>
                    <h6 style="color:black" class="mb-2">Jumlah SDM yang dikelola </h6>

                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="officer" class="col-form-label">Officer</label>               
                                <input type="number" class="form-control form-control-sm" id="officer" name="officer" placeholder="" value="{{$jd->jumlah_officer}}">                    
                            </div>        
                            <div class="form-group">
                                <label for="engineer" class="col-form-label">Engineer</label>
                                <input type="number" class="form-control form-control-sm" id="engineer" name="engineer" placeholder="" value="{{$jd->jumlah_engineer}}">                    
                            </div>            
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="tko" class="col-form-label">TKO</label>                
                                <input type="number" class="form-control form-control-sm" id="tko" name="tko" placeholder="" value="{{$jd->jumlah_tko}}">                
                            </div>                                                         
                        </div>        
                    </div>                  
                    <hr class="sidebar-divider">                
                    
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="pdSumbangan">Jumlah Produk Digital Yang Disumbangkan</label>      
                                <input type="number" class="form-control form-control-sm" id="pdSumbangan" name="pdSumbangan" placeholder="" value="{{$jd->jumlah_product_digital}}">
                            </div>            
                            <div class="form-group">
                                <label for="pdPrototype">Prototype Produk Digital</label>                               
                                <input type="number" class="form-control form-control-sm" id="pdPrototype" name="pdPrototype" placeholder="" value="{{$jd->jumlah_prototype}}">
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="transKnowledge">Kegiatan Transfer Knowledge</label>  
                                <input type="number" class="form-control form-control-sm" id="transKnowledeg" name="transKnowledge" placeholder="" value="{{$jd->jumlah_kegiatan_tfknowledge}}">
                            </div>
                            <div class="form-group">
                                <label for="pdPortofolio">Portofolio Produk Digital</label>        
                                <input type="number" class="form-control form-control-sm" id="pdPortofolio" name="pdPortofolio" placeholder="" value="{{$jd->jumlah_portofolio}}">
                            </div>  
                        </div>
                    </div>                                       
                    <div class="form-group">
                        <label for="pdKatalogHarga">Katalog Harga Produk Digital</label>
                        <input type="file" class="form-control-file" id="pdKatalogHarga">
                    </div>       
                </div>
            </div>     
        </div>
        <div id="step-4" class="">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Hubungan Kerja</h6>                            
                </div>
                <div class="card-body">                        
                <h6 style="color:black" class="mb-3"><b>Internal</b></h6>
                    <div id="fieldHubInternal">
                        @for($i=0; $i<count($hubKerjaInternal); $i++)                  
                        <div class="row">
                            <div class="col-lg-5 mb-4">
                                <div class="form-group">                
                                <textarea class="form-control" id="internal" rows="2" name="internal[]" required>{{$hubKerjaInternal[$i]->hk}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-7 mb-4">  
                                <div class="row">
                                    <input type="hidden" id="h_id_internal" name="hIdInternal[]" value="{{$hubKerjaInternal[$i]->id}}">
                                    <div class="col-lg-11">
                                        <div class="form-group">                
                                            <textarea class="form-control" id="tujuanInternal" rows="2" name="tujuanInternal[]" required>{{$hubKerjaInternal[$i]->tujuan}}</textarea>                    
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
                                <textarea class="form-control" id="external" rows="2" name="external[]" required>{{$hubKerjaExternal[$i]->hk}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-7 mb-4">  
                                <div class="row">
                                    <input type="hidden" id="h_id_external" name="hIdExternal[]" value="{{$hubKerjaExternal[$i]->id}}">
                                    <div class="col-lg-11">
                                        <div class="form-group">                
                                            <textarea class="form-control" id="tujuanExternal" rows="2"  name="tujuanExternal[]" required>{{$hubKerjaExternal[$i]->tujuan}}</textarea>              
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
                    <h6 class="m-0 font-weight-bold text-primary">Kewenangan</h6>
                    <div class="dropdown no-arrow">
                        <i class="fas fa-plus" style="color:blue" id="addKewenangan"></i>                
                    </div>
                </div>
                <div class="card-body" id="addFieldKewenangan">   
                    @for($i=0; $i<count($kewenangan); $i++) 
                    <div class="row">
                        <input type="hidden" id="h_id_kewenangan" name="hIdKewenangan[]" value="{{$kewenangan[$i]->id}}">
                        <div class="col-lg-11">
                            <div class="form-group">                
                                <input type="text" class="form-control" id="kewenangan" name="kewenangan[]" placeholder="Kewenangan" value="{{$kewenangan[$i]->name}}">
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
                    <h6 class="m-0 font-weight-bold text-primary">Tantangan Jabatan</h6>
                    <div class="dropdown no-arrow">
                        <i class="fas fa-plus" style="color:blue" id="addJabatan"></i>                
                    </div>
                </div>
                <div class="card-body" id="addFieldJabatan">   
                    @for($i=0; $i<count($tantanganJabatan); $i++)                 
                    <div class="row">
                        <input type="hidden" id="h_id_tantangan_jabatan" name="hIdTantanganJabatan[]" value="{{$tantanganJabatan[$i]->id}}">
                        <div class="col-lg-11">
                            <div class="form-group">                
                                <input type="text" class="form-control" id="tantanganJabatan" name="tantanganJabatan[]" placeholder="Tantangan Jabatan" value="{{$tantanganJabatan[$i]->name}}">
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
                                <input type="text" class="form-control col-sm-11" id="pendidikan" name="pendidikan" value="{{$jd->pendidikan}}">
                            </div>
                            <div id="fieldSertifikasi">  
                                @for($i=0; $i<count($sertifikasi); $i++)                           
                                <div class="form-group">
                                    @if($i==0)
                                    <label for="sertifikasi">Sertifikasi</label>                       
                                    @endif
                                    <div class="row">
                                    <input type="hidden" id="h_id_sertifikasi" name="hIdSertifikasi[]" value="{{$sertifikasi[$i]->id}}">
                                        <div class="col-lg-11">
                                            <input type="text" class="form-control" id="sertifikasi" name="sertifikasi[]" value="{{$sertifikasi[$i]->name}}">
                                        </div>
                                        <div class="col-lg-1">                            
                                            @if($i==0)
                                            <i class="fas fa-plus" style="color:blue" id="addSertifikasi"></i>
                                            @else
                                            <i class="fas fa-times remove_sertifikasi" style="color:red" ></i>
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
                                <input type="text" class="form-control col-sm-11" id="pengalaman" name="pengalaman" value="{{$jd->pengalaman}}">
                            </div>
                            <div id="fieldPelatihan">
                                @for($i=0; $i<count($pelatihanWajib); $i++)
                                <div class="form-group">
                                    @if($i==0)
                                    <label for="pendidikan">Pelatihan Wajib</label>
                                    @endif
                                    <div class="row">
                                    <input type="hidden" id="h_id_pelatihan" name="hIdPelatihan[]" value="{{$pelatihanWajib[$i]->id}}">
                                        <div class="col-lg-11">
                                            <input type="text" class="form-control" id="pelatihan" name="pelatihan[]" value="{{$pelatihanWajib[$i]->name}}">
                                        </div>
                                        <div class="col-lg-1">
                                            @if($i==0)
                                            <i class="fas fa-plus" style="color:blue" id="addPelatihan"></i>
                                            @else 
                                            <i class="fas fa-times remove_pelatihan" style="color:red" ></i>
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
                                <input type="hidden" id="h_id_pengetahuan" name="hIdPengetahuan[]" value="{{$pengetahuan[$i]->id}}">
                                <div class="col-lg-11">
                                    <input type="text" class="form-control" id="pengetahuan" name="pengetahuan[]" value="{{$pengetahuan[$i]->name}}">
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
                                <input type="hidden" id="h_id_keahlian" name="hIdKeahlian[]" value="{{$keahlian[$i]->id}}">
                                <div class="col-lg-11">
                                    <input type="text" class="form-control" id="keahlian" name="keahlian[]" placeholder="" value="{{$keahlian[$i]->name}}">
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
                            <input type="hidden" id="h_id_kompetensi" name="hIdKompetensi[]" value="{{$kompetensi[$i]->id}}">
                                <div class="col-lg-11">
                                    <input type="text" class="form-control" id="kompetensi" name="kompetensi[]" value="{{$kompetensi[$i]->name}}">
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
            <div class="card shadow mb-4">                    
                <div class="card-body"> 
                    <h6 style="color:black" class="mb-3 mt-3"><b>Identifikasi Jabatan</b></h6>
                    <table class="table table-striped" cellspacing="0"> 
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
                                <td style="float: left;">Jr Engineer Delevery Maintenance</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Atasan Langsung</td>
                                <td>:</td>
                                <td>Jr Engineer Delevery Maintenance</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Atasan Tidak Langsung</td>
                                <td>:</td>
                                <td style="float: left;">Jr Engineer Delevery Maintenance</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Tujuan Jabatan</td>
                                <td>:</td>
                                <td style="float: left;">Jr Engineer Delevery MaintenanceJr </td>
                            </tr>
                        </tbody>                        
                    </table>
                    <br>
                    <h6 style="color:black" class="mb-3 mt-3"><b>Tanggun Jawab Utama</b></h6>
                    <table class="table table-striped"  width="100%" cellspacing="0">
                        <thead>
                            <tr>                    
                                <th scope="col">Tanggung Jawab Utama</th>
                                <th scope="col">Indikator Kinerja</th>
                            </tr>
                        </thead>
                        <tbody>                                
                        </tbody>                        
                    </table>
                    <br>
                    <h6 style="color:black" class="mb-3 mt-3"><b>Dimensi Jabatan</b></h6>
                    <table class="table table-striped"  width="100%" cellspacing="0">
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
                                <td style="float: left;">Rp 123.456.765</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Anggaran Opex</td>
                                <td>:</td>
                                <td style="float: left;">Rp 123.456.765</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Jumlah Offiecer</td>
                                <td>:</td>
                                <td>10 Orang</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Jumlah TKO</td>
                                <td>:</td>
                                <td style="float: left;">11 Orang</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Jumlah Engineer</td>
                                <td>:</td>
                                <td style="float: left;">100 Orang</td>
                            </tr>
                            <tr>
                                <td style="float: right;">Jumlah Produk Digital Yang Disumbangkan</td>
                                <td>:</td>
                                <td style="float: left;"></td>
                            </tr>
                            <tr>
                                <td style="float: right;">Jumlah Kegiatan Transfer Knowledge</td>
                                <td>:</td>
                                <td style="float: left;"></td>
                            </tr>
                            <tr>
                                <td style="float: right;">Jumlah Prototype Produk Digital</td>
                                <td>:</td>
                                <td style="float: left;"></td>
                            </tr>
                            <tr>
                                <td style="float: right;">Jumlah Portofolio Produk Digital</td>
                                <td>:</td>
                                <td style="float: left;"></td>
                            </tr>
                        </tbody>                        
                    </table>
                    <br>
                    <h6 style="color:black" class="mb-3 mt-3"><b>Hubungan Kerja Internal</b></h6>
                    <table class="table table-striped"  width="100%" cellspacing="0">
                        <thead>
                            <tr>                    
                                <th scope="col">Pihak Internal</th>
                                <th scope="col">Tujuan</th>
                            </tr>
                        </thead>
                        <tbody>                                
                        </tbody>                        
                    </table>
                    <br>
                    <h6 style="color:black" class="mb-3 mt-3"><b>Hubungan Kerja External</b></h6>
                    <table class="table table-striped"  width="100%" cellspacing="0">
                        <thead>
                            <tr>                    
                                <th scope="col">Pihak External</th>
                                <th scope="col">Tujuan</th>
                            </tr>
                        </thead>
                        <tbody>                                
                        </tbody>                        
                    </table>
                    <br>
                    <h6 style="color:black" class="mb-3 mt-3"><b>Kewenangan</b></h6>
                    <table class="table table-striped"  width="100%" cellspacing="0">
                        <thead>
                            <tr>                    
                                <th scope="col"></th>                                    
                            </tr>
                        </thead>
                        <tbody> 
                            <tr>                    
                                <th>Kewenangan Jabatan</th>                                    
                            </tr>                               
                        </tbody>                        
                    </table>
                    <br>
                    <h6 style="color:black" class="mb-3 mt-3"><b>Tantangan Jabatan</b></h6>
                    <table class="table table-striped"  width="100%" cellspacing="0">
                        <thead>
                            <tr>                    
                                <th scope="col"></th>                                    
                            </tr>
                        </thead>
                        <tbody> 
                            <tr>                    
                                <th>Tantangan Jabatan</th>                                    
                            </tr>                               
                        </tbody>                        
                    </table>
                    <br>
                    <h6 style="color:black" class="mb-3 mt-3"><b>Spesifikasi Jabatan</b></h6>
                    <table class="table table-striped"  width="100%" cellspacing="0">
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
                                <td style="float: left;"></td>
                            </tr>
                            <tr>                    
                                <td style="float: right;">Pengalaman</td>
                                <td>:</td>
                                <td style="float: left;"></td>
                            </tr>
                        </tbody>                        
                    </table>
                </div>                    
            </div>    
            
            <button class="btn btn-success btn-icon-split my-3">        
                <span class="text">Submit</span>
            </button>
        </div>
    </div>
</div>    
<br>
@endsection

@section('modals')
    <!-- Konfirmasi Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Warningg . . </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body" id="warningMessage"></div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" id="deleteData">Hapus</a>
            </div>
        </div>
        </div>
    </div>

@endsection


@section('scripts')
<script type="text/javascript" src="{{asset('dist/js/jquery.smartWizard.min.js')}}"></script>
<script type="text/javascript"> 

    var rupiahCapex = document.getElementById('capex');    
    rupiahCapex.addEventListener('keyup', function(e){
        rupiahCapex.value = formatRupiah(this.value);
    });
    
    rupiahCapex.addEventListener('keydown', function(event){
        limitCharacter(event);
    });
    
    var rupiahOpex = document.getElementById('opex');
    rupiahOpex.addEventListener('keyup', function(e){
        rupiahOpex.value = formatRupiah(this.value);
    });
    
    rupiahOpex.addEventListener('keydown', function(event){
        limitCharacter(event);
    });

    function formatRupiah(bilangan, prefix){
        var number_string = bilangan.replace(/[^,\d]/g, '').toString(),
            split	= number_string.split(','),
            sisa 	= split[0].length % 3,
            rupiah 	= split[0].substr(0, sisa),
            ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
        
    function limitCharacter(event){
        key = event.which || event.keyCode;
        if ( key != 188 // Comma
            && key != 8 // Backspace
            && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
            && (key < 48 || key > 57) // Non digit
            // Dan masih banyak lagi seperti tombol del, panah kiri dan kanan, tombol tab, dll
            ) 
        {
            event.preventDefault();
            return false;
        }
    }
      
    $(document).ready(function() {     
        $warningMessage= "Apakah yakin ingin menghapus field";
        $tagRemov="";
        $valTagRemove="";
        $tagRemoveType="";

        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
            //alert("You are on step "+stepNumber+" now");
            if(stepPosition === 'first'){
                $("#prev-btn").addClass('disabled');
            }else if(stepPosition === 'final'){                    
                $("#next-btn").text('Finish')
                                            .addClass('btn btn-info');
                $("#tblNamaJabatan").text($('#h_nama_jabatan').val());
                                                                                                    
            }else{
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
                
            }
        });            

        // Smart Wizard
        $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                transitionEffect:'fade',
                showStepURLhash: true,
                toolbarSettings: {
                    toolbarPosition: 'false',                                      
                    }
        });
        
        $('#addTanggungJawab').click(function(e){          
            $form = $('#addField');
            $form.append("<div class='row'><div class='col-lg-6 mb-4'><div class='form-group'><textarea class='form-control' id='tanngunJawab' rows='2' name='tanggungJawab[]' placeholder='Tanggung Jawab Utama' required></textarea></div></div><div class='col-lg-6 mb-4'> <div class='row'><div class='col-lg-11'><div class='form-group'><textarea class='form-control' id='indikatorKinerja' rows='2' placeholder='Indikator Kinerja' name='indikatorKinerja[]' required></textarea></div></div><div class='col-lg-1'><i class='remove_tanggung_jawab fas fa-times float-right' style='color:red'></i></div></div></div></div>");                               
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
            $form.append("<div class='row'><div class='col-lg-5 mb-4'><div class='form-group'><textarea class='form-control' id='internal' rows='2' name='internal[]' placeholder='Internal' required></textarea></div></div><div class='col-lg-7 mb-4'> <div class='row'><div class='col-lg-11'><div class='form-group'><textarea class='form-control' id='tujuanInternal' rows='2' placeholder='Tujuan' name='tujuanInternal[]' required></textarea></div></div><div class='col-lg-1'><i class='remove_internal fas fa-times float-right' style='color:red'></i></div></div></div></div>");                               
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
            $form.append("<div class='row'><div class='col-lg-5 mb-4'><div class='form-group'><textarea class='form-control' id='external' rows='2' name='external[]' placeholder='External' required></textarea></div></div><div class='col-lg-7 mb-4'> <div class='row'><div class='col-lg-11'><div class='form-group'><textarea class='form-control' id='tujuanExternal' rows='2' placeholder='Tujuan' name='tujuanExternal[]' required></textarea></div></div><div class='col-lg-1'><i class='remove_external fas fa-times float-right' style='color:red'></i></div></div></div></div>");    
            
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
            $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control' id='kewenangan' name='kewenangan[]' placeholder='Kewenangan'></div></div><div class='col-lg-1'><i class='remove_kewenangan fas fa-times float-right' style='color:red'></i></div></div>");                                 
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
            $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control' id='tantanganJabatan' name='tantanganJabatan[]' placeholder=''></div></div><div class='col-lg-1'><i class='remove_jabatan fas fa-times float-right' style='color:red'></i></div></div>");                                           
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
            $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control' id='sertifikasi' name='sertifikasi[]' placeholder=''></div></div><div class='col-lg-1'><i class='remove_sertifikasi fas fa-times' style='color:red'></i></div></div>");                                           
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
            $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control' id='pelatihan' name='pelatihan[]' placeholder=''></div></div><div class='col-lg-1'><i class='remove_pelatihan fas fa-times' style='color:red'></i></div></div>");                                           
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
            $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control' id='pengetahuan' name='pengetahuan[]' placeholder=''></div></div><div class='col-lg-1'><i class='remove_pengetahuan fas fa-times' style='color:red'></i></div></div>");                                           
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
            $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control' id='kompetensi' name='kompetensi[]' placeholder=''></div></div><div class='col-lg-1'><i class='remove_kompetensi fas fa-times' style='color:red'></i></div></div>");                                           
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
            $form.append("<div class='row'><div class='col-lg-11'><div class='form-group'><input type='text' class='form-control' id='keahlian' name='keahlian[]' placeholder=''></div></div><div class='col-lg-1'><i class='remove_keahlian fas fa-times' style='color:red'></i></div></div>");                                           
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
       
        $('#btnSave').click(function(e){ 
            var result = confirm("Are you sure?");
            if (result) {
                var fd = new FormData();
                $x = $('.allData');
                for (var i = 0; i < $x.length; i++) {
                    fd.append($x[i].name, $x[i].value);
                }
                $.ajax({
                    type: 'POST',
                    url: 'submission',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {                            
                        if(response.status == "success"){
                            swal({
                                title: "Pengajuan Berhasil", 
                                type: "success"
                            }).then (function() {                                    
                                window.location.href = "{{url('/')}}";                 
                            });
                        }                            
                    }
                });                    
            }
        });
        
        $('#deleteData').click(function(){
            $url="";
            if($tagRemoveType=="SPESIFIKASI"){
                $url="{{ url('delete/keahlian') }}/"+$valTagRemove;
            }else if($tagRemoveType=="TANTANGANJABATAN"){
                $url="{{ url('delete/tantangan') }}/"+$valTagRemove;
            }else if($tagRemoveType=="KEWENANGAN"){
                $url="{{ url('delete/kewenangan') }}/"+$valTagRemove;
            }else if($tagRemoveType=="TANGGUNG JAWAB"){
                $url="{{ url('delete/tanggung-jawab') }}/"+$valTagRemove;
            }else if($tagRemoveType=="HUBUNGAN KERJA"){
                $url="{{ url('delete/hubungan-kerja') }}/"+$valTagRemove;
            }
                       
            $.ajax({
            type: "GET", 
            url: $url,             
            dataType: "json",
            beforeSend: function(e) {
                if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(response){                 
                
                if(response.status){
                    $tagRemove.remove(); 
                    $('#deleteModal').modal('hide');
                    $tagRemov="";
                    $valTagRemove="";
                    $tagRemoveType="";
                }                             
                
            },
            error: function (xhr, ajaxOptions, thrownError) { 
                // alert(thrownError); 
            }
         });
        });
        
    });
</script>

@endsection