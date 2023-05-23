<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
Use DB;
class ChainListController extends Controller
{      

    public function getDirektorat(){        
        $dir = DB::table('jabatan')->select('direktorat')->groupBy('direktorat')->get();     
        return response()->json(['direktorat',$dir]);
    }

    public function getDivisi($direktorat){        
        $div = DB::table('jabatan')->select('divisi')->where('direktorat',$direktorat)->groupBy('divisi')->get();     
        return response()->json(["status" => "success", 'data' => $div]);
    }

    public function getBidang($direktorat,$divisi){        
        $div = DB::table('jabatan')->select('bidang')->where([
            ['direktorat','=',$direktorat],
            ['divisi','=',$divisi]
            
        ])->groupBy('bidang')->get();     
        return response()->json(["status" => "success","data"=>$div]);
    }

    public function getSubbidang($direktorat,$divisi, $bidang){        
        $div = DB::table('jabatan')->select('sub_bidang')->where([
            ['direktorat','=',$direktorat],
            ['divisi','=',$divisi],
            ['bidang','=', $bidang]            
        ])->groupBy('sub_bidang')->get();     
        return response()->json(["status" => "success","data"=>$div]);
    }


    public function getJabatan($direktorat,$divisi, $bidang, $subBidang){        
        $div = DB::table('jabatan')->select('nama_jabatan')->where([
            ['direktorat','=',$direktorat],
            ['divisi','=',$divisi],
            ['bidang','=', $bidang],
            ['sub_bidang','=', $subBidang]            
        ])->get();     
        return response()->json(["status" => "success","data"=>$div]);
    }

    public function getKetJabatan($direktorat,$divisi, $bidang, $subBidang, $jabatan){        
        $div = DB::table('jabatan')->select('*')->where([
            ['direktorat','=',$direktorat],
            ['divisi','=',$divisi],
            ['bidang','=', $bidang],
            ['sub_bidang','=', $subBidang],
            ['nama_jabatan','=', $jabatan]            
        ])->get();     
        return response()->json(["status" => "success","data"=>$div]);
    }

    public function getStructure($id){        
        $user = DB::table('pegawai')->select('*')->where([
                    ['id','=',$id]               
                ])->first();     
        if($user->id_jabatan != ""){
            $jb = DB::table('jabatan')->select('*')->where([
                ['id_jabatan','=',$user->id_jabatan]               
            ])->get();     
            return response()->json(["status" => "success","data"=>$jb]);
        } else {
            return response()->json(["status" => "notfound"]);
        }
        
    }

    

    
}