<?php 
session_start(); 
require_once('functions.php');
if (!isset($_SESSION['Username'])) 
{
header('Location: index.php');
} 
$AID = AID($_SESSION['Username']);
State($AID);
Usuarios_online($_SESSION['Username']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Coliseum</title>
<link rel="icon" href="images/wow.ico"> 
<meta name="keywords" content="Servidores, wow, ranking, top" />
<meta name="description" content="Mundo WoW es una pagina que contiene información de montaje, customización e información sobre servidores privados del World of Warcraft" />
<link href="includes/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="fb-root"></div>
<div id="wrapper"><!-- Begin Wrapper -->
    <div id="preface"><!-- Begin Top Area -->	
        <div id="right"><!-- Begin Top Area Right -->
		<div id="newsletter">
		    <form action="buscar.php" method="post">
                <input type="text" value="Buscar..." name="q" size="10" id="search" title="Buscador" onfocus="clearText(this)" onblur="clearText(this)" />
				 <input type="submit" value="" name="Submit" id="subscribe" />
            </form>
        </div>
		</div><!-- End Top Area Right -->
		
    </div><!-- End Top Area -->
	
<?php include ('header.php');?>


    <div id="main_content">
		<div id="main_content_header">	
		<h2>Consola de registros</h2>
		</div>
			<div id="main_content_inner">
			<?php 
			Console($_SESSION['Username']); ?>
			  </div>
			
		<div id="main_content_footer">
		</div>
					
    </div>
			
            <div id="sidebar">
			
	            <div id="sidebar_top">
				<div class="block block_content">
				
					    <div class="block_header"></div>
						<h3><center>Login</center></h3>

<?php 	if (!isset($_SESSION['Username'])) 
	{ 
	require_once('login.php');
	}
	else
	{
	echo '<center>Bienvenido ['.$_SESSION['Username'].']</center>';
	}
?>

<div class="block_bottom"></div>
					</div>	
					<div class="block block_content">
					    <div class="block_header"></div>
						<a href="mostrar"><h3><center>Luchadores</center></h3></a>

						<?php
						require_once('duel.php'); ?>
							
					
					    <div class="block_bottom"></div>
					</div>
	            </div>
			
	        <?php include ('right.php'); ?>
				
            </div>
        <div style="clear: both;">&nbsp;</div>			
	
</div>

	<?php include ('footer.php'); ?>

	</div>

</body>
</html>