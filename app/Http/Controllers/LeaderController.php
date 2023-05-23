<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon;
use Illuminate\Support\Facades\Session;
use Validator;

class LeaderController extends Controller{   

    public function approval(){        
        $notif = DB::table('job_description')->select('id','submission_name','nama_jabatan','tanggal_pengajuan')->where('status','PENGAJUAN')->get();
        return view('admin.approval',['notification'=>$notif]);
    }

    public function approvalView($id){    
        $jd = DB::table('job_description')->select('*')->where('id',$id)->first();
        $detailJabatan = DB::table('jabatan')->select('*')->where('id_jabatan',$jd->id_jabatan)->first();
        $tanggungJawab = DB::table('tanggung_jawab')->select('*')->where('jd_id',$jd->id)->get();        
        $hubKerjaInternal = DB::table('hubungan_kerja')->select('*')->where('jd_id',$jd->id)->where('hk_type','INTERNAL')->get();
        
        $hubKerjaExternal = DB::table('hubungan_kerja')->select('*')->where('jd_id',$jd->id)->where('hk_type','ExTERNAL')->get();
        $kewenangan = DB::table('kewenangan')->select('*')->where('jd_id',$jd->id)->get();
        $tantanganJabatan = DB::table('tantangan_jabatan')->select('*')->where('jd_id',$jd->id)->get();

        $sertifikasi = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','SERTIFIKASI')->get();
        $pelatihanWajib = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','PELATIHANWAJIB')->get();
        $pengetahuan = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','PENGETAHUAN')->get();
        $keahlian = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','KEAHLIAN')->get();
        $kompetensi = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','KOMPETENSI')->get();
        $satuan = DB::table('satuan')->select('*')->get();  
        $nonKeu = DB::table('non_keuangan')->select('*')->where('jd_id',$jd->id)->whereNotIn('deskripsi', ['Supervisor','TKO','Manager','Officer', 'Engineer'])->get();    
        $bawahan = DB::table('non_keuangan')->select('*')->where('jd_id',$jd->id)->whereIn('deskripsi', ['Supervisor','TKO','Manager','Officer', 'Engineer'])->get();   
        
        return view('admin.approvalview',[
            'jd'                =>$jd,
            'detailJabatan'     =>$detailJabatan,
            'tgJawab'           =>$tanggungJawab,            
            'hubKerjaInternal'  =>$hubKerjaInternal,
            'hubKerjaExternal'  =>$hubKerjaExternal,
            'kewenangan'        =>$kewenangan,
            'tantanganJabatan'  =>$tantanganJabatan,
            'sertifikasi'       =>$sertifikasi,
            'pelatihanWajib'    =>$pelatihanWajib,
            'pengetahuan'        =>$pengetahuan,            
            'keahlian'          =>$keahlian,
            'kompetensi'        =>$kompetensi,
            'nonKeu'            =>$nonKeu,
            'satuan'            =>$satuan,
            'bawahan'           =>$bawahan,
        ]);            
    }

