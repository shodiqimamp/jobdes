<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){        
        return view('admin.login');
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        if (!str_contains($email, '@iconpln.co.id')) { 
            $email = $email.'@iconpln.co.id';
        }
        $users = DB::table('users')->select('*')->where('email',$email)->where('status','1')->first();
        if($users){
                $pegawai = DB::table('pegawai')->select('*')->where('email',$email)->first();
                if($pegawai->id_jabatan != ""){
                    $jabatan = DB::table('jabatan')->select('*')->where('id_jabatan',$pegawai->id_jabatan)->first();
                    Session::put('position',$jabatan->jenjang_jabatan);
                    Session::put('id_jabatan',$jabatan->id_jabatan); 
                } else {
                    Session::put('position','Fungsional');
                    Session::put('id_jabatan',""); 
                }                

                
                Session::put('name',$users->name);
                Session::put('email',$email);        
                Session::put('role',$users->role);                 
                Session::put('login',TRUE);
                return redirect('/'); 
          
        } else {
            return redirect('login')->with(['alert'=>'Email anda belum terdaftar']);            
        }        
        
    }

    public function logout()
    {
        Session::flush();        
        return redirect('/login');
    }

    public function getSatuan(){
        
    }
    
}