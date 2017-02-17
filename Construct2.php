<?php
session_start();
require_once("functions.php");
$accion= $_GET['accion'];
$username= $_SESSION['Username'];
Switch ($accion)
{
case "MyUserName":
	echo $username;
	break;
case "RoomID":
	$username= AID($username);
	$consulta= mysql_query("SELECT * from duel WHERE Retante='$username' OR Retado='$username' AND State='1' ORDER BY Date ASC")or die(" Error: Construct2 duel");
	$row=mysql_fetch_array($consulta);
	echo $row['DID'];
	break;
}
?>