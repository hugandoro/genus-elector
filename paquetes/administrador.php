<?php

session_start();

session_destroy();

?>

<?php require_once('parametros.php'); ?>

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

 <li><a href="index.php">Modo Votacion</a></li>

 </ul>

 </div>

 <div id="contenido">

 <h2>VALIDADCION DE INGRESO COMO ADMINISTRADOR</h2>

 <form id="form1" name="form1" method="post" action="administrador1.php">

   <table width="300" border="0">

     <tr>

       <td class="TextoBase">Usuario</td>

       <td><input type="text" name="usuario" id="usuario" onkeypress="return acceptNum(event)"/></td>

     </tr>

     <tr>

       <td class="TextoBase">Contrase&ntilde;a</td>

       <td><input type="password" name="clave" id="clave" /></td>

     </tr>

     <tr>

       <td>&nbsp;</td>

       <td>&nbsp;</td>

     </tr>

     <tr>

       <td>&nbsp;</td>

       <td><input type="submit" name="Continuar4" id="Continuar4" value="INGRESAR" /></td>

     </tr>

   </table>

 </form>

   <div id="footer"><img src="Logos.png" / HSPACE="20" VSPACE="10"></div>

 <?php echo $creditos; ?>

 </div></div>

 </body>

 </html>