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
 <h1><?php echo $texto2; ?></h1>
</div>
 <div id="contenido">
   <form id="form1" name="form1" method="post" action="votar0.php">
     <label for="cedula"></label>
     <h2>DIGITE SU NUMERO DE CEDULA</h2>
 <p>
   <input type="text" name="cedula" id="cedula" onkeypress="return acceptNum(event)"/>
 </p>
 <h2>DIGITE EL NUMERO PIN ASIGNADO</h2>
 <p>
   <input type="text" name="pin" id="pin" onkeypress="return acceptNum(event)"/>
 </p>
 <p>&nbsp;</p>
   <p>
     <input type="submit" name="Continuar4" id="Continuar4" value="CONTINUAR" />
 </p>
 </form>
   <div id="footer"><img src="Logos.png" / HSPACE="20" VSPACE="10"></div>
 <?php echo $creditos; ?>
 </div></div>
 </body>
 </html>