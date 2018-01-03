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
	    if(document.getElementById('genero').value==''){
          alert('Obligatorio el Campo Genero');
          return false;
        }  	
	    if(document.getElementById('edad').value==''){
          alert('Obligatorio el Campo Edad');
          return false;
        }  	
	    if(document.getElementById('tipo').value==''){
          alert('Obligatorio el Campo Tipo');
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
 <li><a href="logout.php">Cerrar Sesion </a></li>
 <li><a href="juradoConsulta1.php">Consultar PIN </a></li>
 <li><a href="juradoResultados1.php">Resultados    </a></li>
 </ul>
 </div>
 <div id="contenido">
 
 <?php 
 if (isset($_SESSION['nivel'])){
 }
 else
 {
   $usuario = $_POST['usuario'];
   $clave =  $_POST['clave'];
 
   mysql_select_db($database_sle, $sle);
   $sql="SELECT * FROM jurado WHERE  (jurado_cedula like '$usuario') AND (jurado_clave like '$clave')"; 
   $resultado=mysql_query($sql)or die (mysql_error()); 
   if (mysql_num_rows($resultado) == 0) {
      echo "<center>USUARIO O CONTRASENA INCORRECTOS - Acceso Denegado</center>";
      exit;
   }
   $row = mysql_fetch_row($resultado);
   if ($row[7] == 0) { //USUARIO EXISTE PERO ESTA INACTIVO EN EL SISTEMA
      echo "<center>USUARIO INACTIVO EN EL SISTEMA - Acceso Denegado</center>";
      exit;
   }

   $_SESSION["nivel"] = $row[7];
   $_SESSION["cedula"] = $row[0]; 
   $_SESSION["usuario"] = $row[1]." ".$row[2]." ".$row[3]." ".$row[4];
   $_SESSION["puesto"] = $row[8]; 
 
   $sqlP="SELECT * FROM puesto WHERE  (puesto_numero like '$row[8]')"; 
   $resultadoP=mysql_query($sqlP)or die (mysql_error()); 
   $rowP = mysql_fetch_row($resultadoP);

   $_SESSION["puesto_direccion"] = $rowP[2];
   $_SESSION["comuna"] = $rowP[0];
 
   $sqlC="SELECT * FROM comuna WHERE  (comuna_numero like '$rowP[0]')"; 
   $resultadoC=mysql_query($sqlC)or die (mysql_error()); 
   $rowC = mysql_fetch_row($resultadoC);
 
   $_SESSION["comuna_nombre"] = $rowC[1];
 }
 
//VALIDA EL ESTADO DE LA MESA 
   $puesto = $_SESSION["puesto"];
   $sqlPUE="SELECT * FROM puesto WHERE  (puesto_numero like '$puesto')"; 
   $resultadoPUE=mysql_query($sqlPUE)or die (mysql_error()); 
   $rowPUE = mysql_fetch_row($resultadoPUE); 
   
   $sqlCOM="SELECT * FROM comuna WHERE  (comuna_numero like '$rowPUE[0]')"; 
   $resultadoCOM=mysql_query($sqlCOM)or die (mysql_error()); 
   $rowCOM = mysql_fetch_row($resultadoCOM);
   
   $comuna_estado = $rowCOM[2];
//*************************** 
 
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

 ?>
 
 <h2>DATOS DEL CIUDADANO</h2>
 <form id="form1" name="form1" method="post" onsubmit="return noespacios()" action="jurado2.php">
   <table width="750" border="0">
     <tr>
       <td width="83" class="TextoBase">Cedula</td>
       <td width="657"><input type="text" name="cedula" id="cedula" onkeypress="return acceptNum(event)"/></td>
     </tr>
     <tr>
       <td class="TextoBase">Nombres</td>
       <td><input name="n1" type="text" id="n1" size="12" onkeyup="this.value=this.value.toUpperCase()"/>
         <input name="n2" type="text" id="n2" size="12" onkeyup="this.value=this.value.toUpperCase()"/></td>
     </tr>
    <tr>
       <td class="TextoBase">Apellidos</td>
       <td><input name="a1" type="text" id="a1" size="12" onkeyup="this.value=this.value.toUpperCase()"/>
         <input name="a2" type="text" id="a2" size="12" onkeyup="this.value=this.value.toUpperCase()"/></td>
     </tr>
     <tr>
       <td class="TextoBase">Genero</td>
       <td><label for="genero"></label>
         <select name="genero" class="TextoBase" id="genero">
           <option value="M" selected="selected">Masculino</option>
           <option value="F">Femenino</option>
           <option value="L">LGTBI</option>
         </select></td>
     </tr>
     <tr>
       <td class="TextoBase">Edad</td>
       <td><input type="text" name="edad" id="edad" onkeypress="return acceptNum(event)"/></td>
     </tr>
     <tr>
       <td class="TextoBase">Estudio</td>
       <td><select name="tipo" class="TextoBase" id="tipo">
         <option value="Sin estudio">Sin estudio</option>
         <option value="Primaria">Primaria</option>
         <option value="Secundaria" selected="selected">Secundaria</option>
         <option value="Tecnico">Tecnico</option>
         <option value="Profesional">Profesional</option>
       </select></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <?php
	   if ($comuna_estado == 1)
         echo "<td><input type='submit' name='Continuar4' id='Continuar4' value='GENERAR PIN DE VOTACION'/></td>";
	   else
         echo "<td>*** MESA CERRADA ***</td>";	   
	   ?>
     </tr>
   </table>
 </form>
   <div id="footer"><img src="Logos.png" / HSPACE="20" VSPACE="10"></div>
   <?php echo $creditos; ?>
 </div></div>
 </body>
 </html>