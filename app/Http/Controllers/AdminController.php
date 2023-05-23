<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
Use DB;
class AdminController extends Controller
{      

    public function index(){        
        $year = date('Y');
        $totalJobdesc = DB::table('job_description')->select(DB::raw('count(*) as total'))->whereYear('created_at', '=', $year)->get();
        $selesai = DB::table('job_description')->select(DB::raw('count(*) as total'))->whereYear('created_at', '=', $year)->where('status','=','DISETUJUI')->get();
        $pengajuan = DB::table('job_description')->select(DB::raw('count(*) as total'))->whereYear('created_at', '=', $year)->whereIn('status',['PENGAJUAN','DITOLAK','REJECTED'])->get();
        $review = DB::table('job_description')->select(DB::raw('count(*) as total'))->whereYear('created_at', '=', $year)->where('status','=','REVIEW')->get();
        $unprocess = DB::table('job_description')->select(DB::raw('count(*) as total'))->whereYear('created_at', '=', $year)->where('status','=','NEW')->get();

        $perDone =  $selesai[0]->total == 0 ? '0,0' : number_format($selesai[0]->total/$totalJobdesc[0]->total*100,1,",",".");
        $perPengajuan =  $pengajuan[0]->total == 0 ? '0,0' : number_format($pengajuan[0]->total/$totalJobdesc[0]->total*100,1,",",".");
        $perUnproces =  $unprocess[0]->total == '0,0' ? 0 : number_format($unprocess[0]->total/$totalJobdesc[0]->total*100,1,",",".");
        $perReview =  $review[0]->total == 0 ? '0,0' : number_format($review[0]->total/$totalJobdesc[0]->total*100,1,",",".");


        return view('admin.dashboard', [
            'totalJobdesc'  =>$totalJobdesc,
            'selesai'       =>$selesai,
            'pengajuan'     =>$pengajuan,
            'unproces'      =>$unprocess,
            'review'        =>$review,
            'perDone'       =>$perDone,
            'perPengajuan'  =>$perPengajuan,
            'perUnproces'   =>$perUnproces,
            'perReview'     =>$perReview,

        ]);
    }

    public function inputJd(){   
        $satuan = DB::table('satuan')->select('*')->orderBy('name')->get();  
        $dir = DB::table('jabatan')->select('direktorat')->groupBy('direktorat')->get();   
        return view('admin.inputjd',['dir'=>$dir,'satuan'=>$satuan]);        
    }

