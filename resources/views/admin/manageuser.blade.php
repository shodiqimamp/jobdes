@extends('admin/admin')
@section('judul_halaman','Manage User')
@section('addMenu')
<div class="row">
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-3" data-toggle="modal" data-target="#mutasiPegawaiModal"><i class="fas fa-user-edit fa-sm mr-1"></i>Mutasi Pegawai</button> 
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-3" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-user-plus fa-sm"></i> Add New User</button>       
</div>

@endsection
@section('content')                   
  @if(Session::has('alert'))
    <div class="alert {{ (Session::get('status') == 'failed') ? 'alert-danger' : 'alert-success' }}  alert-dismissible fade show" role="alert" id="myAlert" width="50%">
            {{Session::get('alert')}}                 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>                
    </div>
  @endif
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Report Status</h6>
      </div>                                            
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="user_datatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>                      
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Manage</th>                                            
              </tr>
            </thead>                 
            <tbody>                    
            </tbody>
          </table>
        </div>
      </div>
    </div>
@endsection

@section('modals')
<!-- Modal Update Pegawai -->
<div class="modal fade" id="updatePegawaiModal" tabindex="-1" role="dialog" aria-labelledby="updatePegawaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Data Pegawai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data"  action="{{url('update-pegawai')}}">
          {{ csrf_field() }}                
                          
            <div class="form-group">
              <label>Upload file</label>
              <input type="file" class="form-control"  name="upload_file" required>              
            </div>
            
            <div class="row float-right">
              <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary mr-3" value="submit">
            </div>            
          </form>          
        </div>        
      </div>
    </div>
  </div>

  <!-- Modal Add New User-->
  <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Users</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{url('adduser')}}">
          {{ csrf_field() }}                
            <div class="form-group">
            <input type="hidden" id="h_nama_pegawai" name="namaPegawai" value="-">
              <label for="namaPegawai">Nama Pegawai</label>
              <select class="form-control selectpicker" id="namaPegawai" data-live-search="true" required>
                  <option disabled="disabled" selected="selected" value="">Select Pegawai </option>
                  @foreach($pegawai as $pgw)
                  <option value="{{$pgw->email}}">{{$pgw->nama_pegawai}}</option>
                  @endforeach
              </select>
            </div>
    
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" required readonly>              
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Role</label>
              <select class="form-control" muliple="multiple" name="role" id="role" required>
                  <option disabled="disabled" selected="selected" value="">Select role .. </option>
                  <option value="SUPER ADMIN">Super Admin</option>
                  <option value="ADMIN">Admin</option>
                  <option value="PEGAWAI">Pegawai</option>                    
              </select>
            </div>
            <div class="row float-right">
              <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary mr-3" value="submit">
            </div>            
          </form>          
        </div>        
      </div>
    </div>
  </div>

  <!-- Modal Edit User-->
  <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="edtiUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Manage Users</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{url('edit-user')}}">
          {{ csrf_field() }}                
            <div class="form-group">            
              <input type="hidden" name="idEdit"  id="idEdit"> <br/>
              <label for="namaPegawai">Nama Pegawai</label>
              <input type="text" class="form-control" id="editNamaPegawai" name="editNamaPegawai" aria-describedby="emailHelp" required readonly> 
            </div>
    
            <div class="form-group">
              <label for="exampleInputPassword1">Role</label>
              <select class="form-control" name="editRole" id="editRole" required>          
                  <option value="SUPER ADMIN">Super Admin</option>
                  <option value="ADMIN">Admin</option>
                  <option value="PEGAWAI">Pegawai</option>
                              
              </select>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Status</label>
              <select class="form-control" name="editStatus" id="editStatus" required>
                <option  value="1">Active</option>
                <option  value="0">Inactive</option>

              </select>
            </div>

            <div class="row float-right">
              <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary mr-3" value="Save">
            </div>            
          </form>
          
        </div>        
      </div>
    </div>
  </div>


@endsection

