<?php require_once('Connections/sle.php'); ?>

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

</head>



<body>



 <?php

   $cedula = $_POST['cedula'];

   $pin =  $_POST['pin'];

   

   //VALIDA COINCIDE UNA CEDULA CON EL PIN

   $sqlC="SELECT * FROM pin WHERE  (ciudadano_cedula like '$cedula') AND (pin_numero like '$pin') AND (pin_estado like '1')"; 

   $resultadoC=mysql_query($sqlC)or die (mysql_error()); 

   $rowC = mysql_fetch_row($resultadoC);

 

   $numero = mysql_num_rows($resultadoC);

   //*************************************************

 

   $comuna_nombre = "";

   if ($numero != 0)

   {	  

     $sqlCIU="SELECT * FROM ciudadano WHERE  (ciudadano_cedula like '$cedula')"; 

     $resultadoCIU=mysql_query($sqlCIU)or die (mysql_error()); 

     $rowCIU = mysql_fetch_row($resultadoCIU);

	 $ciudadano_nombre = $rowCIU[1]." ".$rowCIU[2]." ".$rowCIU[3]." ".$rowCIU[4];    

   

     $sqlP="SELECT * FROM puesto WHERE  (puesto_numero like '$rowC[2]')"; 

     $resultadoP=mysql_query($sqlP)or die (mysql_error()); 

     $rowP = mysql_fetch_row($resultadoP);

   

     $sqlCO="SELECT * FROM comuna WHERE  (comuna_numero like '$rowP[0]')"; 

     $resultadoCO=mysql_query($sqlCO)or die (mysql_error()); 

     $rowCO = mysql_fetch_row($resultadoCO);

     $comuna_nombre = $rowCO[1];

	 $comuna_estado = $rowCO[2];

   

     $sqlPR="SELECT * FROM tarjeton1 WHERE  (comuna_numero like '$rowCO[0]')"; 

     $resultadoPR=mysql_query($sqlPR)or die (mysql_error()); 

   }

 ?>



<div id="contenedor">

<div id="encabezado">

 <h2><?php echo $texto1; ?></h2>

 <h2><?php echo $titulo; ?></h2>

<h1><?php echo $comuna_nombre;?></h1>

</div>

 <div id="menu">

 <ul> 

 <li><a href="index.php">Volver a iniciar</a></li>

 </ul>

 </div>

 <div id="contenido">

 

 <?php

 if ($numero == 0)

   {

	 echo "<span class='TextoBase'>NO EXISTE UN PIN HABILITADO A ESTA CEDULA</span>";

	 exit;

   }

 ?>

 

 <?php echo "<spane class='TextoBase'>Estimado $ciudadano_nombre</span>"; ?>

 <h1><?php echo $tarjeton1; ?></h1>



<?php

  //MESA ABIERTA

  if ($comuna_estado == 1)

  {

?>



 <table>

  <?php while ($rowPR = mysql_fetch_row($resultadoPR)) {

   echo "<tr>";	  

   echo "<td width='50' bgcolor='#ffffff'><span class='NUMERO'>".$rowPR[3]."</span></td>";

   echo "<td width='100' bgcolor='#000000'><CENTER><img src='Fotos/".$rowPR[0].".jpg' width='75' height='100' /></CENTER></td>";

   echo "<td width='700' bgcolor='#ffffff'><span class='TextoBase'>".$rowPR[1]."</span></td>";

   //echo "<td width='100' bgcolor='#ffffff'><p><a href='votar00.php?pin=$pin&codigo=$rowPR[0]&cedula=$cedula'><input type='submit' name='Continuar' id='Continuar' value='VOTAR' /></a></p></td>";

   echo "<td width='100' bgcolor='#ffffff'><p><a href='votar1.php?pin=$pin&codigo=$rowPR[0]&codigo2=0'><input type='submit' name='Continuar' id='Continuar' value='VOTAR' /></a></p></td>";

   echo "</tr>";	

   echo "<tr><td colspan='3'><HR></td></tr>"; 

  } 

  ?>

  </table>

  

<?php

  }

  //MESA CERRADA

  else

  {

	echo "<TABLE><TR><td>*** MESA CERRADA ***</td></TR></TABLE>";	  

  }

?>



   <div id="footer"><img src="Logos.png" / HSPACE="20" VSPACE="10"></div>

 <?php echo $creditos; ?>

 </div></div>

 </body>

 </html>