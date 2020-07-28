<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADMINISTRADOR</title>
<META HTTP-EQUIV="REFRESH" CONTENT="18000;URL=principal.php">
</head>
<style type="text/css">
.boton2 {
	-moz-box-shadow:inset 0px 1px 0px 0px #9acc85;
	-webkit-box-shadow:inset 0px 1px 0px 0px #9acc85;
	box-shadow:inset 0px 1px 0px 0px #9acc85;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #7bb876), color-stop(1, #68a54b));
	background:-moz-linear-gradient(top, #7bb876 5%, #68a54b 100%);
	background:-webkit-linear-gradient(top, #7bb876 5%, #68a54b 100%);
	background:-o-linear-gradient(top, #7bb876 5%, #68a54b 100%);
	background:-ms-linear-gradient(top, #7bb876 5%, #68a54b 100%);
	background:linear-gradient(to bottom, #7bb876 5%, #68a54b 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#7bb876', endColorstr='#68a54b',GradientType=0);
	background-color:#7bb876;
	border:1px solid #86bd6a;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:11px;
	font-weight:bold;
	padding:3px 11px;
	text-decoration:none;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #68a54b), color-stop(1, #7bb876));
	background:-moz-linear-gradient(top, #68a54b 5%, #7bb876 100%);
	background:-webkit-linear-gradient(top, #68a54b 5%, #7bb876 100%);
	background:-o-linear-gradient(top, #68a54b 5%, #7bb876 100%);
	background:-ms-linear-gradient(top, #68a54b 5%, #7bb876 100%);
	background:linear-gradient(to bottom, #68a54b 5%, #7bb876 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#68a54b', endColorstr='#7bb876',GradientType=0);
	background-color:#68a54b;
}
.myButton:active {
	position:relative;
	top:1px;
}

  .boton{
        font-size:10px;
        font-family:Verdana,Helvetica;
        font-weight:bold;
        color:white;
        background:#0B3B17;
        border:0px;
        width:70px;
        height:19px;
       }
</style>
<body style="background:#FFFFFF">
<div align="center">
<img src="logo1.png" alt="Este es el ejemplo de un texto alternativo" width="350" height="320">
<br>
<br>
<table>
	<form action="autovalidar_new.php" method="POST">

		<tr>
			<td colspan="2" ALIGN=CENTER>
			<font size=4 face="verdana" style="color:#0B1907">Respaldos Manuales o Automaticos</font>
			</td>
		</tr>
		<tr>
			<td colspan="2" ALIGN=CENTER>
			<font size=4 face="verdana" style="color:#0B1907">&nbsp</font>
			</td>
		</tr>
		<tr>
			<td ALIGN=RIGHT><font size=2 face="verdana" style="color:#44822F">Indicadores</font></td>
			<td ALIGN=LEFT>
			<input type="submit" value="Calificar" name="Calificar" id="Calificar" class="boton2"></td>
		</tr>
		
	</form>
</table>
</div>


<?php

date_default_timezone_set("America/Mexico_City");
//recibir los datos
$Calificar = $_POST["Calificar"];

echo "SE VALIDO DESDE ".gethostname();
if($Calificar=="Calificar")
{
	$user="root";
	$pass="pirineos";
	$server="localhost";
	$bd="ordenes";
	$con=mysqli_connect($server,$user,$pass,$bd);
	//mysqli_set_charset($con,'utf8');

	$contador=0;
	$sql5="SELECT * FROM `orden1_sistemas` WHERE estado='Incompleto'";
	$resultad=mysqli_query($con,$sql5);
	while($consulta = mysqli_fetch_array($resultad))
	{

		 /*ACTUALIZAR EL DE ORDENES  */
		 $sql = "UPDATE orden1_sistemas SET estado = 'Completo' WHERE folio = '".$consulta['folio']."'";
		 mysqli_query($con,$sql);

		 $nombrePC=gethostname();
		 /*Insertamos en la tabla de revision del USUARIO*/
		 $solicitud_sin_validar="INSERT INTO revisionusuario (folio,calificacion,comentarios,computadora) VALUES ('".$consulta['folio']."','Sin Calificar','','$nombrePC')";
		 mysqli_query($con,$solicitud_sin_validar);

		 $contador=$contador+1;

	}
	echo "LAS ORDENES QUE SE VALIDARON FUERON = ".$contador;

}



?>

</body>
</html>
