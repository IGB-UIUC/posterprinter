<?php
include '../includes/settings.inc.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/stylesheet.css">

<TITLE>Poster Printer Orders</TITLE>

</HEAD>

<BODY>
<div id='container'>
<div id="header">
<br><center>Poster Printer Administration Center</center>
</div>

<div id='content_left'>
	<ul class='ul_2'>
		<li><a href='index.php'>Current Orders</a></li>
		<li><a href='previousOrders.php'>Previous Orders</a></li>
		<li><a href='paperTypes.php'>Paper Types</a></li>
		<li><a href='finishOptions.php'>Finish Options</a></li>
		<li><a href='otherOptions.php'>Other Options</a></li>
        <li><a href='stats_monthly.php'>Monthly Statistics</a></li>
        <li><a href='stats_yearly.php'>Yearly Statistics</a></li>	
	<li><a href='stats_fiscal.php'>Fiscal Statistics</a></li>
        <li><a href='stats_OrdersPerMonth.php'>Orders Per Month</a></li>
		<li><a href='logout.php'>Log Out</a></li>
       
	</ul>

&nbsp;&nbsp;Version <?php echo app_version; ?>
</div>
<div id="content_center">
