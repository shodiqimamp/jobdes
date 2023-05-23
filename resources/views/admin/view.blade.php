@extends('admin/admin')
@section('judul_halaman','Job Description')
@section('content')
                    
    @include('admin/global/viewphp')    

@endsection


@section('scripts')

    <script type="text/javascript">     
        $(document).ready(function() {                                  
            $('[data-toggle="tooltip"]').tooltip();            
        });        
    </script>
@endsection
