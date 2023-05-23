<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>Job Description</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('sb/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  
  <!-- Custom styles for this template-->
  <link href="{{asset('sb/css/sb-admin-2.min.css')}}" rel="stylesheet">

  <meta name="csrf-token" content="{{ csrf_token() }}"> 

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  
  <!-- Custom styles for this page -->
  <link href="{{asset('sb/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

  <!-- smart wizard-->
  <link href="{{asset('dist/css/smart_wizard.min.css')}}" rel="stylesheet">

  
  <link href="{{asset('dist/css/smart_wizard_theme_circles.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('dist/css/smart_wizard_theme_arrows.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('dist/css/smart_wizard_theme_dots.min.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{asset('tree/themes/default/style.min.css')}}" type="text/css">

  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
  <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
  
  <style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: #ffffff !important;} .asteriskField{color: red;}</style>
<style>
.loader {
            position: relative;
            text-align: center;
            margin: 15px auto 35px auto;
            z-index: 9999;
            display: block;
            width: 80px;
            height: 80px;
            border: 10px solid rgba(0, 0, 0, .3);
            border-radius: 50%;
            border-top-color: #000;
            animation: spin 1s ease-in-out infinite;
            -webkit-animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }


        /** MODAL STYLING **/

        .modal-content {
            border-radius: 0px;
            box-shadow: 0 0 20px 8px rgba(0, 0, 0, 0.7);
        }

        .modal-backdrop.show {
            opacity: 0.75;
        }

        .loader-txt {
            p {
                font-size: 13px;
                color: #666;

                small {
                    font-size: 11.5px;
                    color: #999;
                }
            }
        }
  .asteris {
    content:"*";
    color:red;
    margin-right:5px;
  }
</style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('admin/sidebar')
    <!-- End of Sidebar -->


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('admin/header')        
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('judul_halaman')</h1>            
            @yield('addMenu')
          </div>    
          @yield('dashboard')   
          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->      
      @include('admin/footer');
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ url('logout') }}">Logout</a>
        </div>
      </div>
    </div>
  </div>
 
 <!-- Loading Modal-->
 <div class="modal fade" id="loadModal" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="loader">
                      <!-- <img src="{{asset('img/loading2.gif')}}" alt=""> -->
                    </div>
                    <div clas="loader-txt">
                        <p>Please Wait ... <br><small></small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>
  @yield('modals')
  
  <!-- Bootstrap core JavaScript-->
  <!-- <script src="{{asset('sb/vendor/jquery/jquery.min.js')}}"></script> -->


  <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
  <script src="{{asset('sb/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('sb/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('sb/js/sb-admin-2.min.js')}}"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  <script type="text/javascript">
    // $(document)
    // .ajaxStart(function () {
    //     console.log("start");
    //     $("#loadModal").modal('show');
    // })
    // .ajaxStop(function () {
    //     console.log("stop");
    //     $("#loadModal").modal('hide');
    // });
  </script>

  @yield('scripts')

</body>

</html>
