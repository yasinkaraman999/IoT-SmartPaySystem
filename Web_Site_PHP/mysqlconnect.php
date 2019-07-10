<?php
session_start();

try {
	
     
     $db = new PDO("mysql:host=localhost;dbname=smartCard;chatset=utf8","root","By.yasin4141");
     $db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'"); //Turkçe Karakter Sorunu ortadan kaldırıyor
     
     

} catch ( PDOException $e ){
	echo $e;
	//$_SESSION['mesaj'] = $e->getMessage();
	$_SESSION['mesaj'] = '1';
}
?>