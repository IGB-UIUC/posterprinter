<?php
require_once 'includes/main.inc.php';
require_once 'includes/session.inc.php';
require_once 'includes/header.inc.php';


if (isset($_GET['year'])) { $year = $_GET['year']; }
else { $year = date('Y'); }

$previousYear = $year -1;
$nextYear =$year +1;
$startDate = $year . "/01/01";
$endDate = $year . "/12/31";

if (isset($_POST['graphType'])) {
	
	$graphType = $_POST['graphType'];
	$graphImage = "<img src='graphs/graph_" . $graphType . ".php?startDate=" . $startDate . "&endDate=" . $endDate . "'>";

}
else {
	$graphImage = "<img src='graphs/graph_finishOptions.php?startDate=" . $startDate . "&endDate=" . $endDate . "'>";
	$graphType = "finishOptions";
}

$stats = new statistics($db,$startDate,$endDate);

$graphForm = "<form name='selectGraph' id='selectGraph' method='post' action='stats_yearly.php?year=" . $year . "'>";
$graphForm .= "<select class='form-control' name='graphType' onChange='document.selectGraph.submit();'>";

if ($graphType == "finishOptions") { $graphForm .= "<option value='finishOptions' selected>Finish Options</option>"; }
else { $graphForm .= "<option value='finishOptions'>Finish Options</option>"; }
if ($graphType == "paperTypes") { $graphForm .= "<option value='paperTypes' selected>Paper Types</option>"; }
else { $graphForm .= "<option value='paperTypes'>Paper Types</option>"; }
if ($graphType == "inchesPerPaperType") { $graphForm .= "<option value='inchesPerPaperType' selected>Inches Per Paper Type</option>"; }
else { $graphForm .= "<option value='inchesPerPaperType'>Inches Per Paper Type</option>"; }

$graphForm .= "</select>";
$graphForm .= "</form>";
?>


<h3>Yearly Statistics - <?php echo $year; ?></h3>
<hr>
<ul class='pager'>
<li class='previous'><a href='stats_yearly.php?year=<?php echo $previousYear; ?>'>Previous</a></li>
<?php
        $next_year = strtotime('+1 day', strtotime($endDate));
	$today = mktime(0,0,0,date('m'),date('d'),date('y'));

	if ($next_year > $today) {
                echo "<li class='next disabled'><a href='#'>Next</a></li>";
        }
        else {
                echo "<li class='next'><a href='stats_yearly.php?year=" . $nextYear . "'>Next</a></li>";
        }
?>

</ul>
<table class='table table-bordered table-condensed table-striped'>
	<tr><td>Yearly Total:</td><td>$<?php echo $stats->pretty_cost(); ?></td></tr>
	<tr><td>Total Orders:</td><td><?php echo $stats->orders(); ?></td></tr>
    <tr><td>Rush Order Percentage:</td><td><?php echo $stats->percentRushOrder(); ?>%</td></tr>
    <tr><td>Poster Tube Percentage:</td><td><?php echo $stats->percentPosterTube(); ?>%</td></tr>
    <tr><td>Total Inches Printed:</td><td><?php echo $stats->pretty_totalInches(); ?>"</td></tr>
    <tr><td>Average Poster Cost:</td><td>$<?php echo $stats->averagePosterCost(); ?></td></tr>
    <tr><td colspan='2'><?php echo $graphForm; ?></td></tr>
    <tr>
    	<td colspan='2'><?php echo $graphImage; ?></td>
    </tr>

</table>

<?php require_once 'includes/footer.inc.php'; ?>