<?php
session_start();
if(!isset($_SESSION['Username']))
{
header("Location: index.php");
}
else
{
$us = $_SESSION['Username'];
require('functions.php');
$consulta = mysql_query("SELECT * FROM accounts WHERE Username = '$us'");
$row = mysql_fetch_array($consulta);
echo "Bienvenido: <b>$row[Username]</b>";
}
?>

<html>

<head><title>Perfil de Usuario</title>

</head>

<body>

<?php

$id = @$_GET['id'];

if($id == NULL)

{

$us = $_SESSION['usuario'];

$c = mysql_query("SELECT * FROM usuarios WHERE usuario = '$us'");

$array = mysql_fetch_array($c);

header("Location: perfil.php?id=$array[Username]");

}

else

{

$id = @$_GET['id'];

$c = mysql_query("SELECT * FROM accounts WHERE AID = '$id'");

if(mysql_num_rows($c) > 0)

{

$array = mysql_fetch_array($c);

echo "<center><h3>Perfil de <u>$array[1]</u></h3></center>";

echo "<table align='center'><tr><td>Jugador:</td><td>$array[1]</td>";

echo "<tr><td>Dinero:</td><td>$array[2]</td></tr>";

echo "<tr><td>Clan:</td><td>$array[3]</td></tr>";

echo "<tr><td>Descripción:</td><td>$array[4]</td></tr>";

echo "</table>";

}

else

{

echo "<center>Perfil no disponible o inexistente</center>";

echo "<center><a href='index.php.php'>Volver</a></center>";

}

}

$ac = @$_GET['ac'];

if($ac == 'mod')

{

$us = $_SESSION['usuario'];

$consulta = mysql_query("SELECT * FROM accounts WHERE Username = '$us'");

$row = mysql_fetch_array($consulta);

$des = depurar($_POST['descripcion']);

//mysql_query("UPDATE perfiles SET descripcion = '$des' WHERE usuario = '$row[7]'");

header('Location: perfil.php');

}

?>

<hr>

<center><h3>Modifica tu perfil</h3></center>

<form action='perfil.php?ac=mod' method='POST'>

<table align='center'>

<tr>

<td>

Descripción:

</td>

<td>

<textarea name='descripcion'>Tu perfil...</textarea>

</td>

</tr>

</table>

<center><input type='submit' value='Actualizar'></center>

</form>

<center><a href='index.php'>Volver</a></center>

</body>

</html>
