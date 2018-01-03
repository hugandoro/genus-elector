<?php

session_start();

session_destroy();

?>

<?php require_once('parametros.php'); ?>

<?php require_once('Connections/sle.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?php echo $titulo; ?></title>

<link href="estilos.css" rel="stylesheet" type="text/css" />

</head>



<?php

   $pin =  $_GET['pin'];

   $codigo =  $_GET['codigo'];

   $codigo2 =  $_GET['codigo2'];

 

   //VALIDA COINCIDE UNA CEDULA CON EL PIN

   $sqlC="SELECT * FROM pin WHERE (pin_numero like '$pin') AND (pin_estado like '1')"; 

   $resultadoC=mysql_query($sqlC)or die (mysql_error()); 

   $rowC = mysql_fetch_row($resultadoC);

   $numero = mysql_num_rows($resultadoC);

   //*************************************************

   

   $mensaje = "VOTO NO REGISTRADO - ERROR CON EL N� PIN";

   if ($numero != 0) 

   {

     $sql="INSERT INTO votacion (tarjeton1_codigo, pin_numero, tarjeton2_codigo, puesto_numero) VALUES ('$codigo', '$pin', '$codigo2', '$rowC[2]')";	 

     mysql_query($sql)or die (mysql_error());



     $sql="UPDATE pin SET pin_estado = '2' WHERE pin_numero like '$pin'";	 

     mysql_query($sql)or die (mysql_error());

	 

	 $mensaje = "SU VOTO FUE REGISTRADO EXITOSAMENTE, GRACIAS POR PARTICIPAR";

   }

?>



<body>

<div id="contenedor">

<div id="encabezado">

 <h2><?php echo $texto1; ?></h2>

 <h2><?php echo $titulo; ?></h2>

 <h1>VALIDACION DEL VOTO</h1>

</div>

 <div id="menu">

 <ul> 

 <li><a href="index.php">EMPEZAR...</a></li>

 </ul>

 </div>

 <div id="contenido">

 <h2><?php echo $mensaje;?></h2>

 <div id="footer"><img src="Logos.png" / HSPACE="20" VSPACE="10"></div>

  <?php echo $creditos; ?>

 </div></div>

 </body>

 </html>