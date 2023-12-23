<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
@include('admin.Layout.Css')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
@include('admin.Layout.Header')

  <!-- Main Sidebar Container -->
@include('admin.Layout.SideBar')

 @include('admin.Layout.Content')
 @include('admin.Layout.Content')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('admin.Layout.Js')

</body>
</html>
