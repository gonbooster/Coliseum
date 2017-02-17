<html>
<head><title>Página de Registro</title>
</head>
<body>
<center><h1>Formulario de Registro</h1></center>
<?php
require_once('functions.php');
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$contrasena = encriptacion($_POST['contrasena']);
if($usuario == NULL || $email == NULL || $contrasena == NULL)
{
echo "<center><h2>Debe completar todos los campos</h2></center>";
}
else
{
if(!verificaremail($email))
{
echo "<center><h2>El email ingresado no es válido</h2></center>";
}
else
{
$verificacion_existencia = mysql_query("SELECT * FROM accounts WHERE Username = '$usuario' or Email = '$email'");
if(0 < mysql_fetch_array($verificacion_existencia))
{
echo "<center><h2>El nombre de usuario o el email ya existen en los registros</h2></center>";
}
else
{
/*
require('validacion.php');

$cod_unico_usuario = substr(md5(rand()),0,16);

$validado = "NO";

enviar_correo($email,$usuario,$cod_unico_usuario);

echo "<center>Un correo de validación fue enviado a $email</center>";

*/
$fecha_ingreso = date("Y-m-d h:i:s");
$ip = getIP();
mysql_query("INSERT INTO accounts (Username,Password,Email,Join_date,Login_ip,Register_ip) VALUES ('$usuario','$contrasena','$email','$fecha_ingreso','0','$ip')") or die ("Error de registro");
echo "<center><h2>Usuario Registrado Correctamente</h2></center>";
redireccionar('index.php','2');
}
}
}
?>
<form action='' method='POST'>
<table align="center">
<tr>
<td>
Nombre Usuario:
</td>
<td>
<input type="text" name="usuario" size="15" maxlength="10">
</td>
</tr>
<tr>
<td>
Contraseña:
</td>
<td>
<input type="password" name="contrasena" size="15" maxlength="10">
</td>
</tr>
<tr>
<td>
Email:
</td>
<td>
<input type="text" name="email" size="15" maxlength="30">
</td>
</tr>
</table>
<center><input type="submit" value="Registrarme"></center>
</form>
</body>
</html>