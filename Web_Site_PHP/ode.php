<?php

session_start();
include "mysqlconnect.php";
if ($_POST["tutar"]!="" && $_SESSION['kartId']!="" ) {

	if ($_POST["tutar"]>0) {
		$bakiye_ekle_comm=$db->prepare("update kartlar set bakiye=(bakiye+?) where kartID=?");
		$bakiye_ekle_exec=$bakiye_ekle_comm->execute(array($_POST["tutar"],$_SESSION['kartId']));
		header("Location:../anasayfa.php");
	}else{
		echo "Tutar Hatalı Girildi.";
		header( "refresh:3;url=../yuklemeyap.php" );
		
	}
	
}else{echo "Yanlış İstek";header( "refresh:3;url=../yuklemeyap.php" );}

?>