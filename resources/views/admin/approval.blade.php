@extends('admin/admin')
@section('judul_halaman','Approval')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan</h6>
        </div>
        <div class="card-body">
          <table class="table table-striped" id="listDataTable" width="100%" cellspacing="0">
            <thead>
                <tr>                    
                <th scope="col">Nama Mengajukan</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Tanggal Pengajuan</th>
                <th scope="col">Status</th>                    
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
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
  
  $(document).ready(function() { 

    $('#listDataTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('approval/list') }}",
          columns: [                    
                  { data: 'submission_name', name: 'submission_name' },
                  { data: 'nama_jabatan', name: 'nama_jabatan' },                  
                  { data: 'tanggal_pengajuan', name: 'tanggal_pengajuan',"className": "text-center"},
                  { data: 'status', name: 'status', "className": "text-center" },                      
                ]
                
    });
   });
  
  </script>

@endsection