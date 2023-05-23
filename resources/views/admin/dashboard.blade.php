@extends('admin/admin')
@section('judul_halaman','Dashboard')
@section('addMenu')    
  <div class='col-sm-4'>              
    <div class="input-group mb-1" >          
    <button class="btn btn-primary btn-sm mr-2" id="btnSearch">Search</button>
      <input class="form-control form-control-sm" id="date" name="date"  type="text" value="{{date('Y')}}" aria-describedby="basic-addon1"/>
      <div class="input-group-prepend" id="year">
      <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar" id="" aria-hidden="true"></i></span>
      </div>
    </div>  
  </div>                     
@endsection
@section('dashboard')
<!-- Content Row -->
<div class="row">
<!-- Done -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-success shadow h-80">
    <div class="card-body" id="divSelesai">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800" id="selesai">{{$perDone}}% <span style="font-size:16px; color:grey" id="spanDone">({{$selesai[0]->total}})</span></div>
        </div>
        <div class="col-auto">
          <button class="btn btn-success btn-sm">
            <i class="fas fa-check  fa-2x text-gray-300"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Total -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-80">
    <div class="card-body" id="divReview">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Review</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800" id='total'>{{$perReview}}% <span style="font-size:16px; color:grey">({{$review[0]->total}})
          </span></div>
        </div>
        <div class="col-auto">
          <button class="btn btn-info btn-sm">
            <i class="far fa-eye fa-2x text-gray-300"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pengajuan -->
<div class="col-xl-3 col-md-6 mb-2">
  <div class="card border-left-primary shadow h-80">
    <div class="card-body" id="divPengajuan">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengajuan</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800" id="pengajuan">{{$perPengajuan}}% <span style="font-size:16px; color:grey">({{$pengajuan[0]->total}})</span></div>
        </div>
        <div class="col-auto">
          <button class="btn btn-primary btn-sm">
          <i class="fas fa-tasks fa-2x text-gray-300"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-danger shadow h-80">
    <div class="card-body" id="divUnprocess">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Unprocess</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800" id="unprocess">{{$perUnproces}}% <span style="font-size:16px; color:grey">({{$unproces[0]->total}})</span></div>
        </div>
        <div class="col-auto">
          <button class="btn btn-danger btn-sm">
            <i class="fas fa-exclamation-triangle  fa-2x text-gray-300"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection
@section('content')         
  <!-- DataTales Example -->
  <!-- Project Card Example -->
              <!-- Pie Chart -->
<div class="row" id="divPie">

<!-- Area Chart -->
  <div class="col-xl-7 col-lg-6">
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
                                   
                <th scope="col">Status</th>   
              </tr>
            </thead>          
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Pie Chart -->
  <div class="col-xl-5 col-lg-6">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Grafik</h6>     
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
          <canvas id="myPieChart"></canvas>
        </div>
        <div class="mt-4 text-center small">
          <span class="mr-2">
            <i class="fas fa-circle text-success"></i> Selesai
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-info"></i> Review
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-primary"></i> Pengajuan
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-danger"></i> Unprocess
          </span>
        </div>
      </div>
    </div>
  </div>
  
</div>



              
  

  
@endsection

