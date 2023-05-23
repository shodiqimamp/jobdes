<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon;
use Illuminate\Support\Facades\Session;
use PDF;

class EmployeController extends Controller
{    
    public function submission(){
        $jd = DB::table('job_description')->select('*')->where('nama_jabatan',Session::get('jabatan'))->first();
        if($jd){
            if($jd->submission_name == Session::get('name') ){
                $detailJabatan = DB::table('employee')->select('*')->where('email',Session::get('email'))->first();
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
                
                return view('admin.submission',[
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
                    'kompetensi'        =>$kompetensi
                ]);

            }else {
                return view('admin.submissiondisable');
            }            
        } else {
            return view('admin.submissiondisable');
        }                       
    }

    public function submissionAct(Request $request){
        $user =  DB::table('job_description')->where('id',$request->hIdJd)->update([
                                    
            'tujuan_jabatan'              => $request->tujuanJabatan,
            'pendidikan'                  => $request->pendidikan,
            'pengalaman'                  => $request->pengalaman,
            'anggaran_capex'              => str_replace(".","",$request->capex),
            'anggaran_opex'               => str_replace(".","",$request->opex),
            'jumlah_officer'              => $request->officer,
            'jumlah_engineer'             => $request->engineer,
            'jumlah_tko'                  => $request->tko,
            'jumlah_product_digital'      => $request->pdSumbangan,
            'jumlah_prototype'            => $request->pdPrototype,
            'jumlah_kegiatan_tfknowledge' => $request->transKnowledge,
            'jumlah_portofolio'           => $request->pdPortofolio,
            'katalog_harga'               => 'Katalog',
            'status'                      => 'PENGAJUAN',
            'submission_name'             => $request->session()->get('name'),
            'tanggal_pengajuan'           => Carbon\Carbon::now()
            
            ]);

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

        return response()->json($request->all());
    }

    public function allUser(){
        $dir = DB::table('jabatan')->select('direktorat')->groupBy('direktorat')->get();
        return view("admin.viewall2",['dir'=>$dir]);
    }

    public function hirarki(){       
        $dir = DB::table('jabatan')->select('direktorat')->groupBy('direktorat')->get();  
        $data = [];
        foreach($dir as $dirNew){
            array_push($data, array('id'=>$dirNew->direktorat, 'parent'=>'#', 'text'=>$dirNew->direktorat));
            $div = DB::table('jabatan')->select('divisi')->where('direktorat',$dirNew->direktorat)->groupBy('divisi')->get();     
            foreach($div as $divNew){
                array_push($data, array('id'=>$divNew->divisi, 'parent'=>$dirNew->direktorat, 'text'=>$divNew->divisi));
                $bidang = DB::table('jabatan')->select('bidang')->where([
                    ['direktorat','=',$dirNew->direktorat],
                    ['divisi','=',$divNew->divisi]                    
                ])->groupBy('bidang')->get();  
                foreach($bidang as $bid){
                    array_push($data, array('id'=>$bid->bidang, 'parent'=>$divNew->divisi, 'text'=>$bid->bidang));                    
                    $subBidang = DB::table('jabatan')->select('sub_bidang')->where([
                        ['direktorat','=',$dirNew->direktorat],
                        ['divisi','=',$divNew->divisi],
                        ['bidang','=', $bid->bidang]            
                    ])->groupBy('sub_bidang')->get();  
                    // foreach($subBidang as $subBid){
                    //     array_push($data, array('id'=>$subBid->sub_bidang, 'parent'=>$bid->bidang, 'text'=>$subBid->sub_bidang));
                    // }
                }
            }
        }
        
        return response()->json($data);
    }

