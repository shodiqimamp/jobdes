<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
Use DB;
use Carbon;
use Illuminate\Support\Facades\Session;
class ReviewController extends Controller
{      

    public function index(){        
        return view('admin.review');
    }

    public function jdList($year){        
        if(Session::get('role') == 'SUPER ADMIN'){
            $data = DB::table('job_description')->select('id','submission_name','nama_jabatan',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as tanggal_pengajuan'),'status')->whereYear('created_at', '=', $year)->where('status', '=', 'REVIEW')->orWhere('status', '=', 'DISETUJUI')->get();
        } else {
            $data = DB::table('job_description')->select('id','submission_name','nama_jabatan',DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as tanggal_pengajuan'),'status')->whereYear('created_at', '=', $year)->where('id_jabatan_reviewer','=',Session::get('id_jabatan'))->where('status', '=', 'REVIEW')->orWhere('status', '=', 'DISETUJUI')->get();
        }
        
        
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){                            
                if($row->status=="REVIEW"){
                    $sts = '<a href="review/'.$row->id.'"><span class="badge badge-danger">Review</span></a>';
                }else if($row->status=="DISETUJUI") {
                    $sts = '<a href="view/'.$row->id.'"><span class="badge badge-success">Disetujui</span></a><a href="view-pdf/'.$row->id.'" target="_blank"><span class="badge badge-primary ml-2">PDF</span></a>';
                }                 
            return $sts;
        }) 
        ->rawColumns(['action','status'])->make(true);        
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
        
        $draft = DB::table('draft')->select('*')->where('id_jobdesc',$jd->id)->first();
        
        return view('admin.reviewdetail',[
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
            'draft'             =>$draft,  
            'bawahan'           =>$bawahan,          
        ]);            
    }

    public function approvalAct(Request $request){        
        $jd = DB::table('job_description')->select('id_jabatan_reviewer')->where('id',$request->hIdJd)->first();     
        $namaReviewer = DB::table('pegawai')->select('nama_pegawai')->where('id_jabatan',$jd->id_jabatan_reviewer)->first();     
        $user =  DB::table('job_description')->where('id',$request->hIdJd)->update([            
            'status'                      => $request->approval,                    
            'tanggal_proses'              => Carbon\Carbon::now(),
            'tanggal_disetujui'           => Carbon\Carbon::now(),
            'feedback_admin'              => $request->revisi,                    
            'nama_reviewer'               => $namaReviewer->nama_pegawai,
            ]);                                    
        return response()->json(["status"=>"success"]);                              
    }
      
}