    public function addJobDesc(Request $request){
        $validator = Validator::make($request->all(), [
            'lokasiKerja' => 'required', 
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
            $year = date('Y');
            if(DB::table('job_description')->where('id_jabatan','=', $request->idJabatan)->whereYear('created_at', '=', $year)->count() > 0){
                return response()->json(["status"=>"exist", 'msg'=>"Job desc telah ada"]);
            }

            $jabatan  = DB::table('jabatan')->select('*')->where('id_jabatan', '=', $request->idJabatan)->first();

            if($jabatan->jenjang_jabatan == 'Struktural'){
                $approvementDb = DB::table('jabatan')->select('*')->where([                    
                    ['nama_jabatan','=', $request->atasanLangsung]   
                ])->first();  

                $pgwai = DB::table('pegawai')->select('*')->where([                    
                    ['id_jabatan','=', $approvementDb->id_jabatan]   
                ])->first(); 

                if(str_contains($jabatan->nama_jabatan, 'Supervisor')){
                    $idJabatanReviewer = '6.4.1';    

                    if($pgwai){
                        $approvement = $approvementDb->id_jabatan;
                    } else {
                        //PV
                        $approvementDb = DB::table('jabatan')->select('id_jabatan')->where([                    
                            ['nama_jabatan','=', $approvementDb->atasan_langsung]   
                        ])->first();                                  
                        $approvement = $approvementDb->id_jabatan;        
                    }


                } elseif(str_contains($jabatan->nama_jabatan, 'Manager')) {                    
                    $idJabatanReviewer = '6.4';
                    if($pgwai->count() > 0){
                        $approvement = $approvementDb->id_jabatan;
                    } else {
                        //Direksi
                        $approvementDb = DB::table('jabatan')->select('id_jabatan')->where([                    
                            ['nama_jabatan','=', $approvementDb->atasanLangsung]   
                        ])->first();                                  
                        $approvement = $approvementDb->id_jabatan;        
                    }
                }elseif(str_contains($jabatan->nama_jabatan, 'Vice Presindent') || str_contains($jabatan->nama_jabatan, 'Kepala Satuan') || str_contains($jabatan->nama_jabatan, 'Corporate Secretary')){

                    $idJabatanReviewer = '6';
                    $approvement = $approvementDb->id_jabatan;        
                }
                
                $pic = $request->idJabatan;            
                
            }else {                

                $idJabatanReviewer = '6.4.1';

                //SPV
                $picDb = DB::table('jabatan')->select('*')->where([                    
                    ['nama_jabatan','=', $request->atasanLangsung]   
                ])->first();   

                $pgwai = DB::table('pegawai')->select('*')->where([                    
                    ['id_jabatan','=', $picDb->id_jabatan]   
                ])->first(); 

                if($pgwai){
                    $approvement = $picDb->id_jabatan;
                    $pic = $picDb->id_jabatan;
                } else {

                    //Manager
                    $picDb = DB::table('jabatan')->select('*')->where([                    
                        ['nama_jabatan','=', $picDb->atasan_langsung]   
                    ])->first(); 
                    $pgwai = DB::table('pegawai')->select('*')->where([                    
                        ['id_jabatan','=', $picDb->id_jabatan]   
                    ])->first(); 
                                        
                    if($pgwai){
                        $approvement = $picDb->id_jabatan;
                        $pic = $picDb->id_jabatan;
                    } else {
                        
                        //SPV
                        $picDb = DB::table('jabatan')->select('*')->where([                    
                            ['nama_jabatan','=', $picDb->atasan_langsung]   
                        ])->first(); 
                                                
                        $approvement = $picDb->id_jabatan;
                        $pic = $picDb->id_jabatan;
                       
                    }
                }                
            }            
			
            $jd = DB::table('job_description')->insertGetId([             
                'id_jabatan'                  => $request->idJabatan,
                'id_jabatan_approve'          => $approvement,
                'id_jabatan_pic'              => $pic,
                'id_jabatan_reviewer'         => $idJabatanReviewer,
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
                'status'                      => 'NEW',
                'lokasi_kerja'                => $request->lokasiKerja,     
            ]);

            //Tanggung Jawab Utama
            for($i=0; $i<count($request->tanggungJawab); $i++){
                $tanggungJawab = DB::table('tanggung_jawab')->insert([
                    'indikator_kinerja' => $request->indikatorKinerja[$i],
                    'tj_utama'        => $request->tanggungJawab[$i],
                    'jd_id'           => $jd
                ]);
            }        

            //Hubungan Kerja Internal
            for($i=0; $i<count($request->internal); $i++){
                DB::table('hubungan_kerja')->insert([
                    'hk'      => $request->internal[$i],
                    'tujuan'  => $request->tujuanInternal[$i],
                    'jd_id'   => $jd,
                    'hk_type' => 'INTERNAL'
                ]);
            }

            //Hubungan Kerja External
            for($i=0; $i<count($request->external); $i++){
                DB::table('hubungan_kerja')->insert([
                    'hk'      => $request->external[$i],
                    'tujuan'  => $request->tujuanExternal[$i],
                    'jd_id'   => $jd,
                    'hk_type' => 'EXTERNAL'
                ]);
            }

            //Kewenangan
            for($i=0; $i<count($request->kewenangan); $i++){
                DB::table('kewenangan')->insert([                
                    'name'    => $request->kewenangan[$i],
                    'jd_id'   => $jd                
                ]);
            }

            //Tantangan Jabatan
            for($i=0; $i<count($request->tantanganJabatan); $i++){
                DB::table('tantangan_jabatan')->insert([                
                    'name'    => $request->tantanganJabatan[$i],
                    'jd_id'   => $jd                
                ]);
            }

            //Spesifikasi Jabatan        
            // --Sertifikasi
            for($i=0; $i<count($request->sertifikasi); $i++){
                DB::table('spesifikasi_jabatan')->insert([                
                    'name'      => $request->sertifikasi[$i],
                    'jd_id'     => $jd,
                    'spek_type' => 'SERTIFIKASI'              
                ]);
            }

            // --Pelatihan  Wajib
            for($i=0; $i<count($request->pelatihan); $i++){
                DB::table('spesifikasi_jabatan')->insert([                
                    'name'    => $request->pelatihan[$i],
                    'jd_id'   => $jd,
                    'spek_type' => 'PELATIHANWAJIB'                
                ]);
            }

            // --Pengetahuan
            for($i=0; $i<count($request->pengetahuan); $i++){
                DB::table('spesifikasi_jabatan')->insert([                
                    'name'    => $request->pengetahuan[$i],
                    'jd_id'   => $jd,
                    'spek_type' => 'PENGETAHUAN'
                ]);
            }

            // --Keahlian
            for($i=0; $i<count($request->keahlian); $i++){
                DB::table('spesifikasi_jabatan')->insert([                
                    'name'    => $request->keahlian[$i],
                    'jd_id'   => $jd,
                    'spek_type' => 'KEAHLIAN'         
                ]);
            }

            // --Kompetensi
            for($i=0; $i<count($request->kompetensi); $i++){
                DB::table('spesifikasi_jabatan')->insert([                
                    'name'    => $request->kompetensi[$i],
                    'jd_id'   => $jd,
                    'spek_type' => 'KOMPETENSI' 
                ]);
            }      

            // --Non Keuangan
            for($i=0; $i<count($request->deskripsi); $i++){
                DB::table('non_keuangan')->insert([                
                    'deskripsi' => $request->deskripsi[$i],
                    'jumlah'    => $request->jumlah[$i],
                    'satuan'    => $request->satuan[$i],
                    'jd_id'   => $jd,                
                ]);
            }  

            // --Bawahan
            for($i=0; $i<count($request->jenisBawahan); $i++){
                if($request->jenisBawahan[$i] != "Pilih Jenjang"){
                    DB::table('non_keuangan')->insert([                
                        'deskripsi' => $request->jenisBawahan[$i],
                        'jumlah'    => $request->jumlahBawahan[$i],
                        'satuan'    => 'Orang',
                        'jd_id'     => $jd,                
                    ]);
                }
            }  

            $draft = DB::table('draft')->insert([             
                'id_jabatan'                  => $request->idJabatan,
                'id_jabatan_approve'          => $approvement,
                'id_jabatan_pic'              => $pic,
                'id_jabatan'                  => $request->idJabatan,
                'id_jobdesc'                  => $jd,
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
                'lokasi_kerja'                => $request->lokasiKerja,
                'tanggung_jawab'              => json_encode($request->tanggungJawab),  
                'indikator_kinerja'           => json_encode($request->indikatorKinerja), 
                'hubungan_kerja_internal'     => json_encode($request->internal),  
                'tujuan_kerja_internal'       => json_encode($request->tujuanInternal),    
                'hubungan_kerja_external'     => json_encode($request->external),  
                'tujuan_kerja_external'       => json_encode($request->tujuanExternal),
                'kewenangan'                  => json_encode($request->kewenangan),                  
                'tantangan_jabatan'           => json_encode($request->tantanganJabatan),
                'sertifikasi'                 => json_encode($request->sertifikasi),
                'pelatihan_wajib'             => json_encode($request->pelatihan),
                'pengetahuan'                 => json_encode($request->pengetahuan),
                'keahlian'                    => json_encode($request->keahlian),
                'kompetensi'                  => json_encode($request->kompetensi),
                'deskripsi'                   => json_encode($request->deskripsi),
                'jumlah'                      => json_encode($request->jumlah),
                'satuan'                      => json_encode($request->satuan),
                'bawahan'                     => json_encode($request->jenisBawahan),
                'jumlah_bawahan'              => json_encode($request->jumlahBawahan),
            ]);

            if($draft){
                return response()->json(["id_save"=> $jd,"status"=>"success"]);  
            } else {
                return response()->json(["id_save"=> $jd,"status"=>"error", "message"=>"draft no save success"]);  
            }

            
        }
            
        return response()->json(["status"=>"error", 'msg'=>$validator->errors()->all()]);     
        
    }

    public function jdList($year,$type){        

        if($type == 'all'){
            $data = DB::table('job_description')->select('id','submission_name','nama_jabatan',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as tanggal_pengajuan'),'status')->whereYear('created_at', '=', $year)->orderBy('status')->get();
        } else if($type == 'selesai') {
            $data = DB::table('job_description')->select('id','submission_name','nama_jabatan',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as tanggal_pengajuan'),'status')->whereYear('created_at', '=', $year)->where('status','=','DISETUJUI')->get();
        } else if($type == 'review') {
            $data = DB::table('job_description')->select('id','submission_name','nama_jabatan',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as tanggal_pengajuan'),'status')->whereYear('created_at', '=', $year)->where('status','=','REVIEW')->get();
        }else if($type == 'pengajuan') {
            $data = DB::table('job_description')->select('id','submission_name','nama_jabatan',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as tanggal_pengajuan'),'status')->whereYear('created_at', '=', $year)->whereIn('status',['PENGAJUAN','DITOLAK','REJECTED'])->get();
        }else if($type == 'unprocess') {
            $data = DB::table('job_description')->select('id','submission_name','nama_jabatan',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as tanggal_pengajuan'),'status')->whereYear('created_at', '=', $year)->where('status','=','NEW')->get();
        }
        
        
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){                            
                if($row->status=="PENGAJUAN"){
                    $sts = '<a href="view/'.$row->id.'"><span class="badge badge-danger">Pengajuan</span></a>';
                } else if($row->status=="REVIEW"){
                    $sts = '<a href="view/'.$row->id.'"><span class="badge badge-danger">Review</span></a>';
                }else if($row->status=="NEW") {
                    $sts = '<a href="view/'.$row->id.'"><span class="badge badge-warning">New</span></a>';
                }else if($row->status=="DISETUJUI") {
                    $sts = '<a href="view/'.$row->id.'"><span class="badge badge-success">Disetujui</span></a></a><a href="view-pdf/'.$row->id.'" target="_blank"><span class="badge badge-primary ml-2">PDF</span></a>';
                } else if($row->status=="DITOLAK" || $row->status=="REJECTED"){
                    $sts = '<a href="view/'.$row->id.'"><span class="badge badge-info">Ditolak</span></a>';
                }
                
            return $sts;
        }) 
        ->rawColumns(['action','status'])->make(true);        
    }

    public function grafik($year){

    }

    public function dashReport($year){
        $totalJobdesc = DB::table('job_description')->select(DB::raw('count(*) as total'))->whereYear('created_at', '=', $year)->get();
        $selesai = DB::table('job_description')->select(DB::raw('count(*) as total'))->whereYear('created_at', '=', $year)->where('status','=','DISETUJUI')->get();
        $pengajuan = DB::table('job_description')->select(DB::raw('count(*) as total'))->whereYear('created_at', '=', $year)->whereIn('status',['PENGAJUAN','DITOLAK','REJECTED'])->get();
        $review = DB::table('job_description')->select(DB::raw('count(*) as total'))->whereYear('created_at', '=', $year)->where('status','=','REVIEW')->get();
        $unprocess = DB::table('job_description')->select(DB::raw('count(*) as total'))->whereYear('created_at', '=', $year)->where('status','=','NEW')->get();
        
        
        $perDone =  $selesai[0]->total == 0 ? '0,0' : number_format($selesai[0]->total/$totalJobdesc[0]->total*100,1,",",".");
        $perPengajuan =  $pengajuan[0]->total == 0 ? '0,0' : number_format($pengajuan[0]->total/$totalJobdesc[0]->total*100,1,",",".");
        $perUnproces =  $unprocess[0]->total == 0 ? '0,0' : number_format($unprocess[0]->total/$totalJobdesc[0]->total*100,1,",",".");
        $perReview =  $review[0]->total == 0 ? '0,0' : number_format($review[0]->total/$totalJobdesc[0]->total*100,1,",",".");

        return response()->json([
            'totalJobdesc'  =>$totalJobdesc,
            'selesai'       =>$selesai,
            'pengajuan'     =>$pengajuan,
            'unproces'      =>$unprocess,
            'review'        =>$review,
            'perDone'       =>$perDone,
            'perPengajuan'  =>$perPengajuan,
            'perUnproces'   =>$perUnproces,
            'perReview'     =>$perReview,
            'status'        =>'success',
        ]);
    }

    public function manageUser(){   
        $pegawai = DB::table('pegawai')->select('*')->get();  
        $dir = DB::table('jabatan')->select('direktorat')->groupBy('direktorat')->get();        
        return view('admin.manageuser',[
            'pegawai'   =>$pegawai,
            'dir'       =>$dir,
        ]);
    }
        
    public function addUser(Request $request){        
        $validator = Validator::make(request()->all(), [            
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        if ($validator->fails()) {            
            return redirect('manageuser')->with(['alert'=>'Email Sudah Terdaftar', 'status'=>'failed']);
        }
        
        $user = new User();
        $user->name = $request->namaPegawai;
        $user->role =  $request->role;
        $user->email= $request->email;
        $user->status = true;
        $user->save();     
        return redirect('manageuser')->with(['alert'=>'User Berhasil Didaftarkan', 'status'=>'success']);
    }

    public function userList(){
        $users = DB::table('users')->select('*');
        return datatables()->of($users)
            ->addIndexColumn()
            ->addColumn('status', function($row){
               if($row->status){
                $sts = '<span class="badge badge-success">Active</span>';
               } else {
                $sts = '<span class="badge badge-danger">Inactive</span>';
               }
            
            return $sts;
        })
            ->addColumn('action', function($row){               
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-primary btn-sm editItem">Edit</a>';                                               
                return $btn;
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function findUser($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function editUser(Request $request){
        DB::table('users')->where('id',$request->idEdit)->update([
            'role'      => $request->editRole,
            'status'    => $request->editStatus
        ]);
        return redirect('manageuser')->with(['alert'=>'User Berhasil Diupdate', 'status'=>'success']);
    }

    public function mutasiPegawai(Request $request){
        DB::table('pegawai')->where('id',$request->namaPegawaiMutasi)->update([            
            'id_jabatan'    => $request->idJabatan,
            'nama_jabatan'  => $request->namaJabatan
        ]);
        
        return redirect('manageuser')->with(['alert'=>'Pegawai Berhasil Diupdate', 'status'=>'success']);
    }

    public function editJobDesc($id){    
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
        
        return view('admin.editjd',[
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

    public function editJobDescAct(Request $request){
        $validator = Validator::make($request->all(), [            
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

    public function viewJobDesc($id){
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
        $nonKeu = DB::table('non_keuangan')->select('*')->where('jd_id',$jd->id)->whereNotIn('deskripsi', ['Supervisor','TKO','Manager','Officer', 'Engineer'])->get();        
        $bawahan = DB::table('non_keuangan')->select('*')->where('jd_id',$jd->id)->whereIn('deskripsi', ['Supervisor','TKO','Manager','Officer', 'Engineer'])->get();        
        return view('admin.view',[
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
            'bawahan'           =>$bawahan,          
        ]);            
    }

   

}