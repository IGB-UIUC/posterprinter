<?php

require_once 'includes/main.inc.php';
require_once 'includes/session.inc.php';
require_once 'posterTube.inc.php';
require_once 'rushOrder.inc.php';

$message = "";
if (isset($_POST['updatePosterTube'])) {
	$result = updatePosterTube($db,$_POST['posterTubeCost']);
	$message = functions::alert($result['MESSAGE'],$result['RESULT']);
	
}
elseif (isset($_POST['updateRushOrder'])) {
	$result = updateRushOrder($db,$_POST['rushOrderCost']);
	$message = functions::alert($result['MESSAGE'],$result['RESULT']);	
}

$posterTubeInfo = getPosterTubeInfo($db);
$posterTubeId = $posterTubeInfo[0]['id'];
$posterTubeCost = $posterTubeInfo[0]['cost'];
	
$rushOrderInfo = getRushOrderInfo($db);
$rushOrderId = $rushOrderInfo[0]['id'];
$rushOrderCost = $rushOrderInfo[0]['cost'];

require_once 'includes/header.inc.php';
?>

<script>

function confirmUpdate()
{
var agree=confirm("Are you sure you wish to update?");
if (agree)
	return true ;
else
	return false ;
}
</script>

<h3>Other Options</h3>
<hr>
<form class='form-inline' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
<h4>Poster Tube</h4>
<div class='form-group'>
	<label for='posterTubeCost'>Price</label>
        <div class="input-group col-md-8">	
                <span class="input-group-addon">$</span>
		<input class='form-control' type='text' name='posterTubeCost' id='posterTubeCost' value='<?php echo $posterTubeCost; ?>'>
	</div>
</div>
<div class='form-group'>
	<input class='btn btn-primary' type='submit' name='updatePosterTube' value='Update Price' onClick='return confirmUpdate()'/>

</div>
<hr>
<h4>Rush Order</h4>
<div class='form-group'>
	<label for='rushOrderCost'>Price</label>
	<div class="input-group col-md-8">
		<span class="input-group-addon">$</span>
		<input class='form-control' type='text' id='rushOrderCost' name='rushOrderCost' value='<?php echo $rushOrderCost; ?>'>
	</div>
</div>
<div class='form-group'>
	<input class='btn btn-primary' type='submit' name='updateRushOrder' value='Update Price' onClick='return confirmUpdate()'/>
</div>
</form>

<br>
<?php 
if (isset($message)) { echo $message; }

require_once 'includes/footer.inc.php'; ?>