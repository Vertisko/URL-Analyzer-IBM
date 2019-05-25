<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('tab_title') | Site Analyzer </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <link rel="stylesheet"
          href="{{ URL::asset('plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
</head>

<body class="body">
<div class="wrapper">
    <div class="content-wrapper">
        @yield('content')
        @include('layouts.error')
    </div>

</div>
<!-- REQUIRED JS SCRIPTS -->
<script src="{{ URL::asset('plugins/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ URL::asset('plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('plugins/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(function () {
        $('#dataTable').DataTable({
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Everything"]],
            "aaSorting": []
        });
    })
</script>

</body>
</html>