<div id="smartwizard">
    <ul>
        <li><a href="#step-1">Step 1<br /><small>Identifikasi Jabatan</small></a></li>
        <li><a href="#step-2">Step 2<br /><small>Tanggung Jawab Utama</small></a></li>
        <li><a href="#step-3">Step 3<br /><small>Dimensi Jabatan</small></a></li>
        <li><a href="#step-4">Step 4<br /><small>Hubungan Kerja</small></a></li>
        <li><a href="#step-5">Step 5<br /><small>Kewenangan</small></a></li>
        <li><a href="#step-6">Step 6<br /><small>Tantangan Jabatan</small></a></li>
        <li><a href="#step-7">Step 7<br /><small>Spesifikasi Jabatan</small></a></li>
        <li><a href="#step-8">Step 8<br /><small>Submit Form</small></a></li>
    </ul>
    <div>
        <div id="step-1" class="">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Identifikasi Jabatan</h6>
                </div>
                <div class="card-body">
                    <br>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="email">Direktorat</label>
                                <select class="form-control  form-control-sm selectpicker allData" required id="direktorat" name="direktorat">
                                    <option disabled="disabled" selected="selected" value="">Pilih direktorat</option>
                                    @foreach($dir as $direktorat )
                                    <option value="{{$direktorat->direktorat}}">{{$direktorat->direktorat}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="divis">Divisi/Satuan/SBU</label>
                                <select class="form-control form-control-sm allData"   id="divisi" name="divisi">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Bidang</label>
                                <select class="form-control form-control-sm allData"  required id="bidang" name="bidang">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Sub Bidang</label>
                                <select class="form-control form-control-sm allData"  required id="subBidang" name="subBidang">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Nama Jabatan</label>
                                <select class="form-control form-control-sm  allData"  required id="namaJabatan" name="namaJabatan">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="email">Tanggal</label>
                                <input type="text" class="form-control form-control-sm" id="tanggal" name="tanggal" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">ID Jabatan</label>
                                <input type="text" class="form-control form-control-sm allData" id="idJabatan" name="idJabatan" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Atasan Langsung</label>
                                <input type="text" class="form-control form-control-sm allData" id="atasanLangsung" name="atasanLangsung" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Atasan Tidak Langsung</label>
                                <input type="text" class="form-control form-control-sm allData" id="atasanTidakLangsung" name="atasanTidakLangsung" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Lokasi Kerja</label>
                                <input type="text" class="form-control form-control-sm allData" id="lokasiKerja" name="lokasiKerja">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="step-2" class="">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tujuan Jabatan <span class="asteris">*</span></h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                    <textarea class="form-control allData" id="tujuanJabatan" rows="2" name="tujuanJabatan" placeholder="Tujuan jabatan"  required></textarea>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tanggung Jawab Utama <span class="asteris">*</span></h6>
                    <div class="dropdown no-arrow">
                        <i class="fas fa-plus" style="color:blue" id="addTanggungJawab"></i>
                    </div>
                </div>
                <div class="card-body" id="addField">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                            <textarea class="form-control allData" id="tanngungJawab" rows="2" name="tanggungJawab[]" placeholder="Tanggung Jawab Utama" required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="form-group">
                                    <textarea class="form-control allData" id="indikatorKinerja" rows="2" placeholder="Indikator Kinerja" name="indikatorKinerja[]" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <input type="text" class="form-control form-control-sm allData" id="capex" name="capex" placeholder="Rp" required>
                            </div>
                        </div>                        
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="opex" class="col-form-label">Opex</label>
                                <input type="text" class="form-control form-control-sm allData" id="opex" name="opex" placeholder="Rp" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="capex" class="col-form-label">Target Pendapatan</label>
                                <input type="text" class="form-control form-control-sm allData" id="target" name="target" placeholder="Rp" required>
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
                                <input type="number" class="form-control form-control-sm allData" id="officer" name="officer" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="engineer" class="col-form-label">Engineer</label>
                                <input type="number" class="form-control form-control-sm allData" id="engineer" name="engineer" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="tko" class="col-form-label">TKO</label>
                                <input type="number" class="form-control form-control-sm allData" id="tko" name="tko" placeholder="">
                            </div>
                        </div>
                    </div> -->
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
                    <hr class="sidebar-divider">
                    <div id="fieldDimensi">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm allData" id="deskripsi" name="deskripsi[]" placeholder="deskripsi">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm allData" id="jumlah" name="jumlah[]" placeholder="jumlah">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <select class="form-control form-control-sm allData classSatuan" id="satuan" name="satuan[]">
                                                <option selected disabled>Pilih Satuan</option>
                                                @foreach($satuan as $sat )
                                                <option value="{{$sat->name}}">{{$sat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalSatuan">
                                        <i class="fas fa-plus" id="addNewSatuan"></i> Satuan
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <span class="btn btn-primary btn-sm" id="addNewDimensi">
                                    <i class="fas fa-plus" ></i>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="step-4" class="">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Hubungan Kerja <span class="asteris">*</span> <i class="fas fa-question-circle fa-sm" data-toggle="tooltip" data-placement="right" title='Jika tidak ada, diisi "-"' style="color:blue"></i></h6>
                </div>
                <div class="card-body">
                <h6 style="color:black" class="mb-3"><b>Internal</b></h6>
                    <div id="fieldHubInternal">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                <textarea class="form-control allData" id="internal" rows="2" name="internal[]" placeholder="Internal" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-lg-11">
                                        <div class="form-group">
                                            <textarea class="form-control allData" id="tujuanInternal" rows="2" placeholder="Tujuan" name="tujuanInternal[]" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <i class="fas fa-plus float-right" style="color:blue" id="addHubInternal"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6 style="color:black" class="mb-3"><b>External</b></h6>
                    <div id="fieldHubExternal">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                <textarea class="form-control allData" id="external" rows="2" name="external[]" placeholder="External" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-lg-11">
                                        <div class="form-group">
                                            <textarea class="form-control allData" id="tujuanExternal" rows="2" placeholder="Tujuan" name="tujuanExternal[]" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <i class="fas fa-plus float-right" style="color:blue" id="addHubExternal"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <div class="row">
                        <div class="col-lg-11">
                            <div class="form-group">
                                <input type="text" class="form-control allData" id="kewenangan" name="kewenangan[]" placeholder="Kewenangan" required>
                            </div>
                        </div>
                    </div>
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
                    <div class="row">
                        <div class="col-lg-11">
                            <div class="form-group">
                                <input type="text" class="form-control allData" id="jabatan" name="tantanganJabatan[]" placeholder="Tantangan Jabatan" required>                                
                            </div>
                        </div>
                    </div>
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
                                <input type="text" class="form-control form-control-sm col-sm-10 allData" id="pendidikan" name="pendidikan" placeholder="S1 Teknik Komputer" required>
                            </div>
                            <div id="fieldSertifikasi">
                                <div class="form-group">
                                    <label for="sertifikasi">Sertifikasi</label>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control form-control-sm allData" id="sertifikasi" name="sertifikasi[]" placeholder="" required>
                                        </div>
                                        <div class="col-lg-1">
                                            <span class="btn btn-primary btn-sm" id="addSertifikasi">
                                                <i class="fas fa-plus" ></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pendidikan">Pengalaman (Tahun)</label>
                                <input type="number" class="form-control form-control-sm col-sm-10 allData" id="pengalaman" name="pengalaman" placeholder="" required>
                            </div>
                            <div id="fieldPelatihan">
                                <div class="form-group">
                                    <label for="pendidikan">Pelatihan Wajib</label>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control form-control-sm allData" id="pelatihan" name="pelatihan[]" placeholder="" required>
                                        </div>
                                        <div class="col-lg-1">
                                            <span class="btn btn-primary btn-sm" id="addPelatihan">
                                                <i class="fas fa-plus" ></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 style="color:black" class="mb-3 mt-3"><b>Pengetahuan, Keterampilan, Kemampuan & Kompetensi</b></h6>
                    <div id="fieldPengetahuan">
                        <div class="form-group">
                            <label for="pengetahuan">Pengetahuan</label>
                            <div class="row">
                                <div class="col-lg-11">
                                    <input type="text" class="form-control allData" id="pengetahuan" name="pengetahuan[]" placeholder="" required>
                                </div>
                                <div class="col-lg-1">
                                    <i class="fas fa-plus" style="color:blue" id="addPengetahuan"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="fieldKeahlian">
                        <div class="form-group">
                            <label for="keahlian">Keahlian</label>
                            <div class="row">
                                <div class="col-lg-11">
                                    <input type="text" class="form-control allData" id="keahlian" name="keahlian[]" placeholder="" required>
                                </div>
                                <div class="col-lg-1">
                                    <i class="fas fa-plus" style="color:blue" id="addKeahlian"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="fieldKompetensi">
                        <div class="form-group">
                            <label for="kompetensi">Kompetensi</label>
                            <div class="row">
                                <div class="col-lg-11">
                                    <input type="text" class="form-control allData" id="kompetensi" name="kompetensi[]" placeholder="" required>
                                </div>
                                <div class="col-lg-1">
                                    <i class="fas fa-plus" style="color:blue" id="addKompetensi"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="step-8" class="">
        @include('admin/global/viewjs')
        </div>
    </div>
</div>


