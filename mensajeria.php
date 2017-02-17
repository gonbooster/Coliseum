<?php
session_start();
if(!isset($_SESSION['Username']))
{
header("Location: index.php");
}
else
{
require_once("functions.php");
echo "Bienvenido: <b>$_SESSION[Username]</b>";
}
?>
<html>
<head><title>Mensajería</title>
</head>
<body>
<center><a href='mensajeria.php?id=band'>Bandeja de Entrada</a> | 
<a href='mensajeria.php?id=envi'>Enviados</a></center>
<?php
$us = $_SESSION['Username'];
$id = $_GET['id'];
$msj = @$_GET['msj'];
if($id == 'band')
{
echo "<center><h3>Bandeja de Entrada</h3></center>";
$consulta = mysql_query("SELECT * FROM accounts WHERE Username = '$us'");
$row0 = mysql_fetch_array($consulta);
$bandeja = mysql_query("SELECT * FROM messages WHERE Receiver = '$row0[Username]' ORDER BY MID") or die("Error");
if(0 < mysql_num_rows($bandeja))
{
while($row = mysql_fetch_array($bandeja))
{
echo "<table align='center' border='1'>";
echo "<tr><td>Remitente:</td><td>$row[1]</td></tr>";
echo "<tr><td>Asunto:</td><td>$row[3]</td></tr>";
echo "<tr><td>Fecha:</td><td>$row[5]</td></tr>";
echo "<tr><td>Mensaje:</td><td>$row[4]</td></tr>";
echo "</table><center><a href='mensajeria.php?id=borra&msj=$row[0]'>Borrar Mensaje</a></center><br>";
}
}
else
{
echo "<center>No hay mensajes en la bandeja de entrada</center>";
}
}
else
{
if($id == 'envi')
{
echo "<center><h3>Elementos Enviados</h3></center>";
$enviados = mysql_query("SELECT * FROM messages_sent WHERE Sender = '$us' ORDER BY MsID")or die ("Error $enviados");
if(mysql_fetch_array($enviados) > 0)
{
while($row = mysql_fetch_array($enviados))
{
echo "<table align='center' border='1'>";
echo "<tr><td>Para:</td><td>$row[2]</td></tr>";
echo "<tr><td>Asunto:</td><td>$row[3]</td></tr>";
echo "<tr><td>Fecha:</td><td>$row[5]</td></tr>";
echo "<tr><td>Mensaje:</td><td>$row[4]</td></tr>";
echo "</table><center><a href='mensajeria.php?id=borraenv&msj=$row[0]'>Borrar Mensaje</a></center><br>";
}
}
else
{
echo "<center>No existen elementos enviados</center>";
}
}
else
{
if($id == 'borra')
{
mysql_query("DELETE FROM messages WHERE MID = '$msj'");
redireccionar('ensajeria.php?id=band','0');
}
else
{
if($id == 'envio')
{
$consulta = mysql_query("SELECT * FROM accounts WHERE Username = '$us'");
$row = mysql_fetch_array($consulta);
$des = $_POST['destinatario'];
$asu = $_POST['asunto'];
$men = $_POST['mensaje'];
$fec = date('Y-m-d H:i:s');
$est = 0;
mysql_query("INSERT INTO messages_sent (Sender,Receiver,Subject,Message,Date,State)
VALUES ('$us','$des','$asu','$men','$est')");
mysql_query("INSERT INTO messages_sent (Sender,Receiver,Subject,Message,Date,State)
VALUES ('$us','$des','$asu','$men','$fec','$est')");
echo "<center>Mensaje Enviado con éxito</center>";
}
else
{
if($id == 'borraenv')
{
mysql_query("DELETE FROM messages_sent WHERE MsID = '$msj'");
redireccionar('mensajeria.php?id=band','0');
}
}
}
}
}
?>
<hr>
<center><h2>Enviar Mensaje Instantáneo</h2></center>
<form action='mensajeria.php?id=envio' method='POST'>
<table align='center'>
<tr>
<td>
Destinatario:
</td>
<td>
<input type='text' name='destinatario' maxlenght='30' size='20'>
</td>
</tr>
<tr>
<td>
Asunto:
</td>
<td>
<input type='text' name='asunto' maxlenght='50' size='20'>
</td>
</tr>
<tr>
<td>
Mensaje:
</td>
<td>
<textarea name='mensaje'></textarea>
</td>
</tr>
</table>
<center><input type='submit' value='Enviar'></center>
</form>
<center><a href='index.php'>Volver</a></center>
</body>
</html>