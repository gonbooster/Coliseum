<?php
session_start();
require_once('functions.php');
 	if (!isset($_SESSION['Username'])) 
	{ 
	echo'<h1>No estas logeado</h1></br>';
	require_once('login.php');
	}
	else
	{
	header("Location: usuario.php");
	}
?>
