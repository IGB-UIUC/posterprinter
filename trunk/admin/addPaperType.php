<?php
include_once 'includes/main.inc.php';
include_once 'paperTypes.inc.php';

if (isset($_POST['addPaperType'])) {

	$name = $_POST['name'];
	$cost = $_POST['cost'];
	$width = $_POST['width'];
	
	$default = $_POST['default'];
	$name = trim(rtrim($name));
	$cost = trim(rtrim($cost));
	$width = trim(rtrim($width));
	$errors = 0;
	
	if ($name == "") {
		$nameMsg = "<br><b class='error'>Pleae enter finish option name</b>";
		$errors++;
	}
	if (($cost == "") || !eregi('^[0-9]{1}[0-9]*[.]{1}[0-9]{2}$',$cost)) {
		$costMsg = "<br><b class='error'>Please enter a valid cost</b>";
		$errors++;
	}
	
	if (($width == "") || ($width > max_printer_width) || !(eregi("^[0-9]{1,2}$", $width))) {
		$widthMsg = "<br><b class='error'>Please enter a valid Width.  Maximum is " . max_printer_width . "</b>";
		$errors++;
	}
	
	if ($errors == 0) {
	
		addPaperType($db,$name,$cost,$width,$default);	
		header("Location: paperTypes.php");
	
	}

}

include 'includes/header.inc.php';

?>

<form action='addPaperType.php' method='post'>
<table class='table_3'>
	<tr>
		<th colspan='3'>Add New Paper Type</th>
	</tr>
	<tr>
		<td class='td_2'>Name:</td>
		<td class='td_3'><input type='text' name='name' maxlength='40' value='<?php echo $name; ?>' /></td>
	</tr>
	<tr>
		<td class='td_2'>Cost Per Inch:</td>
		<td class='td_3'><input type='text' name='cost' value='<?php echo $cost; ?>' size='6'/> </td>
	</tr>
	<tr>
		<td class='td_2'>Width:</td>
		<td class='td_3'><input type='text' name='width' value='<?php echo $width; ?>' maxlength='2' size='3'/>" </td>
	</tr>
	<tr>
		<td class='td_2'>Make Default:</td>
		<td class='td_3'><input type='checkbox' name='default' value='1'/></td>
	</tr>
	<tr>
		<td class='td_2'></td>
		<td class='td_3'><input type='submit' name='addPaperType' value='Add Paper Type' /></td>
	</tr>
	
</table>
</form>
<?php 

	if (isset($nameMsg)){echo $nameMsg; }
	if (isset($costMsg)){echo $costMsg; }
	if (isset($widthMsg)){echo $widthMsg; }
?>
<?php include 'includes/footer.inc.php'; ?>
