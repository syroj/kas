<!DOCTYPE html>
<html lang="en">
<head>
<title>Catatan Keuangan</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('/template/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('/template/css/bootstrap-responsive.min.css')}}" />
<link rel="stylesheet" href="{{asset('/template/css/fullcalendar.css')}}" />
<link rel="stylesheet" href="{{asset('/template/css/datepicker.css')}}" />
<link rel="stylesheet" href="{{asset('/template/css/matrix-style.css')}}" />
<link rel="stylesheet" href="{{asset('/template/css/matrix-media.css')}}" />
<link href="{{asset('/template/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('/template/css/jquery.gritter.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('/css/sweetalert.css')}}">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body>

<!--Header-part-->
<div id="header">
  <span class="fa fa-home"></span>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
  @if(Auth::check())
    <li><a href="{{url('/')}}"> <i class="icon-home"></i><span class="text"> Home</span></a></li>
    <li>
    <a href="{{url('/database')}} "><i class="icon-file"></i><span class="text"> DataBase</span></a>
  </li>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-bar-chart"></i><span class="text"> Laporan</span><b class="caret"></b></a>
    <ul class="dropdown-menu">
    	<li><a href="#">Pdf</a></li>
    	<li><a href="#">Excell</a></li>
    </ul>
    </li>
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text"> {{Auth()->user()->name}}</span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="icon-user"></i> {{Auth()->user()->name}} </a></li>
        <li class="divider"></li>
        <li>
          <a href="{{ url('/logout') }}"
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
              Logout
          </a>

          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </li>
    @endif
  
  </ul>
</div>
<!--close-top-Header-menu-->

<div id="content">
	
<!--breadcrumbs-->
  <div id="content-header">
  </div>
<!--End-breadcrumbs-->
@yield('content')
</div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> {{date('Y')}} &copy; App by SyrojHadi</div>
</div>

<!--end-Footer-part-->
<script src="{{asset('/js/jquery.js')}}"></script>
<script src="{{asset('/template/js/jquery.min.js')}}"></script> 
<script src="{{asset('/template/js/jquery.ui.custom.js')}}"></script> 
<script src="{{asset('/template/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('/template/js/jquery.flot.min.js')}}"></script> 
<script src="{{asset('/template/js/jquery.flot.resize.min.js')}}"></script> 
<script src="{{asset('/template/js/jquery.peity.min.js')}}"></script> 
<script src="{{asset('/template/js/jquery.wizard.js')}}"></script> 
<script src="{{asset('/template/js/jquery.uniform.js')}}"></script> 
<script src="{{asset('/template/js/select2.min.js')}}"></script> 
<script src="{{asset('/template/js/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('/template/js/matrix.tables.js')}}"></script> 
<script src="{{asset('/js/sweetalert.min.js')}}"></script>
@include('sweet::alert')
<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
<script>
  $(document).ready(function(){
    $(document.body).on('click','#pemasukan',function(event){
      event.preventDefault()
      var $form = $(this).closest('form')
      var $el = $(this)
      var text = $el.data('confirm-message') ? $el.data('confirm-message') : 'Data yang telah dimasukkan tidak dapat diubah atau dihapus'
      swal({
        title: 'Anda yakin?',
        text: text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Iya, lanjutkan!',
        cancelButtonText: 'Batal',
        closeOnConfirm: true
        },
      function(){
        $form.submit()
      })
    })
    $(document.body).on('click','#pengeluaran',function(event){
      event.preventDefault()
      var $form = $(this).closest('form')
      var $el = $(this)
      var text = $el.data('confirm-message') ? $el.data('confirm-message') : 'Data yang telah dimasukkan tidak dapat diubah atau dihapus'
      swal({
        title: 'Anda yakin?',
        text: text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Iya, lanjutkan!',
        cancelButtonText: 'Batal',
        closeOnConfirm: true
        },
      function(){
        $form.submit()
      })
    })
  })
</script>
</body>
</html>
