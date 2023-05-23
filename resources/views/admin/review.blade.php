@extends('admin/admin')
@section('judul_halaman','Review Job Desc')
@section('addMenu')
    
      <div class='col-sm-4'>              
        <div class="input-group mb-3" >          
        <button class="btn btn-primary btn-sm mr-2" id="btnSearch">Search</button>
          <input class="form-control form-control-sm" id="date" name="date"  type="text" value="{{date('Y')}}" aria-describedby="basic-addon1"/>
          <div class="input-group-prepend" id="year">
          <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar" id="" aria-hidden="true"></i></span>
          </div>
        </div>  
      </div>               
@endsection
@section('content')         
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Report Status</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="listDataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th scope="col">Mengajukan</th>
              <th scope="col">Nama Jabatan</th>                      
              <th scope="col">Tanggal Pengajuan</th>                      
              <th scope="col">Status</th>   
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th scope="col">Mengajukan</th>
              <th scope="col">Nama Jabatan</th>                      
              <th scope="col">Tanggal Pengajuan</th>                      
              <th scope="col">Status</th>   
            </tr>
          </tfoot>
          <tbody>
          </tbody>
        </table>
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

  <script type="text/javascript">
   
  $(document).ready(function() { 
            
    // var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		$('#date').datepicker({
			format: 'yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
      viewMode: "years", 
      minViewMode: "years", 
      changeYear: true,
      
		});

    $('#year').click(function() {      
        $("#date").focus();             
    });    
    
    $('#listDataTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('list-review') }}"+ '/'+$('#date').val(),
          columns: [                    
                  { data: 'submission_name', name: 'submission_name' },
                  { data: 'nama_jabatan', name: 'nama_jabatan' },                  
                  { data: 'tanggal_pengajuan', name: 'tanggal_pengajuan',"className": "text-center"},
                  { data: 'status', name: 'status', "className": "text-center" },                
                ]                
    });

    $('#btnSearch').click(function(){      
      var table = $('#listDataTable').DataTable(); 
      table.ajax.url( "{{url('list-review') }}"+ '/'+$('#date').val()).load( null, false );
    });

  });
  
  </script>

@endsection