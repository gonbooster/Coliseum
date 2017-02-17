<?php
 
require_once('functions.php');
$usuario = $_POST['usuario'];
$contrasena = encriptacion($_POST['password']);
if($usuario == NULL && $contrasena == encriptacion(NULL))
{
echo "";
}
elseif ($usuario == NULL)
{
echo "<center><h3>Falta el nombre de usuario</h3></center>";
}
elseif ($contrasena == md5(NULL))
{
echo "<center><h3>Falta la contrase&ntilde;a</h3></center>";
}
else
{
$consulta = mysql_query("SELECT * FROM accounts WHERE Password = '$contrasena' and Username = '$usuario'");
if(mysql_fetch_array($consulta) == 0)
{
echo "<center><h3>Usuario no registrado</h3></center>";
}
else
{
$ip = getIP();
mysql_query("update accounts set Login_ip='$ip' WHERE Password = '$contrasena' and Username = '$usuario'") ;
$_SESSION['Username'] = $usuario;
redireccionar('usuario.php','0');
}
}

?>
</p>
<form action="" method="POST">
<table align="center">
<tr>
<td>
Usuario:
</td>
<td>
<input type="text" name="usuario" maxlength="20">
</td>
</tr>
<tr>
<td>
Contrase&ntilde;a:
</td>
<td>
<input type="password" name="password"  maxlength="20">
</td>
</tr>
</table>

					</p><center><input src="images/conectar.png" type="image"  width="120" height="30" name="entrar" /></center>
					</p>
</form>
<center><a href="register.php">Registrarse</></center></p>