@section('scripts')
  
  <!-- Page level plugins -->
  <script src="{{asset('sb/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('sb/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
   <!-- Page level plugins -->
   <script src="{{asset('sb/vendor/chart.js/Chart.min.js')}}"></script>
   

  <!-- Page level custom scripts -->
  <script src="{{asset('sb/js/demo/datatables-demo.js')}}"></script>  
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <script src="{{asset('sb/js/demo/chart-pie-demo.js')}}"></script>

  <script type="text/javascript">


   
  $(document).ready(function() { 
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["Selesai", "Review", "Pengajuan","Unprocess"],
        datasets: [{
          data: [],
          backgroundColor: ['#1cc88a','#36b9cc', '#4e73df','#F32013'],
          hoverBackgroundColor: ['#17a673','#2c9faf', '#2e59d9','#CA0B00'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });          
    
    $.ajax({
      type: "GET", 
      url: "{{ url('dashboard/report') }}"+"/2020",             
      dataType: "json",
      beforeSend: function(e) {
          if(e && e.overrideMimeType) {
          e.overrideMimeType("application/json;charset=UTF-8");
          }
      },
      success: function(response){                 
          
          if(response.status == 'success'){                        
            myPieChart.data.datasets[0].data.push(response.selesai[0].total);  
            myPieChart.data.datasets[0].data.push(response.review[0].total);  
            myPieChart.data.datasets[0].data.push(response.pengajuan[0].total);  
            myPieChart.data.datasets[0].data.push(response.unproces[0].total);  
            myPieChart.update();
          }                                                 
      },
      error: function (xhr, ajaxOptions, thrownError) { 
          // alert(thrownError); 
      }
    });        
    
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
          scrollY:"184px",
          ajax: "{{ url('listJobDesc') }}"+ '/'+$('#date').val()+'/type/all',
          columns: [                    
                  { data: 'submission_name', name: 'submission_name' },
                  { data: 'nama_jabatan', name: 'nama_jabatan' },                  
                
                  { data: 'status', name: 'status', "className": "text-center" },                
                ]                
    });

    $('#btnSearch').click(function(){      
      var table = $('#listDataTable').DataTable(); 
      table.ajax.url( "{{url('listJobDesc') }}"+ '/'+$('#date').val()+"/type/all").load( null, false );
      // $('#tbl').hide();
      // $('#divPie').show();
      $.ajax({
        type: "GET", 
        url: "{{ url('dashboard/report') }}"+"/"+$('#date').val(),             
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(response){                 
            
            if(response.status == 'success'){
              $('#total').empty();
              $('#selesai').empty();
              $('#pengajuan').empty();
              $('#unprocess').empty();
              $('#total').append(response.perReview+"% <span style='font-size:16px; color:grey'>("+response.review[0].total+")</span>");              
              $('#selesai').append(response.perDone+"% <span style='font-size:16px; color:grey'>("+response.selesai[0].total+")</span>");
              $('#pengajuan').append(response.perPengajuan+"%  <span style='font-size:16px; color:grey'>("+response.pengajuan[0].total+")</span>");
              $('#unprocess').append(response.perUnproces+"%  <span style='font-size:16px; color:grey'>("+response.unproces[0].total +")</span>");       
              
              myPieChart.data.datasets[0].data[0]=response.selesai[0].total;  
              myPieChart.data.datasets[0].data[1]=response.review[0].total;  
              myPieChart.data.datasets[0].data[2]=response.pengajuan[0].total;  
              myPieChart.data.datasets[0].data[3]=response.unproces[0].total;  
              myPieChart.update();
              
            }                                                 
        },
        error: function (xhr, ajaxOptions, thrownError) { 
            // alert(thrownError); 
        }
      });
    });

    $('#divSelesai').click(function() {  
      $('#tbl').show();    
          // $('#divPie').hide();    
      var table = $('#listDataTable').DataTable(); 
      table.ajax.url( "{{url('listJobDesc') }}"+ '/'+$('#date').val()+'/type/selesai').load( null, false );
      $.ajax({
        type: "GET", 
        url: "{{ url('dashboard/report') }}"+"/"+$('#date').val(),             
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(response){                 
          
        },
        error: function (xhr, ajaxOptions, thrownError) { 
            // alert(thrownError); 
        }
      });
    });

    $('#divReview').click(function() {      
      // $('#tbl').show();      
      // $('#divPie').hide();   
      var table = $('#listDataTable').DataTable(); 
      table.ajax.url( "{{url('listJobDesc') }}"+ '/'+$('#date').val()+'/type/review').load( null, false );
      $.ajax({
        type: "GET", 
        url: "{{ url('dashboard/report') }}"+"/"+$('#date').val(),             
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(response){                 
                                                     
        },
        error: function (xhr, ajaxOptions, thrownError) { 
            // alert(thrownError); 
        }
      });
    });

    $('#divPengajuan').click(function() {      
      // $('#tbl').show();      
      // $('#divPie').hide();   
      var table = $('#listDataTable').DataTable(); 
      table.ajax.url( "{{url('listJobDesc') }}"+ '/'+$('#date').val()+'/type/pengajuan').load( null, false );
      $.ajax({
        type: "GET", 
        url: "{{ url('dashboard/report') }}"+"/"+$('#date').val(),             
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(response){                 
          
        },
        error: function (xhr, ajaxOptions, thrownError) { 
            // alert(thrownError); 
        }
      });
    });

    $('#divUnprocess').click(function() {   
      // $('#tbl').show();      
      // $('#divPie').hide();      
      var table = $('#listDataTable').DataTable(); 
      table.ajax.url( "{{url('listJobDesc') }}"+ '/'+$('#date').val()+'/type/unprocess').load( null, false );
      $.ajax({
        type: "GET", 
        url: "{{ url('dashboard/report') }}"+"/"+$('#date').val(),             
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(response){                 
         
        },
        error: function (xhr, ajaxOptions, thrownError) { 
            // alert(thrownError); 
        }
      });
    });

  });
  
  </script>

@endsection