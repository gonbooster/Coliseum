
<div id="header">
            <div id="logo">                	
				<h1>Coliseum</h1>
            </div>
            <div id="middle">
             <p></p>
			
            </div>
           
    </div>
	
     <div id="navigation" class="menu">
         <ul>
         <li><a href="usuario.php">Inicio</a></li>
		 <li><a href="mensajeria.php">Mensajeria</a></li>
		 <li><a href="foro/">Foro</a></li>
		 
		 
		 <?php
		 if(isset($_SESSION['Username'])){ ?>
		 <li><a href="administrar">Administrar</a></li>
		<li>
<form method="post">
  <input type="image" src="includes/images/desconectar.png"  width="40" height="40" name="desconectarse" title="Desconectarse"/>
</form>
		
<?php }
		 
		  if ($_POST['desconectarse_x']){
session_start();
session_destroy();
		
   		redireccionar("index.php",0);
		
} ?>
         </ul>
       </div>