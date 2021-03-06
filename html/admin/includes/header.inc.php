<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css"
        href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

<link rel='stylesheet' href='../vendor/components/jqueryui/themes/base/jquery-ui.css'>
<link rel="stylesheet" href="../vendor/fortawesome/font-awesome/css/font-awesome.min.css" type="text/css" />
<script src='../vendor/twbs/bootstrap/dist/js/bootstrap.min.js'></script>
<script src='../vendor/components/jquery/jquery.min.js' type='text/javascript'></script>
<script src='../vendor/components/jqueryui/jquery-ui.min.js' type='text/javascript'></script>


<title><?php echo settings::get_title(); ?> Administration</title>

</HEAD>

<body style='padding-top: 80px; padding-bottom: 60px;'>
<nav class="navbar fixed-top navbar-dark bg-dark">
        <a class='navbar-brand py-0' href='#'><?php echo settings::get_title(); ?> Administration</a>
                <span class='navbar-text py-0'>
                Version <?php echo settings::get_version(); ?>&nbsp;
		<a class='btn btn-danger btn-sm' role='button' href='../'>Main Page</a></span>
                </span>

</nav>


<div class='container-fluid'>
	<div class="row">
	<div class="col-md-2 col-lg-2 col-xl-2">
		<div class='sidebar-nav'>	
		<ul class='nav flex-column'>
			<li class='nav-item'><a class='nav-link' href='index.php'>Current Orders</a></li>
			<li class='nav-item'><a class='nav-link' href='billing.php'>Billing</a></li>
			<li class='nav-item'><a class='nav-link' href='paperTypes.php'>Paper Types</a></li>
			<li class='nav-item'><a class='nav-link' href='finishOptions.php'>Finish Options</a></li>
			<li class='nav-item'><a class='nav-link' href='otherOptions.php'>Other Options</a></li>
			<li class='nav-item'><a class='nav-link' href='stats_monthly.php'>Monthly Statistics</a></li>
			<li class='nav-item'><a class='nav-link' href='stats_yearly.php'>Yearly Statistics</a></li>
			<li class='nav-item'><a class='nav-link' href='stats_fiscal.php'>Fiscal Statistics</a></li>
			<li class='nav-item'><a class='nav-link' href='stats_OrdersPerMonth.php'>Orders Per Month</a></li>
			<li class='nav-item'><a class='nav-link' href='stats_avg.php'>Monthly Averages</a></li></a>
			<li class='nav-item'><a class='nav-link' href='logout.php'>Log Out</a></li>
			
		</ul>
		</div>
	</div>
	<div class="col-md-8 col-lg-8 col-xl-8">
