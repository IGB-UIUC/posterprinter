<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<script src='vendor/components/jquery/jquery.min.js' type='text/javascript'></script>
<script src='vendor/components/jqueryui/jquery-ui.min.js' type='text/javascript'></script>
<script src='vendor/twbs/bootstrap/dist/js/bootstrap.min.js' type='text/javascript'></script>
<script src='includes/poster.inc.js' type='text/javascript'></script>

<link rel='stylesheet' type='text/css' href='vendor/components/jqueryui/themes/base/jquery-ui.css'>
<link rel="stylesheet" type="text/css" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

<title><?php echo settings::get_title(); ?></title>

</head>
<body style='padding-top: 70px;'>
<nav class="navbar fixed-top navbar-dark bg-dark">
	<a class='navbar-brand' href='#'><?php echo settings::get_title(); ?></a>
		<span class='navbar-text'>Version <?php echo settings::get_version(); ?></span>
</nav>

<div class='container'>
	<div class='col-md-8 col-lg-8 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2'>