@section('scripts')
  <!-- Page level plugins -->
  <script src="{{asset('sb/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('sb/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('sb/js/demo/datatables-demo.js')}}"></script>  
  
  <script>

    function setDropdownList(data, textStatus, XMLHttpRequest){      
      $("#direktorat").prop('disabled', false);
      if(data.status == 'success'){
          $('#direktorat').val(data.data[0].direktorat);          
          $("#divisi").prop('disabled', true);
          $("#bidang").prop('disabled', true);
          $("#subBidang").prop('disabled', true);
          $("#namaJabatan").prop('disabled', true);
              
          $('#divisi').append('<option value="" selected="selected">'+data.data[0].divisi+'</option>');
          $('#bidang').append('<option value="" selected="selected">'+data.data[0].bidang+'</option>');
          $('#subBidang').append('<option value="" selected="selected">'+data.data[0].sub_bidang+'</option>');
          $('#namaJabatan').append('<option value="" selected="selected">'+data.data[0].nama_jabatan+'</option>');

          $('#atasanTidakLangsung').val(data.data[0].atasan_tidak_langsung);
          $('#atasanLangsung').val(data.data[0].atasan_langsung);  
          $('#idJabatan').val(data.data[0].id_jabatan);         
      }
      
    }

    function clearDropdownList(){
      clearKetJabatan();      
      $("#divisi").children().remove();
      $("#bidang").children().remove();
      $("#subBidang").children().remove();
      $("#namaJabatan").children().remove();
      
    }

    function clearKetJabatan(){
        $('#atasanTidakLangsung').val("");
        $('#atasanLangsung').val("");  
        $('#idJabatan').val("");    
    }
    $(document).ready(function() {  
      $("#direktorat").prop('disabled', true);
      $("#divisi").prop('disabled', true);
      $("#bidang").prop('disabled', true);
      $("#subBidang").prop('disabled', true);
      $("#namaJabatan").prop('disabled', true);
      $('#namaPegawaiMutasi').change(function(){        
          $.ajax({
              type: "GET",
              url: "{{url('getStructure')}}"+"/"+$("#namaPegawaiMutasi").val(),
              dataType: "json",
              beforeSend: function(e) {
                  if(e && e.overrideMimeType) {
                  e.overrideMimeType("application/json;charset=UTF-8");
                  }
              },
              success: function(response){                
                  clearDropdownList();
                  setDropdownList(response);                  
              },
              error: function (xhr, ajaxOptions, thrownError) {
              }
          });
      });

      $('#direktorat').change(function(){
          $.ajax({
              type: "GET",
              url: "{{url('getDivisi')}}"+"/"+$("#direktorat").val(),
              dataType: "json",
              beforeSend: function(e) {
                  if(e && e.overrideMimeType) {
                  e.overrideMimeType("application/json;charset=UTF-8");
                  }
              },
              success: function(response){
                  $("#divisi").prop('disabled', false);
                  $("#bidang").prop('disabled', true);
                  $("#subBidang").prop('disabled', true);
                  $("#namaJabatan").prop('disabled', true);

                  $("#divisi").children().remove();
                  $("#bidang").children().remove();
                  $("#subBidang").children().remove();
                  $("#namaJabatan").children().remove();
                  $('#divisi').append('<option value="" disabled="disabled" selected="selected">Pilih Divisi</option>');
                  for(var i=0; i<response.data.length; i++){
                      $('#divisi').append('<option value="'+response.data[i].divisi+'">'+response.data[i].divisi+'</option>');
                  }                      
                  clearKetJabatan()  
              },
              error: function (xhr, ajaxOptions, thrownError) {
              }
          });
      });

      $('#divisi').change(function(){
          $.ajax({
              type: "GET",
              url: "{{url('getDivisi')}}"+"/"+$("#direktorat").val()+"/getBidang/"+$("#divisi").val(),
              dataType: "json",
              beforeSend: function(e) {
                  if(e && e.overrideMimeType) {
                      e.overrideMimeType("application/json;charset=UTF-8");
                  }
              },
              success: function(response){

                  $("#bidang").prop('disabled', false);
                  $("#subBidang").prop('disabled', true);
                  $("#namaJabatan").prop('disabled', true);

                  $("#bidang").children().remove();
                  $("#subBidang").children().remove();
                  $("#namaJabatan").children().remove();

                  $('#bidang').append('<option value="" disabled="disabled" selected="selected">Pilih Bidang</option>');
                  for(var i=0; i<response.data.length; i++){
                      $('#bidang').append('<option value="'+response.data[i].bidang+'">'+response.data[i].bidang+'</option>');
                  }   
                  clearKetJabatan()                     
              },
              error: function (xhr, ajaxOptions, thrownError) {
              }
          });
      });

      $('#bidang').change(function(){

          $.ajax({
              type: "GET",
              url: "{{url('getDivisi')}}"+"/"+$("#direktorat").val()+"/getBidang/"+$("#divisi").val()+"/getSubbidang/"+$("#bidang").val(),
              dataType: "json",
              beforeSend: function(e) {
                  if(e && e.overrideMimeType) {
                  e.overrideMimeType("application/json;charset=UTF-8");
                  }
              },
              success: function(response){

                  $("#subBidang").prop('disabled', false);
                  $("#namaJabatan").prop('disabled', true);

                  $("#subBidang").children().remove();
                  $("#namaJabatan").children().remove();

                  $('#subBidang').append('<option value="" disabled="disabled" selected="selected">Pilih Sub Bidang</option>');
                  for(var i=0; i<response.data.length; i++){
                      $('#subBidang').append('<option value="'+response.data[i].sub_bidang+'">'+response.data[i].sub_bidang+'</option>');
                  }               
                  clearKetJabatan()         
              },
              error: function (xhr, ajaxOptions, thrownError) {
              }
          });
      });

      $('#subBidang').change(function(){

          $.ajax({
              type: "GET",
              url: "{{url('getDivisi')}}"+"/"+$("#direktorat").val()+"/getBidang/"+$("#divisi").val()+"/getSubbidang/"+$("#bidang").val()+"/getJabatan/"+$("#subBidang").val(),
              dataType: "json",
              beforeSend: function(e) {
                  if(e && e.overrideMimeType) {
                  e.overrideMimeType("application/json;charset=UTF-8");
                  }
              },
              success: function(response){

                  $("#namaJabatan").prop('disabled', false);

                  $("#namaJabatan").children().remove();

                  $('#namaJabatan').append('<option value="" disabled="disabled" selected="selected">Pilih Jabatan</option>');
                  for(var i=0; i<response.data.length; i++){
                      $('#namaJabatan').append('<option value="'+response.data[i].nama_jabatan+'">'+response.data[i].nama_jabatan+'</option>');
                  }     
                  clearKetJabatan()                   
              },
              error: function (xhr, ajaxOptions, thrownError) {
              }
          });
      });

      $('#namaJabatan').change(function(){
          $.ajax({
              type: "GET",
              url: "{{url('getDivisi')}}"+"/"+$("#direktorat").val()+"/getBidang/"+$("#divisi").val()+"/getSubbidang/"+$("#bidang").val()+"/getJabatan/"+$("#subBidang").val()+"/jabatan/"+$('#namaJabatan').val(),
              dataType: "json",
              beforeSend: function(e) {
                  if(e && e.overrideMimeType) {
                  e.overrideMimeType("application/json;charset=UTF-8");
                  }
              },
              success: function(response){               
                  $('#atasanLangsung').val(response.data[0].atasan_langsung);
                  $('#atasanTidakLangsung').val(response.data[0].atasan_tidak_langsung);
                  $('#idJabatan').val(response.data[0].id_jabatan);
              },
              error: function (xhr, ajaxOptions, thrownError) {
              }
          });
      });

      $("#namaPegawai").change(function(){
        $('#email').val($("#namaPegawai").val());
        $('#h_nama_pegawai').val($("#namaPegawai option:selected").text());
      });

      $('#user_datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('users-list') }}",
          columns: [                    
                  { data: 'name', name: 'name' },
                  { data: 'email', name: 'email' },
                  { data: 'role', name: 'role' },
                  { data: 'status', name: 'status' },
                  // { data: 'status', name: 'status',                    
                  //   render: function (){
                  //     return '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="x" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem">Edit</a>';
                  //   }
                  // }
                  {data: 'action', name: 'action', orderable: false, searchable: false},      
                ]
      });

      $('body').on('click', '.editItem', function () {
          var Item_id = $(this).data('id');
          $.get("{{ url('find-user') }}" +'/' + Item_id, function (data) {
              $('#idEdit').val(data.id);              
              $('#editUserModal').modal('show'); 
              $('#editStatus').val(data.status);                            
              $('#editRole').val(data.role);              
              $('#editNamaPegawai').val(data.name);
              
          })
      });
        
    });
  </script>
@endsection