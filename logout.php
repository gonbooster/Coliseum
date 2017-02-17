<?php
session_start(); 
require_once('functions.php');

$ip=getIP();
mysql_query("delete from online where Ip = '$ip' AND Username = '$_SESSION[Username]'") ;
$AID=AID($_SESSION[Username]);
mysql_query("Delete from duel WHERE Retado='$AID' OR Retante='$AID'") or die ("Error: duel rechazar");
session_destroy();
header("Location: index.php");
?>