    public function viewPdf($id){        
        $jd = DB::table('job_description')->select('*',DB::raw('DATE_FORMAT(tanggal_disetujui, "%Y-%m-%d") as tanggal_disetujui'))->where('id',$id)->where('status', '=', 'DISETUJUI')->first();
        if($jd){
            $detailJabatan = DB::table('jabatan')->select('*')->where('id_jabatan',$jd->id_jabatan)->first();
            $jabatanPic = DB::table('jabatan')->select('nama_jabatan')->where('id_jabatan',$jd->id_jabatan_pic)->first();

            $jabatanApproval = DB::table('jabatan')->select('nama_jabatan')->where('id_jabatan',$jd->id_jabatan_approve)->first();

            $jabatanReviewer = DB::table('jabatan')->select('nama_jabatan')->where('id_jabatan',$jd->id_jabatan_reviewer)->first();

            $tanggungJawab = DB::table('tanggung_jawab')->select('*')->where('jd_id',$jd->id)->get();
            $sizeTj = DB::table('tanggung_jawab')->select(DB::raw('count(*) as row_span'),'tj_utama')->where('jd_id',$jd->id)->GroupBy('tj_utama')->get();

            $hubKerjaInternal = DB::table('hubungan_kerja')->select('*')->where('jd_id',$jd->id)->where('hk_type','INTERNAL')->OrderBy('hk')->get();
            
            $hubKerjaExternal = DB::table('hubungan_kerja')->select('*')->where('jd_id',$jd->id)->where('hk_type','EXTERNAL')->get();
            $sizeInternal = DB::table('hubungan_kerja')->select(DB::raw('count(*) as row_span'),'hk')->where('jd_id',$jd->id)->where('hk_type','INTERNAL')->GroupBy('hk')->get();
            $sizeExternal = DB::table('hubungan_kerja')->select(DB::raw('count(*) as row_span'),'hk')->where('jd_id',$jd->id)->where('hk_type','EXTERNAL')->GroupBy('hk')->get();

            $kewenangan = DB::table('kewenangan')->select('*')->where('jd_id',$jd->id)->get();
            $tantanganJabatan = DB::table('tantangan_jabatan')->select('*')->where('jd_id',$jd->id)->get();

            $sertifikasi = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','SERTIFIKASI')->get();
            $pelatihanWajib = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','PELATIHANWAJIB')->get();
            $pengetahuan = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','PENGETAHUAN')->get();
            $keahlian = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','KEAHLIAN')->get();
            $kompetensi = DB::table('spesifikasi_jabatan')->select('*')->where('jd_id',$jd->id)->where('spek_type','KOMPETENSI')->get();        
            $nonKeu = DB::table('non_keuangan')->select('*')->where('jd_id',$jd->id)->whereNotIn('deskripsi', ['Supervisor','TKO','Manager','Officer', 'Engineer'])->get();        
            $bawahan = DB::table('non_keuangan')->select('*')->where('jd_id',$jd->id)->whereIn('deskripsi', ['Supervisor','TKO','Manager','Officer', 'Engineer'])->get(); 
            

            PDF::SetTitle($jd->nama_jabatan);
            PDF::setHeaderCallback(function($pdf) {                    
                $pdf->SetY(1);
                $pdf->SetX('2');                
                $pdf->SetFont('helvetica', '', 9);
                $pdf->WriteHTML(view('admin.global.headerpdf')->render(), true, false, true, false, ''); 
            });      
            // PDF::SetHeaderMargin('2','2','2','2');        
            PDF::SetFont('helvetica', '', 9);  
            PDF::SetMargins(9, 18, 9, 9);
            //FirstPage
            // PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            // PDF::SetHeaderMargin(PDF_MARGIN_HEADER);
            PDF::AddPage('P','F4');       
            PDF::writeHTML(view('admin.global.pdf1',[
                'jd'                =>$jd,
                'detailJabatan'     =>$detailJabatan,
                'tgJawab'           =>$tanggungJawab,    
                'spanTj'            =>$sizeTj,        
                'hubKerjaInternal'  =>$hubKerjaInternal,
                'hubKerjaExternal'  =>$hubKerjaExternal,
                'kewenangan'        =>$kewenangan,
                'tantanganJabatan'  =>$tantanganJabatan,
                'sertifikasi'       =>$sertifikasi,
                'pelatihanWajib'    =>$pelatihanWajib,
                'pengetahuan'       =>$pengetahuan,            
                'keahlian'          =>$keahlian,
                'kompetensi'        =>$kompetensi,
                'nonKeu'            =>$nonKeu,
                'jabatanPic'        =>$jabatanPic,
                'jabatanApproval'   =>$jabatanApproval,
                'jabatanReviewer'   =>$jabatanReviewer,
                'spanInternal'      =>$sizeInternal,
                'spanExternal'      =>$sizeExternal,  
                'bawahan'           =>$bawahan,
            ])->render(), true, false, true, false, '');

            //Second Page
            // PDF::AddPage('P','F4');
            // // PDF::SetMargins(PDF_MARGIN_LEFT, 75, PDF_MARGIN_RIGHT);
            // PDF::writeHTML(view('admin.global.pdf2',[
            //     'jd'                =>$jd,
            //     'detailJabatan'     =>$detailJabatan,
            //     'tgJawab'           =>$tanggungJawab,            
            //     'hubKerjaInternal'  =>$hubKerjaInternal,
            //     'spanInternal'      =>$sizeInternal,
            //     'spanExternal'      =>$sizeExternal,          
            //     'hubKerjaExternal'  =>$hubKerjaExternal,
            //     'kewenangan'        =>$kewenangan,
            //     'tantanganJabatan'  =>$tantanganJabatan,
            //     'sertifikasi'       =>$sertifikasi,
            //     'pelatihanWajib'    =>$pelatihanWajib,
            //     'pengetahuan'        =>$pengetahuan,            
            //     'keahlian'          =>$keahlian,
            //     'kompetensi'        =>$kompetensi,
            //     'nonKeu'            =>$nonKeu,                
            // ])->render(), true, false, true, false, '');

            PDF::Output($jd->nama_jabatan.'.pdf');
            TCPDF::SetCreator(PDF_CREATOR);
            TCPDF::SetAuthor('jobdescapp');
            TCPDF::SetTitle('Nama Jabatan');
            TCPDF::SetSubject('Job Description');
        } else {
            return response()->json(["status"=> "error", "msg"=>"job desc not found"]);
        }
    }

    public function saveSatuan(Request $request){
        $satuan = DB::table('satuan')->insert([            
            'name'           => $request->satuan
        ]);   
        $satuan = DB::table('satuan')->select('*')->get();       
        return response()->json(["status"=>"success","data"=> $satuan]);
    }
    
    public function getSatuan(){
        $satuan = DB::table('satuan')->select('*')->orderBy('name')->get();
        return response()->json(["status"=>"success","data"=> $satuan]);
    }

    public function getDataJobDesc($id){
        $year = date('Y');
        $jd = DB::table('job_description')->select('*')->where('id_jabatan',$id)->whereYear('created_at', '=', $year)->where('status', '=', 'DISETUJUI')->first();
        if($jd){
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

            return response()->json([
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
                "status"            =>"success",
                'bawahan'           =>$bawahan,
            ]);

        }else {
            return response()->json(["status"=>"error"]);
        }

    }
}