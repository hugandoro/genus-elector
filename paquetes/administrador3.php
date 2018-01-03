<?php
 $currentPage = $_SERVER["PHP_SELF"];
 session_start();
?>
<?php require_once('parametros.php'); ?>
<?php require_once('Connections/sle.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

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
 <li><a href="administrador2.php">Seleccionar Puesto</a></li>
 </ul>
 </div>
 <div id="contenido">
 
 <?php 
   $usuario = $_SESSION['cedula'];
   $clave = $_SESSION['clave'];
   $comuna = $_SESSION['comuna'];
   $_SESSION['puesto'] = $_POST['puesto'];
   
   $puesto = $_SESSION['puesto'];
 
   mysql_select_db($database_sle, $sle);
   $sql="SELECT * FROM administradores WHERE  (admin_cedula like '$usuario') AND (admin_clave like '$clave')"; 
   $resultado=mysql_query($sql)or die (mysql_error()); 
   if (mysql_num_rows($resultado) == 0) {
      echo "<center>USUARIO O CONTRASENA INCORRECTOS - Acceso Denegado</center>";
      exit;
   } 
 
 echo "<TABLE>";
 echo "<TR>";
 echo "<TD class='TextoBase'><B>USUARIO ADMINISTRADOR - </B></TD>";
 echo "<TD class='TextoBase'>".$usuario."</TD>";
 echo "</TR>"; 
 echo "</TABLE>";
 ?>
 
 <h2>USUARIO EN MODO ADMINISTRADOR</h2>
 
  <?php 
  $sqlCOM="SELECT * FROM comuna WHERE comuna_numero='$comuna'"; 
  $resultadoCOM=mysql_query($sqlCOM)or die (mysql_error()); 
  $rowCOM = mysql_fetch_row($resultadoCOM);
  echo "<B>$rowCOM[1]</B><BR>";
  
  $sqlPU="SELECT * FROM puesto WHERE puesto_numero='$puesto'"; 
  $resultadoPU=mysql_query($sqlPU)or die (mysql_error()); 
  $rowPU = mysql_fetch_row($resultadoPU);
  echo "<B>Puesto $rowPU[1] - $rowPU[2]</B>";
  
  //*******PROYECTOS
  $sqlC = "SELECT tarjeton1_codigo, COUNT(*) as votos FROM votacion WHERE puesto_numero = '$puesto' GROUP BY tarjeton1_codigo ORDER BY votos DESC";
  $resultadoC = mysql_query($sqlC)or die (mysql_error()); 
 
  echo "<h2>PROYECTOS 2017</h2>"; 
  echo  "<table>";
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
  
  //********DELEGADOS
  $sqlC = "SELECT tarjeton2_codigo, COUNT(*) as votos FROM votacion WHERE puesto_numero = '$puesto' GROUP BY tarjeton2_codigo ORDER BY votos DESC";
  $resultadoC = mysql_query($sqlC)or die (mysql_error()); 
  
  echo "<h2>PROYECTOS 2017</h2>";
  echo  "<table>";
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
  
  echo "<BR>*** Informe generado el ".date("d/m/Y")." siendo las ".date("G:i:s")." ***";
  //**********
  
  ?>

<div id="footer"><img src="Logos.png" height="140" / HSPACE="20" VSPACE="10"></div>
 <?php echo $creditos; ?>
 </div></div>
 </body>
 </html>