
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Inventory SMKN 1 Padaherang</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="{{url('mdb/css/fontawesome-all.css')}}">
  <!-- Bootstrap core CSS -->
  <link href="{{url('mdb/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{url('mdb/css/mdb.min.css')}}" rel="stylesheet">

  @stack('css')
</head>

<body class="university-lp">
    @yield('content')

<!-- JQuery -->
<script type="text/javascript" src="{{url('mdb/js/jquery-3.4.1.min.js')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{url('mdb/js/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{url('mdb/js/bootstrap.min.js')}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{url('mdb/js/mdb.min.js')}}"></script>
<script>
  // Animation init
  new WOW().init();
</script>
  @include('sweetalert::alert')
  <script src="{{asset('js/sweetalert2@9.js')}}"></script>
</body>

</html>