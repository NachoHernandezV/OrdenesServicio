<?php
//Incluimos librería y archivo de conexión
	require 'Classes/PHPExcel.php';

	//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();

	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("Ignacio Hernandez")->setDescription("Reporte de Sistemas");

	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("Reporte de Sistemas");


	/*MODULO DE RECEPCION DE DATOS*/
	date_default_timezone_set('America/Mexico_City');
	$link=mysqli_connect("localhost", "root", "pirineos", "ordenes");

	$mes=$_POST["mes"];
	$anio=$_POST["anio"];

	/*FIN DEL MODULO DE RECEPCION*/

	$estiloTituloReporte = array(
    'font' => array(
	'name'      => 'Arial',
	'bold'      => true,
	'italic'    => false,
	'strike'    => false,
	'size' =>13
	),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_NONE
	)
    ),
    'alignment' => array(
	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	);

	$estilofirmas = array(
		'font' => array(
		'name'      => 'Calibri',
		'bold'      => false,
		'italic'    => false,
		'strike'    => false,
		'size' =>12
		),
		'borders' => array(
		'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_NONE
		)
		),
		'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		)
		);

	$nombresytitulos= array(
		'font' => array(
		'name'      => 'Calibri',
		'bold'      => true,
		'italic'    => false,
		'strike'    => false,
		'size' =>12
		)
		);


		/*PONER LOS DATOS ESTATICOS */

	$objPHPExcel->getActiveSheet()->getStyle('A2:H3')->applyFromArray($estiloTituloReporte);


	$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Reporte de actividades realizadas del mes de');
	$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
	$objPHPExcel->getActiveSheet()->setCellValue('A3',$mes.' '.$anio);
	$objPHPExcel->getActiveSheet()->mergeCells('A3:H3');

	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($nombresytitulos);
	$objPHPExcel->getActiveSheet()->setCellValue('C6', 'Christian Zavala');
	$objPHPExcel->getActiveSheet()->setCellValue('C7', 'Numero de Ordenes');
	$objPHPExcel->getActiveSheet()->setCellValue('C8', 'Tiempo (Hrs)');
	$objPHPExcel->getActiveSheet()->setCellValue('C9', 'Ordenes fuera de tiempo');

	$objPHPExcel->getActiveSheet()->getStyle('C12')->applyFromArray($nombresytitulos);
	$objPHPExcel->getActiveSheet()->setCellValue('C12', 'Jaqueline Flores');
	$objPHPExcel->getActiveSheet()->setCellValue('C13', 'Numero de Ordenes');
	$objPHPExcel->getActiveSheet()->setCellValue('C14', 'Tiempo (Hrs)');
	$objPHPExcel->getActiveSheet()->setCellValue('C15', 'Ordenes fuera de tiempo');

	$objPHPExcel->getActiveSheet()->getStyle('C18')->applyFromArray($nombresytitulos);
	$objPHPExcel->getActiveSheet()->setCellValue('C18', 'Jose Ignacio Hernandez');
	$objPHPExcel->getActiveSheet()->setCellValue('C19', 'Numero de Ordenes');
	$objPHPExcel->getActiveSheet()->setCellValue('C20', 'Tiempo (Hrs)');
	$objPHPExcel->getActiveSheet()->setCellValue('C21', 'Ordenes fuera de tiempo');

	$objPHPExcel->getActiveSheet()->getStyle('C24')->applyFromArray($nombresytitulos);
	$objPHPExcel->getActiveSheet()->setCellValue('C24', 'Victor Orozco');
	$objPHPExcel->getActiveSheet()->setCellValue('C25', 'Numero de Ordenes');
	$objPHPExcel->getActiveSheet()->setCellValue('C26', 'Tiempo (Hrs)');
	$objPHPExcel->getActiveSheet()->setCellValue('C27', 'Ordenes fuera de tiempo');


	$objPHPExcel->getActiveSheet()->getStyle('C30')->applyFromArray($nombresytitulos);
	$objPHPExcel->getActiveSheet()->setCellValue('C30', 'Reporte Final');
	$objPHPExcel->getActiveSheet()->setCellValue('C31', 'Nivel de cumplimiento');
	$objPHPExcel->getActiveSheet()->setCellValue('C32', 'Ordenes Totales');
	$objPHPExcel->getActiveSheet()->setCellValue('C33', 'Tiempo Total (Hrs)');
	$objPHPExcel->getActiveSheet()->setCellValue('C34', 'Desarrollo de Software');
	$objPHPExcel->getActiveSheet()->setCellValue('C35', 'Horas perdidas de red');


	$objPHPExcel->getActiveSheet()->mergeCells('C37:D37');
	$objPHPExcel->getActiveSheet()->setCellValue('C37', 'Total de ordenes fuera de tiempo');
	$objPHPExcel->getActiveSheet()->setCellValue('C38', 'Calidad en los servicios');


	/*FIRMAS*/
	$objPHPExcel->getActiveSheet()->getStyle('B44:C46')->applyFromArray($estilofirmas);
	$objPHPExcel->getActiveSheet()->setCellValue('B44', '_____________________');
	$objPHPExcel->getActiveSheet()->mergeCells('B44:C44');
	$objPHPExcel->getActiveSheet()->setCellValue('B45', 'Leticia Gutiérrez');
	$objPHPExcel->getActiveSheet()->mergeCells('B45:C45');
	$objPHPExcel->getActiveSheet()->setCellValue('B46', 'Autorizo');
	$objPHPExcel->getActiveSheet()->mergeCells('B46:C46');

	$objPHPExcel->getActiveSheet()->getStyle('E44:G46')->applyFromArray($estilofirmas);
	$objPHPExcel->getActiveSheet()->setCellValue('E44', '_____________________');
	$objPHPExcel->getActiveSheet()->mergeCells('E44:G44');
	$objPHPExcel->getActiveSheet()->setCellValue('E45', 'Christian Zavala');
	$objPHPExcel->getActiveSheet()->mergeCells('E45:G45');
	$objPHPExcel->getActiveSheet()->setCellValue('E46', 'Reviso');
	$objPHPExcel->getActiveSheet()->mergeCells('E46:G46');

	/*FIN DE LOS DATOS ESTATICOS */
	/*FIN */



	/*INSERTAR LOS DATOS DINAMICOS--- JALAR DE LA BASE DE DATOS */
	$mesNumerico="00";
	if($mes=="Enero"){$mesNumerico="01";}
	if($mes=="Febrero"){$mesNumerico="02";}
	if($mes=="Marzo"){$mesNumerico="03";}
	if($mes=="Abril"){$mesNumerico="04";}
	if($mes=="Mayo"){$mesNumerico="05";}
	if($mes=="Junio"){$mesNumerico="06";}
	if($mes=="Julio"){$mesNumerico="07";}
	if($mes=="Agosto"){$mesNumerico="08";}
	if($mes=="Septiembre"){$mesNumerico="09";}
	if($mes=="Octubre"){$mesNumerico="10";}
	if($mes=="Noviembre"){$mesNumerico="11";}
	if($mes=="Diciembre"){$mesNumerico="12";}

	$anioymes=$anio."-".$mesNumerico;

	/*truncar*/
			function truncateFloat($number, $digitos)
		{
		    $raiz = 10;
		    $multiplicador = pow ($raiz,$digitos);
		    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
		    return number_format($resultado, $digitos);

		}
			/*funcion para restar horas*/
			function RestarHoras($horaini,$horafin)
		{
		    $f1 = new DateTime($horaini);
		    $f2 = new DateTime($horafin);
		    $d = $f1->diff($f2);
		    return $d->format('%H')*60 + $d->format('%I');
		}
		function ConvertiraHorasyMinutos($minutos)
		{
			$horas=$minutos/60;
			$horas_sin_decimal=truncateFloat($horas,0);
			$minutos=$minutos%60;
			$horasyminutos=$horas_sin_decimal." Horas y ".$minutos." Minutos";
			return $horasyminutos;
		}


	/*CHRISTIAN ZAVALA */
	/*PARA LOS TOTALES*/
	$TotalOrdenes=0;
	$TotalTiempo=0;
	$TotalOrdenesFueraTiempo=0;
	/*FIN DE LOS TOTALES*/
	/*NUMERO DE ORDENES DE CHRISTIAN*/
	$consultasql="SELECT count(*) FROM orden1_sistemas where nom_tecnico='Christian Zavala' and fechafinal like '%".$anioymes."%'";
	$resultad=mysqli_query($link,$consultasql);
	mysqli_data_seek($resultad,0);
	$numerodeordenesChristian = mysqli_fetch_row($resultad);

	/*Obtener horas y minutos de Christian*/
	$consultasql="SELECT hora_inicio,hora_final FROM orden1_sistemas where nom_tecnico='Christian Zavala' and fechafinal like '%".$anioymes."%'";
	$resultad=mysqli_query($link,$consultasql);
	while($horasChristian = mysqli_fetch_array($resultad)){
			$Resta=RestarHoras($horasChristian['hora_inicio'],$horasChristian['hora_final']); /*resta y devuelve la suma y devuelve en minutos*/
			$SumaHorasMinutos=$SumaHorasMinutos+$Resta; /*Se hace la suma de todos los minutos de christian*/
	}
	$HorasyMinutosChristian=ConvertiraHorasyMinutos($SumaHorasMinutos);

	/*Obtener Ordenes fuera de tiempo de christian*/
	$consultasql="SELECT fechasolicitud,fechainicio FROM orden1_sistemas where nom_tecnico='Christian Zavala' and fechafinal like '%".$anioymes."%'";
	$resultad=mysqli_query($link,$consultasql);
	$SumaOrdenesFueraTiempo=0;
	while($FechasChristian = mysqli_fetch_array($resultad)){

			if($FechasChristian['fechasolicitud'] != $FechasChristian['fechainicio']) /* si es diferente */
					$SumaOrdenesFueraTiempo=$SumaOrdenesFueraTiempo+1; /*Se hace la suma de las ordenes fuera de tiempo*/

	}

	/*Para los Totales*/
	$TotalOrdenes=$numerodeordenesChristian[0] + $TotalOrdenes;
	$TotalTiempo=$SumaHorasMinutos + $TotalTiempo;
	$TotalOrdenesFueraTiempo=$SumaOrdenesFueraTiempo + $TotalOrdenesFueraTiempo;
	/**/

	$objPHPExcel->getActiveSheet()->getStyle('D7:D9')->applyFromArray($nombresytitulos);
	$objPHPExcel->getActiveSheet()->setCellValue('D7',$numerodeordenesChristian[0]);
	$objPHPExcel->getActiveSheet()->setCellValue('D8',$HorasyMinutosChristian);
	$objPHPExcel->getActiveSheet()->setCellValue('D9',$SumaOrdenesFueraTiempo);



		/*JAQUELINE FLORES*/
		/*NUMERO DE ORDENES DE JAQUELINE FLORES*/
		$consultasql="SELECT count(*) FROM orden1_sistemas where nom_tecnico='Jaqueline Flores' and fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		mysqli_data_seek($resultad,0);
		$numerodeordenesJaqui = mysqli_fetch_row($resultad);

		/*Obtener horas y minutos de JAQUI*/
		$consultasql="SELECT hora_inicio,hora_final FROM orden1_sistemas where nom_tecnico='Jaqueline Flores' and fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		$SumaHorasMinutos=0;
		while($horasChristian = mysqli_fetch_array($resultad)){
				$Resta=RestarHoras($horasChristian['hora_inicio'],$horasChristian['hora_final']); /*resta y devuelve la suma y devuelve en minutos*/
				$SumaHorasMinutos=$SumaHorasMinutos+$Resta; /*Se hace la suma de todos los minutos de JAQUI*/
		}
		$HorasyMinutosJaqui=ConvertiraHorasyMinutos($SumaHorasMinutos);

		/*Obtener Ordenes fuera de tiempo de JAQUI*/
		$consultasql="SELECT fechasolicitud,fechainicio FROM orden1_sistemas where nom_tecnico='Jaqueline Flores' and fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		$SumaOrdenesFueraTiempo=0;
		while($FechasJaqui = mysqli_fetch_array($resultad)){

				if($FechasJaqui['fechasolicitud'] != $FechasJaqui['fechainicio']) /* si es diferente */
						$SumaOrdenesFueraTiempo=$SumaOrdenesFueraTiempo+1; /*Se hace la suma de las ordenes fuera de tiempo*/

		}

		/*Para los Totales*/
		$TotalOrdenes=$numerodeordenesJaqui[0] + $TotalOrdenes;
		$TotalTiempo=$SumaHorasMinutos + $TotalTiempo;
		$TotalOrdenesFueraTiempo=$SumaOrdenesFueraTiempo + $TotalOrdenesFueraTiempo;
		/**/
		$objPHPExcel->getActiveSheet()->getStyle('D13:D15')->applyFromArray($nombresytitulos);
		$objPHPExcel->getActiveSheet()->setCellValue('D13',$numerodeordenesJaqui[0]);
		$objPHPExcel->getActiveSheet()->setCellValue('D14',$HorasyMinutosJaqui);
		$objPHPExcel->getActiveSheet()->setCellValue('D15',$SumaOrdenesFueraTiempo);




		/*IGNACIO HERNANDEZ*/
		/*NUMERO DE ORDENES DE NACHO*/
		$consultasql="SELECT count(*) FROM orden1_sistemas where nom_tecnico='Ignacio Hernandez' and fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		mysqli_data_seek($resultad,0);
		$numerodeordenesNacho = mysqli_fetch_row($resultad);

		/*Obtener horas y minutos de NACHO*/
		$consultasql="SELECT hora_inicio,hora_final FROM orden1_sistemas where nom_tecnico='Ignacio Hernandez' and fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		$SumaHorasMinutos=0;
		while($horasChristian = mysqli_fetch_array($resultad)){
				$Resta=RestarHoras($horasChristian['hora_inicio'],$horasChristian['hora_final']); /*resta y devuelve la suma y devuelve en minutos*/
				$SumaHorasMinutos=$SumaHorasMinutos+$Resta; /*Se hace la suma de todos los minutos de NACHO*/
		}
		$HorasyMinutosNacho=ConvertiraHorasyMinutos($SumaHorasMinutos);

		/*Obtener Ordenes fuera de tiempo de NACHO*/
		$consultasql="SELECT fechasolicitud,fechainicio FROM orden1_sistemas where nom_tecnico='Ignacio Hernandez' and fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		$SumaOrdenesFueraTiempo=0;
		while($FechasNacho = mysqli_fetch_array($resultad)){

				if($FechasNacho['fechasolicitud'] != $FechasNacho['fechainicio']) /* si es diferente */
						$SumaOrdenesFueraTiempo=$SumaOrdenesFueraTiempo+1; /*Se hace la suma de las ordenes fuera de tiempo*/

		}

		/*Para los Totales*/
		$TotalOrdenes=$numerodeordenesNacho[0] + $TotalOrdenes;
		$TotalTiempo=$SumaHorasMinutos + $TotalTiempo;
		$TotalOrdenesFueraTiempo=$SumaOrdenesFueraTiempo + $TotalOrdenesFueraTiempo;
		/**/
		$objPHPExcel->getActiveSheet()->getStyle('D19:D21')->applyFromArray($nombresytitulos);
		$objPHPExcel->getActiveSheet()->setCellValue('D19',$numerodeordenesNacho[0]);
		$objPHPExcel->getActiveSheet()->setCellValue('D20',$HorasyMinutosNacho);
		$objPHPExcel->getActiveSheet()->setCellValue('D21',$SumaOrdenesFueraTiempo);



		/*victor orozco*/
		/*NUMERO DE ORDENES DE victor*/
		$consultasql="SELECT count(*) FROM orden1_sistemas where nom_tecnico='Victor Orozco' and fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		mysqli_data_seek($resultad,0);
		$numerodeordenesVictor = mysqli_fetch_row($resultad);

		/*Obtener horas y minutos de victor*/
		$consultasql="SELECT hora_inicio,hora_final FROM orden1_sistemas where nom_tecnico='Victor Orozco' and fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		$SumaHorasMinutos=0;
		while($horasVictor = mysqli_fetch_array($resultad)){
				$Resta=RestarHoras($horasVictor['hora_inicio'],$horasVictor['hora_final']); /*resta y devuelve la suma y devuelve en minutos*/
				$SumaHorasMinutos=$SumaHorasMinutos+$Resta; /*Se hace la suma de todos los minutos de victor*/
		}
		$HorasyMinutosVictor=ConvertiraHorasyMinutos($SumaHorasMinutos);

		/*Obtener Ordenes fuera de tiempo de victor*/
		$consultasql="SELECT fechasolicitud,fechainicio FROM orden1_sistemas where nom_tecnico='Victor Orozco' and fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		$SumaOrdenesFueraTiempo=0;
		while($FechasVictor = mysqli_fetch_array($resultad)){

				if($FechasVictor['fechasolicitud'] != $FechasVictor['fechainicio']) /* si es diferente */
						$SumaOrdenesFueraTiempo=$SumaOrdenesFueraTiempo+1; /*Se hace la suma de las ordenes fuera de tiempo*/

		}

		$objPHPExcel->getActiveSheet()->getStyle('D25:D27')->applyFromArray($nombresytitulos);
		$objPHPExcel->getActiveSheet()->setCellValue('D25',$numerodeordenesVictor[0]);
		$objPHPExcel->getActiveSheet()->setCellValue('D26',$HorasyMinutosVictor);
		$objPHPExcel->getActiveSheet()->setCellValue('D27',$SumaOrdenesFueraTiempo);


		/*REPORTE PARTE FINAL*/
		/*Para los Totales*/
		$TotalOrdenes=$numerodeordenesVictor[0] + $TotalOrdenes;
		$TotalTiempo=$SumaHorasMinutos + $TotalTiempo;
		$TotalTiempoConFormato=ConvertiraHorasyMinutos($TotalTiempo);
		$TotalOrdenesFueraTiempo=$SumaOrdenesFueraTiempo + $TotalOrdenesFueraTiempo;
		$PorcentajeCumplimiento=(($TotalOrdenes-$TotalOrdenesFueraTiempo)/$TotalOrdenes)*100;
		/**/

		/*Obtener horas y minutos de SOFTWARE */
		$consultasql="SELECT hora_inicio,hora_final FROM orden1_sistemas where nom_tecnico='Ignacio Hernandez' and tipo='Desarrollo' and fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		$SumaHorasMinutosD=0;
		while($horasDesarrollo = mysqli_fetch_array($resultad)){
				$Resta=RestarHoras($horasDesarrollo['hora_inicio'],$horasDesarrollo['hora_final']); /*resta y devuelve la suma y devuelve en minutos*/
				$SumaHorasMinutosD=$SumaHorasMinutosD+$Resta; /*Se hace la suma de todos los minutos de victor*/
		}
		$HorasyMinutosDesarrollo=ConvertiraHorasyMinutos($SumaHorasMinutosD);

		/*Obtener horas y minutos de PERDIDA DE RED */
		$consultasql="SELECT hora_inicio,hora_final FROM orden1_sistemas where  tipo='Perdida de Red' and fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		$SumaHorasMinutosR=0;
		while($horasred = mysqli_fetch_array($resultad)){
				$Resta=RestarHoras($horasred['hora_inicio'],$horasred['hora_final']); /*resta y devuelve la suma y devuelve en minutos*/
				$SumaHorasMinutosR=$SumaHorasMinutosR+$Resta; /*Se hace la suma de todos los minutos de victor*/
		}
		$HorasyMinutosPerdidaRed=ConvertiraHorasyMinutos($SumaHorasMinutosR);

		/*NUMERO DE ORDENES MALAS, REGULARES, BUENAS Y EXCELENTES*/
		$consultasql="SELECT count(*) FROM revisionusuario r, orden1_sistemas o where r.folio=o.folio and r.calificacion='Malo' and o.fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		mysqli_data_seek($resultad,0);
		$numerodeordenesMalas = mysqli_fetch_row($resultad);

		$consultasql="SELECT count(*) FROM revisionusuario r, orden1_sistemas o where r.folio=o.folio and r.calificacion='Regular' and o.fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		mysqli_data_seek($resultad,0);
		$numerodeordenesRegular = mysqli_fetch_row($resultad);

		$consultasql="SELECT count(*) FROM revisionusuario r, orden1_sistemas o where r.folio=o.folio and r.calificacion='Bueno' and o.fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		mysqli_data_seek($resultad,0);
		$numerodeordenesBueno = mysqli_fetch_row($resultad);

		$consultasql="SELECT count(*) FROM revisionusuario r, orden1_sistemas o where r.folio=o.folio and r.calificacion='Excelente' and o.fechafinal like '%".$anioymes."%'";
		$resultad=mysqli_query($link,$consultasql);
		mysqli_data_seek($resultad,0);
		$numerodeordenesExcelente = mysqli_fetch_row($resultad);

		$numeroOrdenesMalasRegularBuenas=$numerodeordenesMalas[0]." Malos ,".$numerodeordenesRegular[0]." Regulares ,".$numerodeordenesBueno[0]." Buenos ,".$numerodeordenesExcelente[0]." Excelentes";




		$objPHPExcel->getActiveSheet()->getStyle('D31:D35')->applyFromArray($nombresytitulos);
		$objPHPExcel->getActiveSheet()->setCellValue('D31',truncateFloat($PorcentajeCumplimiento,2)."%");
		$objPHPExcel->getActiveSheet()->setCellValue('D32',$TotalOrdenes);
		$objPHPExcel->getActiveSheet()->setCellValue('D33',$TotalTiempoConFormato);
		$objPHPExcel->getActiveSheet()->setCellValue('D34',$HorasyMinutosDesarrollo);
		$objPHPExcel->getActiveSheet()->setCellValue('D35',$HorasyMinutosPerdidaRed);

		$objPHPExcel->getActiveSheet()->getStyle('E37:E38')->applyFromArray($nombresytitulos);
		$objPHPExcel->getActiveSheet()->setCellValue('E37',$TotalOrdenesFueraTiempo);
		$objPHPExcel->getActiveSheet()->setCellValue('E38',$numeroOrdenesMalasRegularBuenas);






	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Reporte.xlsx"');
	header('Cache-Control: max-age=0');

	$writer->save('php://output');
?>
