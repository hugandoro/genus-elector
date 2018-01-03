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

      <li><a href="jurado1.php">Volver al Inicio</a></li>

    </ul>

  </div>

  <div id="contenido">

    <?php

 $usuario = $_POST['cedula'];

 $n1 =  $_POST['n1'];

 $n2 =  $_POST['n2'];

 $a1 =  $_POST['a1'];

 $a2 =  $_POST['a2'];

 $genero =  $_POST['genero'];

 $edad =  $_POST['edad'];

 $tipo =  $_POST['tipo'];

 

 //VALIDA SI EXISTE UNA CEDULA CON EL PIN ACTIVO

 $sqlC="SELECT * FROM pin WHERE  (ciudadano_cedula like '$usuario') AND (pin_estado like '1')"; 

 $resultadoC=mysql_query($sqlC)or die (mysql_error()); 

 $rowC = mysql_fetch_row($resultadoC);

 

 $numero = mysql_num_rows($resultadoC);

 

 if ($numero != 0)

 {

	 echo "<span class='TextoBase'>LA CEDULA </span><h2><b>$usuario</b></h2><span class='TextoBase'> TIENE EL PIN </span><h2><b>$rowC[0]</b></h2><span class='TextoBase'> ACTIVO EN EL SISTEMA</span>";

	 exit;

 }

 //*************************************************

 

  //VALIDA SI EXISTE UNA CEDULA CON EL PIN YA USADO

 $sqlC="SELECT * FROM pin WHERE  (ciudadano_cedula like '$usuario') AND (pin_estado like '2')"; 

 $resultadoC=mysql_query($sqlC)or die (mysql_error()); 

 $rowC = mysql_fetch_row($resultadoC);

 

 $numero = mysql_num_rows($resultadoC);

 

 if ($numero != 0)

 {

	 echo "<span class='TextoBase'>LA CEDULA </span><h2><b>$usuario</b></h2><span class='TextoBase'> TIENE UN PIN QUE YA FUE UTILIZADO</span>";

	 exit;

 }

 //*************************************************

 

 

//VALIDA EL ESTADO DE LA MESA 

   $puesto = $_SESSION["puesto"];

   $sqlPUE="SELECT * FROM puesto WHERE  (puesto_numero like '$puesto')"; 

   $resultadoPUE=mysql_query($sqlPUE)or die (mysql_error()); 

   $rowPUE = mysql_fetch_row($resultadoPUE); 

   

   $sqlCOM="SELECT * FROM comuna WHERE  (comuna_numero like '$rowPUE[0]')"; 

   $resultadoCOM=mysql_query($sqlCOM)or die (mysql_error()); 

   $rowCOM = mysql_fetch_row($resultadoCOM);

   

   $comuna_estado = $rowCOM[2];

//**************************

  

 //MESA ABIERTA

 if ($comuna_estado == 1)

 {

	 

 $sqlC="SELECT * FROM ciudadano WHERE  (ciudadano_cedula like '$usuario')";

 $resultadoC=mysql_query($sqlC)or die (mysql_error()); 

 $rowC = mysql_fetch_row($resultadoC);

 $numero = mysql_num_rows($resultadoC);

 

//UNA VEZ VERIFICADO EL ESTADO DEL PIN VERIFICA SI EL CIUDADANO ESTA REGISTRADO 

 if ($numero != 0) // YA EXISTE LO ACTUALIZA

 {

   $sql="UPDATE ciudadano SET ciudadano_nombre1 = '$n1', ciudadano_nombre2 = '$n2', ciudadano_apellido1 = '$a1', ciudadano_apellido2 = '$a2', ciudadano_genero = '$genero', ciudadano_edad = '$edad', ciudadano_tipo = '$tipo' WHERE ciudadano_cedula like '$usuario'";	 

   mysql_query($sql)or die (mysql_error());

 }

 else  // NO EXISTE LO INSERTA

 {

   $sql="INSERT INTO ciudadano (ciudadano_cedula, ciudadano_nombre1, ciudadano_nombre2, ciudadano_apellido1, ciudadano_apellido2, ciudadano_genero, ciudadano_edad, ciudadano_tipo) VALUES ('$usuario', '$n1', '$n2', '$a1', '$a2', '$genero', '$edad', '$tipo')";	 

   mysql_query($sql)or die (mysql_error());

 }

//*****************************************************************************

 

//GENERA EL NUMERO PIN 

 $sql="INSERT INTO pin (ciudadano_cedula, puesto_numero, jurado_cedula, pin_estado) VALUES ('$usuario', '".$_SESSION["puesto"]."', '".$_SESSION["cedula"]."', '1')";	 

 mysql_query($sql)or die (mysql_error());	

//******************** 



 $sqlC="SELECT * FROM pin WHERE  (ciudadano_cedula like '$usuario') AND (pin_estado like '1')"; 

 $resultadoC=mysql_query($sqlC)or die (mysql_error()); 

 $rowC = mysql_fetch_row($resultadoC);

 $pin = $rowC[0]; 

 

 echo "<TABLE>";

 echo "<TR>";

 echo "<TD><h2>CIUDADANO</h2></TD>";

 echo "<TD class='TextoBase'>$n1 $n2 $a1 $a2</TD>";

 echo "</TR>";

 

 echo "<TR>";

 echo "<TD><h2>CEDULA</h2></TD>";

 echo "<TD class='TextoBase'>$usuario</TD>";

 echo "</TR>";

 

 echo "<TR>";

 echo "<TD><h2>PIN</h2></TD>";

 echo "<TD class='TextoBase'><h1>$pin</h1></TD>";

 echo "</TR>";

 

 echo "</TABLE>";



 }

 //MESA CERRADA

 else

 {

   echo "<TABLE><TR><td>*** MESA CERRADA ***</td></TR></TABLE>";	  

 }

 ?>

    <form id="form1" name="form1" method="post" action="">

    </form>

    <div id="footer"><img src="Logos.png" height="140" / HSPACE="20" VSPACE="10"></div>

  </div>

 <?php echo $creditos; ?>

</div>

</body>

</html>