<?php 

    session_start();
    include "mysqlconnect.php";
    date_default_timezone_set('Europe/Istanbul');
    $kartid=$_POST["kartId"];
	if ($kartid!="" ) {



$query = $db->query("SELECT * FROM kartlar WHERE kartID = '{$kartid}'")->fetch(PDO::FETCH_ASSOC);
if ( $query ){
    	$_SESSION["kartId"]=$query["kartID"];
		Header("Location:../anasayfa.php");
}else{
		
		Header("Location:../index.php");
	}

	}



?>