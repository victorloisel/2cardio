<?php
	session_start();
	session_destroy();	
	header('location:../Page/Connexion.php');
?>
