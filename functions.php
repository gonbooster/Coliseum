<?php

  /**************************************************************************************************************/
 /************************************************** FUNCIONES *************************************************/
/**************************************************************************************************************/

				   
//Conectar a la BD
	$con = mysql_connect("localhost","root","")or die("Unable to connect to MySQL");
	mysql_select_db('Coliseum',$con);




// Encriptar datos
function encriptacion($a_encriptar)
{
	$encriptado = md5($a_encriptar);
	return $encriptado;
}



//Comprueba si el email tiene una estructura correcta
function verificaremail($email){ 
	if (!ereg("^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})$",$email)){ 
		return FALSE; 
	} 
	else 
	{
		return TRUE; 
	} 
}



// Devuelve la AID del usuario introducido 
function AID($username)
{
	$consulta = mysql_query("Select * From accounts WHERE Username= '$username'")or die (mysql_error());
	$row=mysql_fetch_array($consulta);	
	return $row['AID'];
}



// Devuelve el nombre de usuario de la id introducida
function UserName($id)
{
	$consulta = mysql_query("Select * From accounts WHERE AID= '$id'")or die ("Error en la consulta AID Username");
	$row=mysql_fetch_array($consulta);	
	return $row['Username'];
}



// La función depurar($a), cambia los caracteres del tipo <, >, # y href ingresados al modificar el perfil, por espacios en blanco.
function depurar($a)
{
	$array = array("<",">","#","href");
	$b = str_replace($array,'',$a);
	return $b;
}



// indica si tienes retos
function Duel($username){
	$username= AID($username);
	$consulta= mysql_query("SELECT * from duel WHERE Retado='$username'")or die(" Error: training");
		if( $row= mysql_fetch_array($consulta) != 0)
		{
		$query = "SELECT * from duel WHERE Retado='$username'";
		$resp = @mysql_query($query) or die(mysql_error());
		$usuarios = mysql_fetch_array($resp);
			for ($i=0; $i<$row;$i++)
			{
				echo 'Tienes un duelo de: '.UserName($usuarios['Retante']).' [ <a href="actions.php?accion=aceptar&retante='.$usuarios['Retante'].'&retado='.$username.'">Aceptar</a> 
				|| <a href="actions.php?accion=rechazar&retante='.$usuarios['Retante'].'&retado='.$username.'">Rechazar</a> ] </br>';
			}
		}
		/*else
		{
			echo "No tienes ning&uacute;n duelo</br>";
		}*/
}



// Consola del usuario
function Console($username){
	$username= AID($username);
	$consulta= mysql_query("SELECT * from console WHERE AID='$username' ORDER BY DATE DESC")or die(" Error: console");
		while($console=mysql_fetch_array($consulta))
		{
		echo $console['Date'].': '.$console['Text'].'</br>';
		}
}



// Sacar Count Console
function Count_console($AID)
{
	$consulta= mysql_query("SELECT * from console WHERE AID='$AID'")or die(" Error: console borrar");
	return $row= mysql_num_rows($consulta);
}



// Sacar Primer Count Console
function First_Count_console($AID)
{
	$consulta= mysql_query("SELECT * from console WHERE AID='$AID' ORDER BY Count DESC")or die(" Error: console borrar");
	$First_count=0;
		while($row=mysql_fetch_array($consulta))
		{
		$First_count= $row['Count'];
		}
	return $First_count;
	}
	
	
	
	// Sacar Ultimo Count Console
function Ultimate_Count_console($AID)
{
	$consulta= mysql_query("SELECT * from console WHERE AID='$AID' ORDER BY Count ASC")or die(" Error: console borrar");
	$Ultimate_count=0;
		while($row=mysql_fetch_array($consulta))
		{
		$Ultimate_count= $row['Count'];
		}
	return $Ultimate_count;
	}

	
	
// Insertar en Consola del usuario
function Console_insertar($AID,$text){
	$count = Ultimate_Count_console($AID)+1;
	$date= date("Y-m-d h:i:s");
	mysql_query("insert into Console (AID,Text,Date,Count) values ('$AID','$text','$date','$count')") ;
	if (Count_console($AID) == 11)
	{
		$count = First_Count_console($AID);
		mysql_query("DELETE from console WHERE AID='$AID' AND Count= '$count'")or die(" Error: console borrar");
	}
}

// Si aceptan tu duelo se te redirige al juego

function State($AID)
{	
	$consulta= mysql_query("SELECT * from duel WHERE Retante='$AID' AND State='1'")or die(" Error: console State");
	if ($row= mysql_num_rows($consulta) != 0)
	{
		header("Location: index.html");
	}
}



// Usuarios online registrados
function Usuarios_online($username)
{
	$ip= getIP();
	$date = time();
	mysql_query("delete from online where Date < $date") ;
	if (isset($_SESSION['Username']))
	{
	$limite = $date+60 ;
		$resp = mysql_query("select * from online where Username='$username'");
		if(mysql_num_rows($resp) != 0)
		{
		mysql_query("update online set Date='$limite' where Username='$username'") ;
		}
		else
		{
			mysql_query("insert into online (Date,Ip,Username) values ('$limite','$ip','$username')") ;
		}
	}
	/*$query = "SELECT * FROM online";
	$resp = @mysql_query($query) or die(mysql_error());
	echo 'Usuarios logeados: '.$usuarios = mysql_num_rows($resp).'</br>';*/
}



// IP						
function getIP()
{
	if( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] )) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if( isset( $_SERVER ['HTTP_VIA'] ))  $ip = $_SERVER['HTTP_VIA'];
	else if( isset( $_SERVER ['REMOTE_ADDR'] ))  $ip = $_SERVER['REMOTE_ADDR'];
	else $ip = null ;
	return $ip;
}


// Redireccionar		
function redireccionar($url,$segundos)
{
	if(!$segundos) { $segundos = 0; 
	} 
	echo '<meta http-equiv="refresh" content="'.$segundos.'; url='.$url.'" />';
}	
?>