@extends('admin/admin')
@section('judul_halaman','Job Description')
@section('content')                        
    @include('admin/global/viewphpcompare')
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">     
        $(document).ready(function() {                                  
            // $('[data-toggle="tooltip"]').tooltip();  
            $('#revisi').prop('disabled', true);
            $('#rbDecline').click(function(e){          
                $('#revisi').prop('disabled', false);
                $('#approvalId').val("REJECTED");
            });

            $('#rbAccept').click(function(e){
                $('#revisi').val("");     
                $('#approvalId').val("DISETUJUI");
                $('#revisi').prop('disabled', true);          
            });          
            $('#btnSave').click(function(e){                 
                if($('#approvalId').val() != ""){                    
                    var result = confirm("Apakah ingin melakukan Apporval ?");
                    if (result) {
                        // $("#loadModal").modal('show');
                        var fd = new FormData();
                        
                        fd.append('revisi', $('#revisi').val());
                        fd.append('approval', $('#approvalId').val()); 
                        fd.append('hIdJd', $('#h_id_jd').val());                        
                        $.ajax({
                            type: 'POST',
                            url: "{{url('review-response')}}",
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
                                        title: "Approval Sukses Diberikan", 
                                        type: "success"
                                    }).then (function() {                          
                                        window.location.href = "{{url('/review')}}";        
                                    });
                                }else if(response.status == "error") {
                                    alert(response.msg.join("\n"));
                                }                                                      
                            }
                        });                    
                    }
                } else {
                    alert("silahkan pilih tanggapan anda");
                }                
            });

        });        
    </script>
@endsection
