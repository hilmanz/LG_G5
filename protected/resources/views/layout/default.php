<!-- app/views/layout/default.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Aplikasi Kita</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="<?php echo asset('css/bootstrap.css') ?>">
	<script src="<?php echo asset('js/jquery.min.js') ?>"></script>
	<script src="<?php echo asset('js/bootstrap.js') ?>"></script>
  

</head>
<body>

  @yield('content')

</body>
</html>