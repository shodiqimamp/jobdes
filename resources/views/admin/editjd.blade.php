@extends('admin/admin')
@section('judul_halaman','Approval')
@section('content')

@include('admin/global/formedit')
@endsection

@section('modals')
    @include('admin/global/modalconfirmationdelete')
    @include('admin.global.modaladdsatuan')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="{{asset('myjs/rupiahformat.js')}}"></script>
    <script type="text/javascript" src="{{asset('dist/js/jquery.smartWizard.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('myjs/viewjs.js')}}"></script>
    <script type="text/javascript" src="{{asset('myjs/addform.js')}}"></script>
    <script type="text/javascript"> 
        
        $(document).ready(function() {                      
            $('[data-toggle="tooltip"]').tooltip();
            // Step show event
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

            $('#smartwizard').on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
                if(stepNumber == "6" && stepDirection == "forward") {                
                    setSummary();
                }                                
            });

            $('#revisi').prop('disabled', true);
            $('#rbDecline').click(function(e){          
                $('#revisi').prop('disabled', false);
                $('#approvalId').val("DITOLAK");
            });

            $('#rbAccept').click(function(e){
                $('#revisi').val("");     
                $('#approvalId').val("DISETUJUI");
                $('#revisi').prop('disabled', true);          
            });

            $warningMessage= "Apakah yakin ingin menghapus field";
            $tagRemov="";
            $valTagRemove="";
            $tagRemoveType="";
                                
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
                }else if($tagRemoveType=="DIMENSI"){
                    $url="{{ url('delete/deskripsi') }}/"+$valTagRemove;
                }else if($tagRemoveType=="BAWAHAN"){
                    $url="{{ url('delete/bawahan') }}/"+$valTagRemove;
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

            $('#btnSave').click(function(e){ 
                
                var result = confirm("Are you sure?");
                if (result) {
                    // $("#loadModal").modal('show');
                    var fd = new FormData();
                    $x = $('.allData');
                    for (var i = 0; i < $x.length; i++) {
                        fd.append($x[i].name, $x[i].value);
                    }
                    $.ajax({
                        type: 'POST',
                        url: "{{url('/editact')}}",
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {                          
                            // $("#loadModal").modal('hide');
                            if(response.status == "success"){                                
                                swal({
                                    title: "Berhasil Diupdate", 
                                    type: "success"
                                }).then (function() {                          
                                    window.location.href = "{{url('/')}}";        
                                });
                            }else if(response.status == "error") {                                
                                alert(response.msg.join("\n"));
                            }                                                     
                        }
                    });                    
                }                             
            });

            $('#btnDuplicate').click(function(e){
                var result = confirm("Apakah anda yakin ingin menambahkan jobdes sekarang untuk tahun in?");
                if (result) {
                    // $("#loadModal").modal('show');
                    var fd = new FormData();
                    $x = $('.allData');
                    for (var i = 0; i < $x.length; i++) {
                        fd.append($x[i].name, $x[i].value);
                    }
                    $.ajax({
                        type: 'POST',
                        url: "{{url('addJobDesc')}}",
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {                          
                            // $("#loadModal").modal('hide');
                            if(response.status == "success"){
                                swal({
                                    title: "Job description berhasil ditambahkan", 
                                    type: "success"
                                }).then (function() {                          
                                    window.location.href = "{{url('/')}}";        
                                });
                            }else if(response.status == "error") {
                                alert(response.msg.join("\n"));
                            } else if(response.status == "exist") {
                                alert(response.msg);
                            }                                                    
                        }
                    });                    
                }               
            });
            
        });        
</script>
@endsection
