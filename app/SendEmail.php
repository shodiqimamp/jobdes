<?php

namespace App;
use Mail;
use DB;
Class SendEmail {

    public function sendToEmployee($idJobdes, $typeEmail){
        $jobdes = DB::table('job_description')->select('*')->where('id','=', $idJobdes)->first();

        switch ($typeEmail){
            case 'PENGAJUAN':
                $msg = 'Anda mendapatkan Pengajuan Job Description dengan detail sebagai berikut : ';
                $idJabatan = $jobdes->id_jabatan_approve;
                $sts = 'Pengajuan';
                $msg2 = 'Anda mengajukan Job Description dengan detail sebagai berikut : ';
                $idJabatan2 = $jobdes->id_jabatan_pic;
                break;
            case 'DITOLAK':    
                $msg = 'pengajuan Job Description Anda ditolak oleh <b>'.$jobdes->nama_approval.'</b>  dengan detail sebagai berikut : ';
                $idJabatan = $jobdes->id_jabatan_pic;
                $sts = 'Ditolak';
                break;
            case 'REVIEW':    
                $msg = ' Anda perlu melakukan Approval Job Description dengan detail sebagai berikut :';
                $idJabatan = $jobdes->id_jabatan_reviewer;
                $msg2 = 'pengajuan Job Description Anda diterima oleh <b>'.$jobdes->nama_approval.'</b>  dengan detail sebagai berikut : ';
                $idJabatan2 = $jobdes->id_jabatan_pic;
                $sts = 'Review';
                break;
            case 'REJECTED':    
                $msg = 'pengajuan Job Description Anda ditolak oleh <b>'.$jobdes->nama_reviewer.'</b>  dengan detail sebagai berikut : ';
                $idJabatan = $jobdes->id_jabatan_approve;
                $sts = 'Ditolak';
                $sts2 = 'Ditolak';
                $msg2 = 'pengajuan Job Description Anda ditolak oleh <b>'.$jobdes->nama_reviewer.'</b>  dengan detail sebagai berikut : ';
                $idJabatan2 = $jobdes->id_jabatan_pic;
                break;         
            case 'DISETUJUI':    
                $msg = 'pengajuan Job Description Anda diterima oleh <b>'.$jobdes->nama_reviewer.'</b>  dengan detail sebagai berikut : ';
                $idJabatan = $jobdes->id_jabatan_approve;       
                $sts = 'Disetujui';        
                $msg2 = 'pengajuan Job Description Anda diterima oleh <b>'.$jobdes->nama_reviewer.'</b>  dengan detail sebagai berikut : '; 
                $idJabatan2 = $jobdes->id_jabatan_pic;
                break;
        }
        $pgw  = DB::table('pegawai')->select('*')->where('id_jabatan','=', $idJabatan)->first();
        if($typeEmail != 'DITOLAK'){
            $pgw2  = DB::table('pegawai')->select('*')->where('id_jabatan','=', $idJabatan2)->first();
        }
        
        $jbtn = DB::table('jabatan')->select('*')->where('id_jabatan','=', $jobdes->id_jabatan)->first();

        Mail::send(['html' => 'admin.global.email'], [
            'msg'               => $msg,
            'namaJabatan'       => $jobdes->nama_jabatan,
            'tanggalPengajuan'  => $jobdes->tanggal_pengajuan,
            'status'            => $sts,
            'namaTujuan'        => $pgw->nama_pegawai,
            'divisi'            => $jbtn->divisi,
            'bidang'            => $jbtn->bidang,
            'subBidang'         => $jbtn->sub_bidang,
        
        ], function ($message) use ($jobdes, $pgw) {
            $message->from('no-reply.jobdesk@iconpln.co.id', 'Admin Job Deskripsi');
            $message->sender('no-reply.jobdesk@iconpln.co.id', 'Admin Job Deskripsi');            
            $message->to($pgw->email, $pgw->nama_pegawai);
            // $message->cc('suci.aini@iconpln.co.id', 'Suci Nuraini');
            // $message->to('khalid.habib@iconpln.co.id', 'Suci Nuraini');
            $message->subject('Job Description - '.$jobdes->nama_jabatan);
            
        });

        if($typeEmail != 'DITOLAK'){
            Mail::send(['html' => 'admin.global.email'], [
                'msg'               => $msg2,
                'namaJabatan'       => $jobdes->nama_jabatan,
                'tanggalPengajuan'  => $jobdes->tanggal_pengajuan,
                'status'            => $sts,
                'namaTujuan'        => $pgw2->nama_pegawai,
                'divisi'            => $jbtn->divisi,
                'bidang'            => $jbtn->bidang,
                'subBidang'         => $jbtn->sub_bidang,
            
            ], function ($message) use ($jobdes, $pgw2) {
                $message->from('no-reply.jobdesk@iconpln.co.id', 'Admin Job Deskripsi');
                $message->sender('no-reply.jobdesk@iconpln.co.id', 'Admin Job Deskripsi');
                // $message->to('khalid.habib@iconpln.co.id', $pgw2->nama_pegawai);                
                $message->to($pgw2->email, $pgw2->nama_pegawai);
                // $message->cc('suci.aini@iconpln.co.id', 'Suci Nuraini');
                // $message->to('khalid.habib@iconpln.co.id', 'Suci Nuraini');
                $message->subject('Job Description - '.$jobdes->nama_jabatan);
                // $message->attach($data['uploaded_path']);
            });
    
        }

        return true;

    }
}