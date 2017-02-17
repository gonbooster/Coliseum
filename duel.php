<?php
require_once('functions.php');
$username= AID($_SESSION["Username"]);
$consulta= mysql_query("SELECT * from duel WHERE Retado='$username' OR Retante='$username'")or die(" Error: training");
if( $row= mysql_fetch_array($consulta) == 0)
{
	$consulta = mysql_query("select * from online Where Username !='$_SESSION[Username]' ") ;
	while($online=mysql_fetch_array($consulta))
	{
		$usuario= $online['Username'];
		$id= AID($usuario);
		echo '<a href="usuario.php?id='.$id.'">'.$usuario.'</a></br>';
	}
	if (!empty($_GET['id']) && isset($_GET['id']))
	{
	$id=$_GET['id'];
	$consulta= mysql_query("SELECT * from duel WHERE Retante='$username'")or die(" Error: training");
	if(($row= mysql_fetch_array($consulta) == 0))
	{
		$date = time();
		mysql_query("insert into duel (Retante,Retado,Date,State) values ('$username','$id','$date','0')");
		$date= date("Y-m-d h:i:s");
		$text= '['.UserName($username).'] te ha retado a un duelo.';
		Console_insertar($id,$text);
		$text= 'Has retado ha ['.UserName($id).'].';
		Console_insertar($username,$text);
		redireccionar('index.php','0');
	}
}
}
else
{
	Duel($_SESSION['Username']);
} 
redireccionar('usuario.php','20');
?>