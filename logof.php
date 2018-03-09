<?php
	session_start();

	$_SESSION["usuario"] 	= 0;
	$_SESSION["hash"] 		= "finalizado";

	session_destroy();

	header('Location: index.php');

?>