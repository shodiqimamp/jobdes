<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::middleware(['isLogin'])->group(function () {

        //SUPER ADMIN
        Route::middleware(['isSuperAdmin'])->group(function () {
            Route::get('/','AdminController@index');
            Route::get('inputjd','AdminController@inputJd');
            Route::post('addJobDesc','AdminController@addJobDesc');
            Route::get('listJobDesc/{year}/type/{type}','AdminController@jdList');                    
            Route::get('manageuser','AdminController@manageUser');    
            Route::post('adduser','AdminController@addUser');
            Route::get('users-list','AdminController@userList');
            Route::post('mutasi-pegawai','AdminController@mutasiPegawai');
            Route::get('find-user/{id}','AdminController@findUser');
            Route::post('edit-user','AdminController@editUser');
            Route::get('view/{id}','AdminController@viewJobDesc');        
            Route::get('edit/{id}','AdminController@editJobDesc');
            Route::post('editact','AdminController@editJobDescAct');
            Route::get('dashboard/report/{year}','AdminController@dashReport');
            Route::get('dashboard/grafik/{year}','AdminController@grafik');

        });

        Route::get('view/{id}','AdminController@viewJobDesc');  
        
        //ADMIN
        Route::get('review','ReviewController@index');
        Route::get('list-review/{tahun}','ReviewController@jdList');
        Route::get('review/{id}','ReviewController@viewJobDesc');        
        Route::post('review-response','ReviewController@approvalAct');
                        
        Route::get('approval','LeaderController@approval');
        Route::get('approval/view/{id}','LeaderController@approvalView');
        Route::post('approval','LeaderController@approvalAct');
        Route::get('approval/list','LeaderController@listSubmission');
        Route::get('listsubmission','LeaderController@listMySubmission');
        Route::get('submission','LeaderController@viewSubmission');
        Route::get('pengajuan/{id}','LeaderController@pengajuan');
        Route::post('pengajuan','LeaderController@pengajuanAct');
    
        // Route::get('submission','EmployeController@submission');
        // Route::post('submission','EmployeController@submissionAct');
        Route::get('delete/keahlian/{id}','LeaderController@deleteKeahlian');
        Route::get('delete/tantangan/{id}','LeaderController@deleteTantangan');
        Route::get('delete/kewenangan/{id}','LeaderController@deleteKewenangan');
        Route::get('delete/tanggung-jawab/{id}','LeaderController@deleteTanggungJawab');
        Route::get('delete/hubungan-kerja/{id}','LeaderController@deleteHubunganKerja');
        Route::get('delete/deskripsi/{id}','LeaderController@deleteDeskripsi');
        Route::get('delete/bawahan/{id}','LeaderController@deleteBawahan');

        Route::get('usersubmission','EmployeController@oneUser');
        Route::get('alluser','EmployeController@allUser');
        Route::get('hirarki','EmployeController@hirarki');
        Route::get('view-pdf/{id}','EmployeController@viewPdf');
        Route::post('save-satuan','EmployeController@saveSatuan');
        Route::get('get-satuan','EmployeController@getSatuan');
        Route::get('get-data-job/{id}','EmployeController@getDataJobDesc');
        
        //ChainListJabatan
        Route::get('getStructure/{id}','ChainListController@getStructure');
        Route::get('getDirektorat','ChainListController@getDirektorat');
        Route::get('getDivisi/{direktorat}','ChainListController@getDivisi');
        Route::get('getDivisi/{direktorat}/getBidang/{divisi}','ChainListController@getBidang');
        Route::get('getDivisi/{direktorat}/getBidang/{divisi}/getSubbidang/{bidang}','ChainListController@getSubbidang');
        Route::get('getDivisi/{direktorat}/getBidang/{divisi}/getSubbidang/{bidang}/getJabatan/{subBidang}','ChainListController@getJabatan');
        Route::get('getDivisi/{direktorat}/getBidang/{divisi}/getSubbidang/{bidang}/getJabatan/{subBidang}/jabatan/{jabatan}','ChainListController@getKetJabatan');

    });

    
    Route::get('login', function () {    
        if(Session::get('login')){
            return redirect('/');
        } else {
            return view('admin.login');
        }        
    });  
    Route::post('act-login','LoginController@login');
    Route::get('logout','LoginController@logout');          
    



