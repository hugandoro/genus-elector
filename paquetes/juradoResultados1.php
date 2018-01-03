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

 <h1>PANTALLA DE JURADO</h1>

</div>

 <div id="menu">

 <ul> 

 <li><a href="jurado1.php">Volver a Menu Jurado</a></li>

 </ul>

 </div>

 <div id="contenido">

 

 <?php

 echo "<TABLE>";

 echo "<TR>";

 echo "<TD class='TextoBase'><B>JURADO</B></TD>";

 echo "<TD class='TextoBase'>".$_SESSION['usuario']."</TD>";

 echo "</TR>";

 

 echo "<TR>";

 echo "<TD class='TextoBase'><B>PUESTO</B></TD>";

 echo "<TD class='TextoBase'>".$_SESSION['puesto']."</TD>";

 echo "</TR>";

 

 echo "<TR>";

 echo "<TD class='TextoBase'><B>DIRECCION</B></TD>";

 echo "<TD class='TextoBase'>".$_SESSION['puesto_direccion']."</TD>";

 echo "</TR>";

 

 echo "<TR>";

 echo "<TD class='TextoBase'><B>COMUNA</B></TD>";

 echo "<TD class='TextoBase'>".$_SESSION['comuna_nombre']."</TD>";

 echo "</TR>";

 

 echo "</TABLE>";



//VALIDA EL ESTADO DE LA MESA 

   $comuna = $_SESSION["comuna"];

   $puesto = $_SESSION["puesto"];

   $sqlPUE="SELECT * FROM puesto WHERE  (puesto_numero like '$puesto')"; 

   $resultadoPUE=mysql_query($sqlPUE)or die (mysql_error()); 

   $rowPUE = mysql_fetch_row($resultadoPUE); 

   

   $sqlCOM="SELECT * FROM comuna WHERE  (comuna_numero like '$rowPUE[0]')"; 

   $resultadoCOM=mysql_query($sqlCOM)or die (mysql_error()); 

   $rowCOM = mysql_fetch_row($resultadoCOM);

   

   $comuna_estado = $rowCOM[2];