    public function approvalAct(Request $request){                    

        $validator = Validator::make($request->all(), [            
            'lokasiKerja'   => 'required',
            'tujuanJabatan' => 'required', 
            'tanggungJawab' => 'required|array', 'tanggungJawab.*' => 'required', 			
            'indikatorKinerja' => 'required|array','indikatorKinerja.*' => 'required',
            'capex' => 'required','opex' => 'required', 'target' => 'required',             
            'deskripsi' => 'required|array','deskripsi.*' => 'required',
            'jumlah' => 'required|array', 'jumlah.*' => 'required',
            'satuan' => 'required|array', 'satuan.*' => 'required',
            'internal' => 'required|array', 'internal.*' => 'required',
            'tujuanInternal' => 'required|array', 'tujuanInternal.*' => 'required',
            'external' => 'required|array', 'external.*' => 'required',
            'tujuanExternal' => 'required|array', 'tujuanExternal.*' => 'required',
            'kewenangan'=> 'required|array','kewenangan.*'=> 'required',
            'tantanganJabatan'=> 'required|array','tantanganJabatan.*'=> 'required',
            'pendidikan' => 'required', 			
            'pengalaman' => 'required',
            'sertifikasi'=> 'required|array','sertifikasi.*'=> 'required',
            'pelatihan'=> 'required|array','pelatihan.*'=> 'required',
            'pengetahuan'=> 'required|array','pengetahuan.*'=> 'required',
            'keahlian'=> 'required|array','keahlian.*'=> 'required',
            'kompetensi'=> 'required|array','kompetensi.*'=> 'required',
        ]);
        if ($validator->passes()) {            
            $user =  DB::table('job_description')->where('id',$request->hIdJd)->update([
                'id_jabatan'                  => $request->idJabatan,
                'nama_jabatan'                => $request->namaJabatan,                    
                'tujuan_jabatan'              => $request->tujuanJabatan,
                'pendidikan'                  => $request->pendidikan,
                'pengalaman'                  => $request->pengalaman,
                'anggaran_capex'              => str_replace(".","",$request->capex),
                'anggaran_opex'               => str_replace(".","",$request->opex),
                'target_pendapatan'           => str_replace(".","",$request->target),
                'jumlah_officer'              => '0',
                'jumlah_engineer'             => '0',
                'nama_approval'               => Session::get('name'),
                'jumlah_tko'                  => '0',
                'status'                      => $request->approval,                    
                'tanggal_proses'              => Carbon\Carbon::now(),
                'revisi_atasan'               => $request->revisi,     
                'lokasi_kerja'                => $request->lokasiKerja,               
                ]);
                
            //Tantangan Jabatan
            if(isset($request->tantanganJabatan)){
                for($i=0; $i<count($request->tantanganJabatan); $i++){
                    if(isset($request->hIdTantanganJabatan[$i])){
                        $id = $request->hIdTantanganJabatan[$i];
                    }else {
                        $db = DB::table('tantangan_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    DB::table('tantangan_jabatan')->updateOrInsert(
                        [   'id'      => $id ],
                        [                
                            'name'    => $request->tantanganJabatan[$i],
                            'jd_id'   => $request->hIdJd
                    ]);
                }
            }
            
                //Tanggung Jawab Utama
            if(isset($request->tanggungJawab)){
                for($i=0; $i<count($request->tanggungJawab); $i++){
                    if(isset($request->hIdTanggungJawab[$i])){
                        $id = $request->hIdTanggungJawab[$i];
                    }else {
                        $db = DB::table('tanggung_jawab')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    $tanggungJawab = DB::table('tanggung_jawab')->updateOrInsert(
                        ['id' => $id ],
                        [
                            'indikator_kinerja' => $request->indikatorKinerja[$i],
                            'tj_utama'        => $request->tanggungJawab[$i],
                            'jd_id'           => $request->hIdJd
                        ]
                    );
                }        
            }
            

            //Hubungan Kerja Internal     
            if(isset($request->internal)){   
                for($i=0; $i<count($request->internal); $i++){
                    if(isset($request->hIdInternal[$i])){
                        $id = $request->hIdInternal[$i];
                    }else {
                        $db = DB::table('hubungan_kerja')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    DB::table('hubungan_kerja')->updateOrInsert(
                        ['id' => $id ],
                        [
                            'hk'      => $request->internal[$i],
                            'tujuan'  => $request->tujuanInternal[$i],
                            'jd_id'   => $request->hIdJd,
                            'hk_type' => 'INTERNAL'
                        ]
                    );
                }
            }

            // Hubungan Kerja External
            if(isset($request->external)){
                for($i=0; $i<count($request->external); $i++){
                    if(isset($request->hIdExternal[$i])){
                        $id = $request->hIdExternal[$i];
                    }else {
                        $db = DB::table('hubungan_kerja')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    DB::table('hubungan_kerja')->updateOrInsert(
                        ['id' => $id ],
                        [
                            'hk'      => $request->external[$i],
                            'tujuan'  => $request->tujuanExternal[$i],
                            'jd_id'   => $request->hIdJd,
                            'hk_type' => 'EXTERNAL'
                        ]
                    );
                }
            }

            //Kewenangan
            if(isset($request->kewenangan)){
                for($i=0; $i<count($request->kewenangan); $i++){
                    if(isset($request->hIdKewenangan[$i])){
                        $id = $request->hIdKewenangan[$i];
                    }else {
                        $db = DB::table('kewenangan')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    
                    DB::table('kewenangan')->updateOrInsert(
                        ['id' => $id ],
                        [                
                            'name'    => $request->kewenangan[$i],
                            'jd_id'   => $request->hIdJd
                        ]
                    );
                }
            }            

            //Spesifikasi Jabatan        
            // --Sertifikasi
            if(isset($request->sertifikasi)){
                for($i=0; $i<count($request->sertifikasi); $i++){
                    if(isset($request->hIdSertifikasi[$i])){
                        $id = $request->hIdSertifikasi[$i];
                    }else {
                        $db = DB::table('spesifikasi_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    DB::table('spesifikasi_jabatan')->updateOrInsert(
                        [   'id'      => $id ],
                        [                
                            'name'      => $request->sertifikasi[$i],
                            'jd_id'     => $request->hIdJd,
                            'spek_type' => 'SERTIFIKASI'              
                    ]);
                }
            }

            // --Pelatihan  Wajib
            if(isset($request->pelatihan)){
                for($i=0; $i<count($request->pelatihan); $i++){
                    if(isset($request->hIdPelatihan[$i])){
                        $id = $request->hIdPelatihan[$i];
                    }else {
                        $db = DB::table('spesifikasi_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }

                    DB::table('spesifikasi_jabatan')->updateOrInsert(
                        
                        [   'id'      => $id ],
                        [                
                            'name'    => $request->pelatihan[$i],
                            'jd_id'   => $request->hIdJd,
                            'spek_type' => 'PELATIHANWAJIB'                
                    ]);
                }
            }

            // --Pengetahuan
            if(isset($request->pengetahuan)){
                for($i=0; $i<count($request->pengetahuan); $i++){
                    if(isset($request->hIdPengetahuan[$i])){
                        $id = $request->hIdPengetahuan[$i];
                    }else {
                        $db = DB::table('spesifikasi_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    DB::table('spesifikasi_jabatan')->updateOrInsert(
                        [ 'id'      => $id ],
                        [                
                        'name'    => $request->pengetahuan[$i],
                        'jd_id'   => $request->hIdJd,
                        'spek_type' => 'PENGETAHUAN'                
                    ]);
                }
            }
            // --Keahlian
            if(isset($request->keahlian)){
                for($i=0; $i<count($request->keahlian); $i++){
                    if(isset($request->hIdKeahlian[$i])){
                        $id = $request->hIdKeahlian[$i];
                    }else {
                        $db = DB::table('spesifikasi_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    
                    DB::table('spesifikasi_jabatan')->updateOrInsert(
                        [   'id'      => $id ],     
                        [                
                            'name'    => $request->keahlian[$i],
                            'jd_id'   => $request->hIdJd,
                            'spek_type' => 'KEAHLIAN'         
                    ]);
                }
            }

            // --Kompetensi
            if(isset($request->kompetensi)){
                for($i=0; $i<count($request->kompetensi); $i++){ 

                    if(isset($request->hIdKompetensi[$i])){
                        $id = $request->hIdKompetensi[$i];
                    }else {
                        $db = DB::table('spesifikasi_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }                                
                    DB::table('spesifikasi_jabatan')->updateOrInsert(
                        [   'id'      => $id ],                    
                        [                
                            'name'    => $request->kompetensi[$i],
                            'jd_id'   => $request->hIdJd,
                            'spek_type' => 'KOMPETENSI'                
                    ]);
                }
            }

            // --Non Keuangan
            if(isset($request->deskripsi)){
                for($i=0; $i<count($request->deskripsi); $i++){ 
                    if(isset($request->hIdNonKeu[$i])){
                        $id = $request->hIdNonKeu[$i];
                    }else {
                        $db = DB::table('non_keuangan')->latest('id')->first();
                        $id = $db->id+1;
                    }                                
                    DB::table('non_keuangan')->updateOrInsert(
                        [   'id'      => $id ],                    
                        [                
                            'deskripsi' => $request->deskripsi[$i],
                            'jumlah'    => $request->jumlah[$i],
                            'satuan'    => $request->satuan[$i],                            
                            'jd_id'     => $request->hIdJd                                         
                    ]);
                }
            }
            // --Bawahan
            if(isset($request->jumlahBawahan)){
                for($i=0; $i<count($request->jumlahBawahan); $i++){ 
                    if($request->jenisBawahan[$i] != "Pilih Jenjang"){
                        if(isset($request->hIdBawahan[$i])){
                            $id = $request->hIdBawahan[$i];
                        }else {
                            $db = DB::table('non_keuangan')->latest('id')->first();
                            $id = $db->id+1;
                        }                                
                        DB::table('non_keuangan')->updateOrInsert(
                            [   'id'      => $id ],                    
                            [                
                                'deskripsi' => $request->jenisBawahan[$i],
                                'jumlah'    => $request->jumlahBawahan[$i],
                                'satuan'    => 'Orang',                            
                                'jd_id'     => $request->hIdJd                                         
                        ]);                            
                    }
                }
            }
            return response()->json(["status"=>"success"]);              
        }
        return response()->json(["status"=>"error", 'msg'=>$validator->errors()->all()]);       
    }

    public function listSubmission(){
        $data = DB::table('job_description')->select('id','submission_name','nama_jabatan',DB::raw('DATE_FORMAT(tanggal_pengajuan, "%Y-%m-%d") as tanggal_pengajuan'),'status')->whereYear('created_at', '=', date('Y'))->where('status','!=', 'NEW')->where('id_jabatan_approve','=',Session::get('id_jabatan'))->get();        
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){                            
                if($row->status=="PENGAJUAN"){
                    $sts = '<a href="approval/view/'.$row->id.'"><span class="badge badge-danger">Pengajuan</span></a>';
                }else if($row->status=="DISETUJUI") {
                    $sts = '<a href="view/'.$row->id.'"><span class="badge badge-success">Disetujui</span></a></a><a href="view-pdf/'.$row->id.'" target="_blank"><span class="badge badge-primary ml-2">PDF</span></a>';
                } else if($row->status=="DITOLAK" || $row->status=="REJECTED"){
                    $sts = '<a href="approval/view/'.$row->id.'"><span class="badge badge-info">Ditolak</span></a>';
                }else if($row->status=="REVIEW"){
                    $sts = '<a href="view/'.$row->id.'"><span class="badge badge-danger">Review</span></a>';
                }
                
            return $sts;
        }) 
        ->rawColumns(['action','status'])->make(true);        
        // return response()->json(['data'=>$data]);
    }

    public function listMySubmission(){
        $data = DB::table('job_description')->select('id','submission_name','nama_jabatan',DB::raw('DATE_FORMAT(tanggal_pengajuan, "%Y-%m-%d") as tanggal_pengajuan'),'status')->whereYear('created_at', '=', date('Y'))->where('id_jabatan_pic','=',Session::get('id_jabatan'))->get();
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){                            
                if($row->status=="PENGAJUAN" || $row->status=="REVIEW" || $row->status=="REJECTED"){
                    $sts = '<a href="view/'.$row->id.'"><span class="badge badge-danger">Pengajuan</span></a>';
                } else if($row->status=="NEW") {
                    $sts = '<a href="pengajuan/'.$row->id.'"><span class="badge badge-warning">New</span></a>';
                }else if($row->status=="DISETUJUI") {
                    $sts = '<a href="pengajuan/'.$row->id.'"><span class="badge badge-success">Disetujui</span></a></a><a href="view-pdf/'.$row->id.'" target="_blank"><span class="badge badge-primary ml-2">PDF</span></a>';
                } else if($row->status=="DITOLAK"){
                    $sts = '<a href="pengajuan/'.$row->id.'"><span class="badge badge-info">Ditolak</span></a>';
                }
                
            return $sts;
        }) 
        ->rawColumns(['action','status'])->make(true);        
        // return response()->json(['data'=>$data]);
    }

    public function viewSubmission(){
        return view('admin.listsubmission');
    }

    public function pengajuan($id){
        $jd = DB::table('job_description')->select('*')->where('id',$id)->first();
        $detailJabatan = DB::table('jabatan')->select('*')->where('id_jabatan',$jd->id_jabatan)->first();
        $tanggungJawab = DB::table('tanggung_jawab')->select('*')->where('jd_id',$jd->id)->get();        
        $hubKerjaInternal = DB::table('hubungan_kerja')->select('*')->where('jd_id',$jd->id)->where('hk_type','INTERNAL')->get();
        
        $hubKerjaExternal = DB::table('hubungan_kerja')->select('*')->where('jd_id',$jd->id)->where('hk_type','ExTERNAL')->get();
        $kewenangan = DB::table('kewenangan')->select('*')->where('jd_id',$jd->id)->get();
        $tantanganJabatan = DB::table('tantangan_jabatan')->select('*')->where('jd_id',$jd->id)->get();

        $sertifikasi = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','SERTIFIKASI')->get();
        $pelatihanWajib = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','PELATIHANWAJIB')->get();
        $pengetahuan = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','PENGETAHUAN')->get();
        $keahlian = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','KEAHLIAN')->get();
        $kompetensi = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','KOMPETENSI')->get();
        $satuan = DB::table('satuan')->select('*')->get();  
        $nonKeu = DB::table('non_keuangan')->select('*')->where('jd_id',$jd->id)->whereNotIn('deskripsi', ['Supervisor','TKO','Manager','Officer', 'Engineer'])->get();    
        $bawahan = DB::table('non_keuangan')->select('*')->where('jd_id',$jd->id)->whereIn('deskripsi', ['Supervisor','TKO','Manager','Officer', 'Engineer'])->get();   
        
        return view('admin.pengajuan',[
            'jd'                =>$jd,
            'detailJabatan'     =>$detailJabatan,
            'tgJawab'           =>$tanggungJawab,            
            'hubKerjaInternal'  =>$hubKerjaInternal,
            'hubKerjaExternal'  =>$hubKerjaExternal,
            'kewenangan'        =>$kewenangan,
            'tantanganJabatan'  =>$tantanganJabatan,
            'sertifikasi'       =>$sertifikasi,
            'pelatihanWajib'    =>$pelatihanWajib,
            'pengetahuan'        =>$pengetahuan,            
            'keahlian'          =>$keahlian,
            'kompetensi'        =>$kompetensi,
            'nonKeu'            =>$nonKeu,
            'satuan'            =>$satuan,
            'bawahan'           =>$bawahan,
        ]);            
    }

    public function pengajuanAct(Request $request){
        $validator = Validator::make($request->all(), [            
            'lokasiKerja'   => 'required',
            'tujuanJabatan' => 'required', 
            'tanggungJawab' => 'required|array', 'tanggungJawab.*' => 'required', 			
            'indikatorKinerja' => 'required|array','indikatorKinerja.*' => 'required',
            'capex' => 'required','opex' => 'required', 'target' => 'required',             
            'deskripsi' => 'required|array','deskripsi.*' => 'required',
            'jumlah' => 'required|array', 'jumlah.*' => 'required',
            'satuan' => 'required|array', 'satuan.*' => 'required',
            'internal' => 'required|array', 'internal.*' => 'required',
            'tujuanInternal' => 'required|array', 'tujuanInternal.*' => 'required',
            'external' => 'required|array', 'external.*' => 'required',
            'tujuanExternal' => 'required|array', 'tujuanExternal.*' => 'required',
            'kewenangan'=> 'required|array','kewenangan.*'=> 'required',
            'tantanganJabatan'=> 'required|array','tantanganJabatan.*'=> 'required',
            'pendidikan' => 'required', 			
            'pengalaman' => 'required',
            'sertifikasi'=> 'required|array','sertifikasi.*'=> 'required',
            'pelatihan'=> 'required|array','pelatihan.*'=> 'required',
            'pengetahuan'=> 'required|array','pengetahuan.*'=> 'required',
            'keahlian'=> 'required|array','keahlian.*'=> 'required',
            'kompetensi'=> 'required|array','kompetensi.*'=> 'required',
        ]);
        if ($validator->passes()) {

            $user =  DB::table('job_description')->where('id',$request->hIdJd)->update([
                'id_jabatan'                  => $request->idJabatan,
                'nama_jabatan'                => $request->namaJabatan,                    
                'tujuan_jabatan'              => $request->tujuanJabatan,
                'pendidikan'                  => $request->pendidikan,
                'pengalaman'                  => $request->pengalaman,
                'anggaran_capex'              => str_replace(".","",$request->capex),
                'anggaran_opex'               => str_replace(".","",$request->opex),
                'target_pendapatan'           => str_replace(".","",$request->target),
                'jumlah_officer'              => '0',
                'jumlah_engineer'             => '0',
                'jumlah_tko'                  => '0',
                'status'                      => 'PENGAJUAN',
                'nama_pic'                    => Session::get('name'),
                'submission_name'             => $request->session()->get('name'),
                'tanggal_pengajuan'           => Carbon\Carbon::now(),
                'lokasi_kerja'                => $request->lokasiKerja,
                ]);

            
            //Tantangan Jabatan
            if(isset($request->tantanganJabatan)){
                for($i=0; $i<count($request->tantanganJabatan); $i++){
                    if(isset($request->hIdTantanganJabatan[$i])){
                        $id = $request->hIdTantanganJabatan[$i];
                    }else {
                        $db = DB::table('tantangan_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    DB::table('tantangan_jabatan')->updateOrInsert(
                        [   'id'      => $id ],
                        [                
                            'name'    => $request->tantanganJabatan[$i],
                            'jd_id'   => $request->hIdJd
                    ]);
                }
            }
            
            //Tanggung Jawab Utama
            if(isset($request->tanggungJawab)){
                for($i=0; $i<count($request->tanggungJawab); $i++){
                    if(isset($request->hIdTanggungJawab[$i])){
                        $id = $request->hIdTanggungJawab[$i];
                    }else {
                        $db = DB::table('tanggung_jawab')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    $tanggungJawab = DB::table('tanggung_jawab')->updateOrInsert(
                        ['id' => $id ],
                        [
                            'indikator_kinerja' => $request->indikatorKinerja[$i],
                            'tj_utama'        => $request->tanggungJawab[$i],
                            'jd_id'           => $request->hIdJd
                        ]
                    );
                }        
            }
            
            //Hubungan Kerja Internal     
            if(isset($request->internal)){   
                for($i=0; $i<count($request->internal); $i++){
                    if(isset($request->hIdInternal[$i])){
                        $id = $request->hIdInternal[$i];
                    }else {
                        $db = DB::table('hubungan_kerja')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    DB::table('hubungan_kerja')->updateOrInsert(
                        ['id' => $id ],
                        [
                            'hk'      => $request->internal[$i],
                            'tujuan'  => $request->tujuanInternal[$i],
                            'jd_id'   => $request->hIdJd,
                            'hk_type' => 'INTERNAL'
                        ]
                    );
                }
            }

            // Hubungan Kerja External
            if(isset($request->external)){
                for($i=0; $i<count($request->external); $i++){
                    if(isset($request->hIdExternal[$i])){
                        $id = $request->hIdExternal[$i];
                    }else {
                        $db = DB::table('hubungan_kerja')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    DB::table('hubungan_kerja')->updateOrInsert(
                        ['id' => $id ],
                        [
                            'hk'      => $request->external[$i],
                            'tujuan'  => $request->tujuanExternal[$i],
                            'jd_id'   => $request->hIdJd,
                            'hk_type' => 'EXTERNAL'
                        ]
                    );
                }
            }

            //Kewenangan
            if(isset($request->kewenangan)){
                for($i=0; $i<count($request->kewenangan); $i++){
                    if(isset($request->hIdKewenangan[$i])){
                        $id = $request->hIdKewenangan[$i];
                    }else {
                        $db = DB::table('kewenangan')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    
                    DB::table('kewenangan')->updateOrInsert(
                        ['id' => $id ],
                        [                
                            'name'    => $request->kewenangan[$i],
                            'jd_id'   => $request->hIdJd
                        ]
                    );
                }
            }            

            //Spesifikasi Jabatan        
            // --Sertifikasi
            if(isset($request->sertifikasi)){
                for($i=0; $i<count($request->sertifikasi); $i++){
                    if(isset($request->hIdSertifikasi[$i])){
                        $id = $request->hIdSertifikasi[$i];
                    }else {
                        $db = DB::table('spesifikasi_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    DB::table('spesifikasi_jabatan')->updateOrInsert(
                        [   'id'      => $id ],
                        [                
                            'name'      => $request->sertifikasi[$i],
                            'jd_id'     => $request->hIdJd,
                            'spek_type' => 'SERTIFIKASI'              
                    ]);
                }
            }

            // --Pelatihan  Wajib
            if(isset($request->pelatihan)){
                for($i=0; $i<count($request->pelatihan); $i++){
                    if(isset($request->hIdPelatihan[$i])){
                        $id = $request->hIdPelatihan[$i];
                    }else {
                        $db = DB::table('spesifikasi_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }

                    DB::table('spesifikasi_jabatan')->updateOrInsert(
                        
                        [   'id'      => $id ],
                        [                
                            'name'    => $request->pelatihan[$i],
                            'jd_id'   => $request->hIdJd,
                            'spek_type' => 'PELATIHANWAJIB'                
                    ]);
                }
            }

            // --Pengetahuan
            if(isset($request->pengetahuan)){
                for($i=0; $i<count($request->pengetahuan); $i++){
                    if(isset($request->hIdPengetahuan[$i])){
                        $id = $request->hIdPengetahuan[$i];
                    }else {
                        $db = DB::table('spesifikasi_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    DB::table('spesifikasi_jabatan')->updateOrInsert(
                        [ 'id'      => $id ],
                        [                
                        'name'    => $request->pengetahuan[$i],
                        'jd_id'   => $request->hIdJd,
                        'spek_type' => 'PENGETAHUAN'                
                    ]);
                }
            }
            // --Keahlian
            if(isset($request->keahlian)){
                for($i=0; $i<count($request->keahlian); $i++){
                    if(isset($request->hIdKeahlian[$i])){
                        $id = $request->hIdKeahlian[$i];
                    }else {
                        $db = DB::table('spesifikasi_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }
                    
                    DB::table('spesifikasi_jabatan')->updateOrInsert(
                        [   'id'      => $id ],     
                        [                
                            'name'    => $request->keahlian[$i],
                            'jd_id'   => $request->hIdJd,
                            'spek_type' => 'KEAHLIAN'         
                    ]);
                }
            }

            // --Kompetensi
            if(isset($request->kompetensi)){
                for($i=0; $i<count($request->kompetensi); $i++){ 

                    if(isset($request->hIdKompetensi[$i])){
                        $id = $request->hIdKompetensi[$i];
                    }else {
                        $db = DB::table('spesifikasi_jabatan')->latest('id')->first();
                        $id = $db->id+1;
                    }                                
                    DB::table('spesifikasi_jabatan')->updateOrInsert(
                        [   'id'      => $id ],                    
                        [                
                            'name'    => $request->kompetensi[$i],
                            'jd_id'   => $request->hIdJd,
                            'spek_type' => 'KOMPETENSI'                
                    ]);
                }
            }

            // --Non Keuangan
            if(isset($request->deskripsi)){
                for($i=0; $i<count($request->deskripsi); $i++){ 
                    if(isset($request->hIdNonKeu[$i])){
                        $id = $request->hIdNonKeu[$i];
                    }else {
                        $db = DB::table('non_keuangan')->latest('id')->first();
                        $id = $db->id+1;
                    }                                
                    DB::table('non_keuangan')->updateOrInsert(
                        [   'id'      => $id ],                    
                        [                
                            'deskripsi' => $request->deskripsi[$i],
                            'jumlah'    => $request->jumlah[$i],
                            'satuan'    => $request->satuan[$i],                            
                            'jd_id'     => $request->hIdJd                                         
                    ]);
                }
            }

            // --Bawahan
            if(isset($request->jumlahBawahan)){
                for($i=0; $i<count($request->jumlahBawahan); $i++){ 
                    if($request->jenisBawahan[$i] != "Pilih Jenjang"){
                        if(isset($request->hIdBawahan[$i])){
                            $id = $request->hIdBawahan[$i];
                        }else {
                            $db = DB::table('non_keuangan')->latest('id')->first();
                            $id = $db->id+1;
                        }                                
                        DB::table('non_keuangan')->updateOrInsert(
                            [   'id'      => $id ],                    
                            [                
                                'deskripsi' => $request->jenisBawahan[$i],
                                'jumlah'    => $request->jumlahBawahan[$i],
                                'satuan'    => 'Orang',                            
                                'jd_id'     => $request->hIdJd                                         
                        ]);                            
                    }    
                }
            }
            return response()->json(["status"=>"success"]);              
        }
        return response()->json(["status"=>"error", 'msg'=>$validator->errors()->all()]);
    }

    public function deleteKeahlian($id){
        $result = DB::table('spesifikasi_jabatan')->where('id',$id)->delete();
        return response()->json(['status'=>$result]);
    }
    
    public function deleteTantangan($id){
        $result = DB::table('tantangan_jabatan')->where('id',$id)->delete();
        return response()->json(['status'=>$result]);
    }

    public function deleteKewenangan($id){
        $result = DB::table('kewenangan')->where('id',$id)->delete();
        return response()->json(['status'=>$result]);
    }

    public function deleteTanggungJawab($id){
        $result = DB::table('tanggung_jawab')->where('id',$id)->delete();
        return response()->json(['status'=>$result]);
    }

    public function deleteHubunganKerja($id){
        $result = DB::table('hubungan_kerja')->where('id',$id)->delete();
        return response()->json(['status'=>$result]);
    }
    
    public function deleteDeskripsi($id){
        $result = DB::table('non_keuangan')->where('id',$id)->delete();
        return response()->json(['status'=>$result]);
    }
    
    public function deleteBawahan($id){
        $result = DB::table('non_keuangan')->where('id',$id)->delete();
        return response()->json(['status'=>$result]);
    }
    

}