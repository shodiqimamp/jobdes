@extends('admin/admin')
@section('judul_halaman','All Job Description')
@section('content')                   
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Hirarki Pegawai</h6>
    </div>
    <div class="card-body">            
      <div id="data" class="demo"></div>
    </div>
  </div>          
@endsection
@section('scripts')
<script src="{{asset('tree/jstree.min.js')}}"></script>

<script type="text/javascript">         
  $(document).ready(function() {
    $('#data').jstree({
      'core' : {
        'data' : {
          'url' : "{{url('hirarki')}}",
          'data' : function (node) {
            return { 
              'id' : node.id,                                        
            };
          }
        }
      }
    });
  });

</script>


@endsection