//************************** 

 

  if ($comuna_estado == 1)

    echo "<h2>*** MESA ABIERTA ***</h2>";	

  else	

	echo "<h2>*** MESA CERRADA ***</h2>"; 



  $sqlPIN = "SELECT * FROM pin WHERE puesto_numero = '$puesto'";

  $resultadoPIN = mysql_query($sqlPIN)or die (mysql_error()); 

  $rowPIN = mysql_fetch_row($resultadoPIN); 

  $cantidadPIN = mysql_num_rows($resultadoPIN);

	

  $sqlVOT = "SELECT * FROM votacion WHERE puesto_numero = '$puesto'";

  $resultadoVOT = mysql_query($sqlVOT)or die (mysql_error()); 

  $rowVOT = mysql_fetch_row($resultadoVOT); 

  $cantidadVOT = mysql_num_rows($resultadoVOT);

	

  echo "<TABLE>";	

  echo "<TR><td width='700' bgcolor='#FF9999'><spane class='TextoBase'>TOTAL DE PIN GENERADOS : ".$cantidadPIN."</span></td></TR>";

  echo "<TR><td width='700' bgcolor='#FF9999'><spane class='TextoBase'>TOTAL DE VOTOS REGISTRADOS : ".$cantidadVOT."</span></td></TR>";

  echo "</TABLE>";	 

 

 //MESA CERRADA

 if ($comuna_estado == 0)

 { 

 echo "<BR><BR><h2>TARJETON 1 - $tarjeton1</h2>";



 $sqlC = "SELECT tarjeton1_codigo, COUNT(*) as votos FROM votacion WHERE puesto_numero = '$puesto' GROUP BY tarjeton1_codigo ORDER BY votos DESC";

 $resultadoC = mysql_query($sqlC)or die (mysql_error()); 

  

 echo  "<table>"; 

 echo "<tr><td>N�</td><td>Descripcion</td><td>N� de Votos</td></tr>";

 while ($rowC = mysql_fetch_row($resultadoC)) 

 {

   echo "<tr>";	  

   $sqlPR = "SELECT * FROM tarjeton1 WHERE tarjeton1_codigo = '$rowC[0]'";

   $resultadoPR = mysql_query($sqlPR)or die (mysql_error()); 

   $rowPR = mysql_fetch_row($resultadoPR);

   echo "<td width='100' bgcolor='#FF9999'><spane class='TextoBase'>".$rowPR[3]."</span></td>";

   echo "<td width='700' bgcolor='#FF9999'><spane class='TextoBase'>".$rowPR[1]."</span></td>";

   echo "<td width='700' bgcolor='#FF9999'><spane class='TextoBase'>".$rowC[1]." Votos</span></td>";

   echo "</tr>";

 }

 

  //Para los que no tienen votos

  $sqlV = "SELECT * FROM tarjeton1 WHERE tarjeton1_codigo NOT IN ( SELECT tarjeton1_codigo FROM votacion WHERE puesto_numero = '$puesto')";

  $resultadoV = mysql_query($sqlV)or die (mysql_error()); 

  while ($rowV = mysql_fetch_row($resultadoV)) 

  {

	if ($rowV[2] == $comuna)

	{  

      echo "<tr>";	 

      echo "<td width='100' bgcolor='#FF9999'><spane class='TextoBase'>".$rowV[3]."</span></td>"; 

      echo "<td width='700' bgcolor='#FF9999'><spane class='TextoBase'>".$rowV[1]."</span></td>";

      echo "<td width='700' bgcolor='#FF9999'><spane class='TextoBase'>0 Votos</span></td>";

      echo "</tr>";

	}

  }  

 

 echo  "</table>";

 

?>

 

<?php

 echo "<BR><BR><h2>TARJETON 2 - $tarjeton2</h2>";

 $sqlC = "SELECT tarjeton2_codigo, COUNT(*) as votos FROM votacion WHERE puesto_numero = '$puesto' GROUP BY tarjeton2_codigo ORDER BY votos DESC";

 $resultadoC = mysql_query($sqlC)or die (mysql_error()); 

  

 echo  "<table>";

 echo "<tr><td>N�</td><td>Descripcion</td><td>N� de Votos</td></tr>";

 while ($rowC = mysql_fetch_row($resultadoC)) 

 {

   echo "<tr>";	  

   $sqlPR = "SELECT * FROM tarjeton2 WHERE tarjeton2_codigo = '$rowC[0]'";

   $resultadoPR = mysql_query($sqlPR)or die (mysql_error()); 

   $rowPR = mysql_fetch_row($resultadoPR);

   echo "<td width='100' bgcolor='#FF9999'><spane class='TextoBase'>".$rowPR[3]."</span></td>";

   echo "<td width='700' bgcolor='#FF9999'><spane class='TextoBase'>".$rowPR[1]."</span></td>";

   echo "<td width='700' bgcolor='#FF9999'><spane class='TextoBase'>".$rowC[1]." Votos</span></td>";

   echo "</tr>";

 }

  //Para los que no tienen votos

  $sqlV = "SELECT * FROM tarjeton2 WHERE tarjeton2_codigo NOT IN ( SELECT tarjeton2_codigo FROM votacion WHERE puesto_numero = '$puesto')";

  $resultadoV = mysql_query($sqlV)or die (mysql_error()); 

  while ($rowV = mysql_fetch_row($resultadoV)) 

  {

	if ($rowV[2] == $comuna)

	{  

      echo "<tr>";	  

      echo "<td width='100' bgcolor='#FF9999'><spane class='TextoBase'>".$rowV[3]."</span></td>"; 

      echo "<td width='700' bgcolor='#FF9999'><spane class='TextoBase'>".$rowV[1]."</span></td>";

      echo "<td width='700' bgcolor='#FF9999'><spane class='TextoBase'>0 Votos</span></td>";

      echo "</tr>";

	}

  } 

 

 echo  "</table>";

 } 

//****FIN MESA CERRADA



  echo "<BR>*** Informe generado el ".date("d/m/Y")." siendo las ".date("G:i:s")." ***";

 

 ?>



   <div id="footer"><img src="Logos.png" / HSPACE="20" VSPACE="10"></div>

 <?php echo $creditos; ?>

 </div></div>

 </body>

 </html>