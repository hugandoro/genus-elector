<?php

 $currentPage = $_SERVER["PHP_SELF"];

 session_start();

?>

<?php require_once('parametros.php'); ?>

<?php require_once('Connections/sle.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?php echo $titulo; ?></title>

<link href="estilos.css" rel="stylesheet" type="text/css" />

<script>

//ACEPTAR SOLO NUMEROS

	var nav4 = window.Event ? true : false;

    function acceptNum(evt)

    {

       var key = nav4 ? evt.which : evt.keyCode;

       return (key <= 13 || (key >= 48 && key <= 57));

    }

	





//NO ESPACIOS	

    function noespacios() 

	{

	   var er = new RegExp(/\s/);

	   var web = document.getElementById('n1').value;

	   if(er.test(web))

	   {

			alert('No se permiten espacios en campo PRIMER NOMBRE');

			return false;

	   }

	   var web = document.getElementById('n2').value;

	   if(er.test(web))

	   {

			alert('No se permiten espacios en campo SEGUNDO NOMBRE');

			return false;

	   }

	   var web = document.getElementById('a1').value;

	   if(er.test(web))

	   {

			alert('No se permiten espacios en campo PRIMER APELLIDO');

			return false;

		}

		var web = document.getElementById('a2').value;

		if(er.test(web))

		{

			alert('No se permiten espacios en campo SEGUNDO APELLIDO');

			return false;

		}

		

		//CAMPOS OBLIGATORIOS

	    if(document.getElementById('n1').value==''){

          alert('Debe ingresar por lo menos el primer nombre');

          return false;

        }  

	    if(document.getElementById('a1').value==''){

          alert('Debe ingresar por lo menos el primer apellido');

          return false;

        }    

	    if(document.getElementById('cedula').value==''){

          alert('Obligatorio el N� de Cedula');

          return false;

        }  	

		

	    return true;

     }

</script>



</head>



<body>

<div id="contenedor">

<div id="encabezado">

 <h2><?php echo $texto1; ?></h2>

 <h2><?php echo $titulo; ?></h2>

 <h1>PANTALLA DE ADMINISTRADOR</h1>

</div>

 <div id="menu">

 <ul> 

 <li><a href="logout.php">Cerrar Sesion </a></li>

 </ul>

 </div>

 <div id="contenido">

 

 <?php 

 if (isset($_SESSION['cedula'])){

 }

 else

 {

   $usuario = $_POST['usuario'];

   $clave =  $_POST['clave'];

 

   mysql_select_db($database_sle, $sle);

   $sql="SELECT * FROM administradores WHERE  (admin_cedula like '$usuario') AND (admin_clave like '$clave')"; 

   $resultado=mysql_query($sql)or die (mysql_error()); 

   if (mysql_num_rows($resultado) == 0) {

      echo "<center>USUARIO O CONTRASENA INCORRECTOS - Acceso Denegado</center>";

      exit;

   }

   $row = mysql_fetch_row($resultado);



   $_SESSION["cedula"] = $row[0]; 

   $_SESSION["clave"] = $row[1]; 

 

 }

 

 echo "<TABLE>";

 echo "<TR>";

 echo "<TD class='TextoBase'><B>USUARIO ADMINISTRADOR - </B></TD>";

 echo "<TD class='TextoBase'>".$_SESSION['cedula']."</TD>";

 echo "</TR>"; 

 echo "</TABLE>";

 ?>

 

 <h2>USUARIO EN MODO ADMINISTRADOR</h2>

 

 <form id="form1" name="form1" method="post" action="administrador2.php">

   <p>

     <label for="comuna"></label>

     SELECCIONES AREA A CONSULTAR</p>

   <p>

     <select name="comuna" id="comuna">

       <?php

       $sqlCOM="SELECT * FROM comuna"; 

       $resultadoCOM=mysql_query($sqlCOM)or die (mysql_error()); 

       while ($rowCOM = mysql_fetch_row($resultadoCOM)) {

         echo "<option value='$rowCOM[0]'>$rowCOM[1]</option>";

       }

     ?>

     </select>

   </p>

   <p>

     <input type="submit" name="button" id="button" value="Enviar" />

   </p>

 </form>

<div id="footer"><img src="Logos.png" height="140" / HSPACE="20" VSPACE="10"></div>

 <?php echo $creditos; ?>

 </div></div>

 </body>

 </html>