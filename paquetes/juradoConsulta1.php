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



 ?>

 

 <h2>CONSULTAR  CEDULA ASIGNADA A ESTE N&deg; DE PIN</h2>

 <form id="form1" name="form1" method="post" onsubmit="return noespacios()" action="juradoConsulta2.php">

   <table width="750" border="0">

     <tr>

       <td width="100" class="TextoBase">PIN N&deg;</td>

       <td width="640"><input type="text" name="pin" id="pin" onkeypress="return acceptNum(event)"/></td>

     </tr>

     <tr>

       <td>&nbsp;</td>

       <td>&nbsp;</td>

     </tr>

     <tr>

       <td>&nbsp;</td>

       <td><input type="submit" name="Continuar4" id="Continuar4" value="CONSULTAR" /></td>

     </tr>

   </table>

 </form>

  <h2>CONSULTAR N&deg; DE PIN ASGINADO A ESTA CEDULA</h2>

 <form id="form1" name="form1" method="post" onsubmit="return noespacios()" action="juradoConsulta2.php">

   <table width="750" border="0">

     <tr>

       <td width="100" class="TextoBase">CEDULA N&deg;</td>

       <td width="640"><input type="text" name="cedula" id="cedula" onkeypress="return acceptNum(event)"/></td>

     </tr>

     <tr>

       <td>&nbsp;</td>

       <td>&nbsp;</td>

     </tr>

     <tr>

       <td>&nbsp;</td>

       <td><input type="submit" name="Continuar4" id="Continuar4" value="CONSULTAR" /></td>

     </tr>

   </table>

 </form>

   <div id="footer"><img src="Logos.png" / HSPACE="20" VSPACE="10"></div>

 <?php echo $creditos; ?>

 </div></div>

 </body>

 </html>