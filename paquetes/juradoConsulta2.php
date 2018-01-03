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

</head>



<body>

<div id="contenedor">

<div id="encabezado">

 <h2><?php echo $texto1; ?></h2>

 <h2><?php echo $titulo; ?></h2>

 <h1>PANTALLA DE JURADO</h1>

</div>

 <div id="menu">

 <ul> 

 <li><a href="jurado1.php">Volver a Menu Jurado</a></li>

 </ul>

 </div>

 <div id="contenido">

 

 <?php

  //Consulta por N� PIN

  if (isset($_POST['pin'])){

   $pin = $_POST['pin'];

   $sqlC="SELECT * FROM pin WHERE pin_numero like '$pin'"; 

 }

 //Consulta por N� de Cedula

  if (isset($_POST['cedula'])){

   $cedula = $_POST['cedula'];

   $sqlC="SELECT * FROM pin WHERE ciudadano_cedula like '$cedula'"; 

 }



 $resultadoC=mysql_query($sqlC)or die (mysql_error()); 

 $rowC = mysql_fetch_row($resultadoC);

 

 $numero = mysql_num_rows($resultadoC);

 

 if ($numero != 0)

 {

   $pin_numero = $rowC[0];

   $pin_cedula = $rowC[1];

   $pin_estado = $rowC[6];

   

   $sqlCIU="SELECT * FROM ciudadano WHERE  (ciudadano_cedula like '$pin_cedula')"; 

   $resultadoCIU=mysql_query($sqlCIU)or die (mysql_error()); 

   $rowCIU = mysql_fetch_row($resultadoCIU);   



   $pin_N1 = $rowCIU[1];

   $pin_N2 = $rowCIU[2];

   $pin_A1 = $rowCIU[3];

   $pin_A2 = $rowCIU[4];

   

   echo "<TABLE>";

   echo "<TR>";

   echo "<TD><h2>CIUDADANO</h2></TD>";

   echo "<TD class='TextoBase'>$pin_N1 $pin_N2 $pin_A1 $pin_A2</TD>";

   echo "</TR>";

 

   echo "<TR>";

   echo "<TD><h2>CEDULA</h2></TD>";

   echo "<TD class='TextoBase'>$pin_cedula</TD>";

   echo "</TR>";

 

   echo "<TR>";

   echo "<TD><h2>PIN</h2></TD>";

   echo "<TD class='TextoBase'><h1>$pin_numero</h1></TD>";

   echo "</TR>";

   

   echo "<TR>";

   echo "<TD><h2>ESTADO</h2></TD>";

   if ($pin_estado == 1)

     echo "<TD class='TextoBase'><h1>PIN ASIGNADO SIN USAR</h1></TD>";

   if ($pin_estado == 2)

     echo "<TD class='TextoBase'><h1>PIN ASIGNADO Y USADO</h1></TD>";

   echo "</TR>";

 

   echo "</TABLE>";

 }

 else

 {

   echo "<TABLE>";

   echo "<TR>";

   echo "<TD><h2>NO SE ENCONTRARON DATOS EN EL SISTEMA</h2></TD>";

   echo "<TD class='TextoBase'></TD>";

   echo "</TR>";

   echo "</TABLE>";

 }

 ?>

 

   <div id="footer"><img src="Logos.png" height="140" / HSPACE="20" VSPACE="10"></div>

 <?php echo $creditos; ?>

 </div></div>

 </body>

 </html>