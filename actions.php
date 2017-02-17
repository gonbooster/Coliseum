<?php
require_once('functions.php');
if($_GET['accion']=="aceptar")
{
$Retante=$_GET['retante'];
$Retado=$_GET['retado'];
mysql_query("update duel set State='1' where Retante='$Retante' AND Retado='$Retado'") ;
mysql_query("Delete from duel WHERE Retado='$Retado' AND State='0'") or die ("Error: duel rechazar");
$text= 'Has aceptado el duelo de <b>'.UserName($Retante).'</b>.';
Console_insertar($Retado,$text);
$text= '<b>'.UserName($Retado).'</b>';
Console_insertar($Retante,$text);
redireccionar("index.html",0);
}
else if($_GET['accion']=="rechazar")
{
$Retante=$_GET['retante'];
$Retado=$_GET['retado'];
mysql_query("Delete from duel WHERE Retante='$Retante' AND Retado='$Retado' AND State='0'") or die ("Error: duel rechazar");
$text= 'Has rechazado el duelo de <b>'.UserName($Retante).'</b>.';
Console_insertar($Retado,$text);
$text= '<b>'.UserName($Retado).'</b> ha rechazado el duelo.';
Console_insertar($Retante,$text);
header("Location: index.php");
}
?>