<?php
	require_once("conbase.php");
	require_once("vendor/autoload.php");
	
	use chillerlan\QRCode\QRCode;
	use chillerlan\QRCode\QROptions;
	
	$query=mysqli_query($con, "SELECT * from emploi_salles where salle_id = '".$_GET['salle_id']."'");
	error_reporting(1);
	if( $query->num_rows > 0 )
	{
		$salle_array = mysqli_fetch_array($query);
		
		echo '<img width="150px" src="'.(new QRCode)->render($salle_array["salle_id"]).'" />';
	}
?>