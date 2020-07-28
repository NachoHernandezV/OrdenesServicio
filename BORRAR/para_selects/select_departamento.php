<?php
	/*archivo para Arrancar los datos de ETAPAS al inicio, solo se ejecuta al abrir o actualizar*/
			date_default_timezone_set('America/Monterrey');
			$con = mysqli_connect('localhost', 'root', 'pirineos', 'ordenes');


			$sql5="SELECT * FROM departamentos";
			$resultad=mysqli_query($con,$sql5);

			while($row2 = mysqli_fetch_array($resultad))
			{
				echo '<option value="'.$row2['id'].'">'.$row2['departamento'].'</option>';
			}
?>