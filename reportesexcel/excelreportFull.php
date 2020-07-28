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

	$mes=$_POST["mes2"];
	$anio=$_POST["anio2"];

	if($mes=='Enero')$mesNum='01';
	if($mes=='Febrero')$mesNum='02';
	if($mes=='Marzo')$mesNum='03';
	if($mes=='Abril')$mesNum='04';
	if($mes=='Mayo')$mesNum='05';
	if($mes=='Junio')$mesNum='06';
	if($mes=='Julio')$mesNum='07';
	if($mes=='Agosto')$mesNum='08';
	if($mes=='Septiembre')$mesNum='09';
	if($mes=='Octubre')$mesNum='10';
	if($mes=='Noviembre')$mesNum='11';
	if($mes=='Diciembre')$mesNum='12';

	/*FIN DEL MODULO DE RECEPCION*/

	$bordes = array(
     'borders' => array(
      'allborders' => array(
       'style' => PHPExcel_Style_Border::BORDER_THIN
     )
    )
);

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
	),
		'alignment' => array(
				 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				  'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		 )
		);

		$colorceldas = array(
							'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('rgb'=>'#fcb9b9'),
							),
							'font' => array(
									'bold' => true,
							)
							);


		/*PONER LOS DATOS ESTATICOS */

		//incluir una imagen
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setPath('../imagenes/fondoreporte.jpg'); //ruta
		$objDrawing->setHeight(107); //altura
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

		//incluir una imagen
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setPath('../imagenes/logo.png'); //ruta
		$objDrawing->setHeight(80); //altura
		$objDrawing->setCoordinates('B3');
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen

		//incluir una imagen
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setPath('../imagenes/datos.png'); //ruta
		$objDrawing->setHeight(50); //altura
		$objDrawing->setCoordinates('D4');
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen




	$objPHPExcel->getActiveSheet()->getStyle('B9')->applyFromArray($estiloTituloReporte);
	$objPHPExcel->getActiveSheet()->setCellValue('B9','REPORTE DE ACTIVIDADES REALIZADAS DEL MES DE '.$mes.' '.$anio);
	$objPHPExcel->getActiveSheet()->mergeCells('B9:J9');

	//establecer el ancho de las columnas
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(7);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(22);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(22);

		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(82);

	//FIN ANCHO DE LAS COLUMNAS

	//poner color a los comentarios destacados
	$objPHPExcel->getActiveSheet()->getStyle('B13:N15')->getFill()
			->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
			'startcolor' => array('rgb' => 'ABD7AC')
			));
	$objPHPExcel->getActiveSheet()->getStyle('B13:M15')->applyFromArray($bordes);


	$objPHPExcel->getActiveSheet()->getStyle('B13:N15')->applyFromArray($nombresytitulos);

	$objPHPExcel->getActiveSheet()->setCellValue('B13', 'Folio');
	$objPHPExcel->getActiveSheet()->mergeCells('B13:B15');

	$objPHPExcel->getActiveSheet()->setCellValue('C13', 'Persona que Solicita');
	$objPHPExcel->getActiveSheet()->mergeCells('C13:C15');

	$objPHPExcel->getActiveSheet()->setCellValue('D13', 'Departamento');
	$objPHPExcel->getActiveSheet()->mergeCells('D13:D15');

	$objPHPExcel->getActiveSheet()->setCellValue('E13', 'Trabajo Solicitado');
	$objPHPExcel->getActiveSheet()->mergeCells('E13:E15');

	$objPHPExcel->getActiveSheet()->setCellValue('F13', 'Fecha de Solicitud');
	$objPHPExcel->getActiveSheet()->mergeCells('F13:F15');

	$objPHPExcel->getActiveSheet()->setCellValue('G13', 'Fecha de Inicio');
	$objPHPExcel->getActiveSheet()->mergeCells('G13:G15');

	$objPHPExcel->getActiveSheet()->setCellValue('H13', 'Fecha de Termino');
	$objPHPExcel->getActiveSheet()->mergeCells('H13:H15');

	$objPHPExcel->getActiveSheet()->setCellValue('I13', 'Hora de Inicio');
	$objPHPExcel->getActiveSheet()->mergeCells('I13:I15');

	$objPHPExcel->getActiveSheet()->setCellValue('J13', 'Hora de Termino');
	$objPHPExcel->getActiveSheet()->mergeCells('J13:J15');

	$objPHPExcel->getActiveSheet()->setCellValue('K13', 'Tiempo Total');
	$objPHPExcel->getActiveSheet()->mergeCells('K13:K15');

	$objPHPExcel->getActiveSheet()->setCellValue('L13', 'Realizo el Servicio');
	$objPHPExcel->getActiveSheet()->mergeCells('L13:L15');

	$objPHPExcel->getActiveSheet()->setCellValue('M13', 'Calidad en el Servicio');
	$objPHPExcel->getActiveSheet()->mergeCells('M13:M15');

	$objPHPExcel->getActiveSheet()->setCellValue('N13', 'Fuera'.PHP_EOL.'De'.PHP_EOL.'Tiempo');
	$objPHPExcel->getActiveSheet()->mergeCells('N13:N15');




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

				if($horas_sin_decimal == 0)
					$horas="00";
				if($horas_sin_decimal < 10 and $horas_sin_decimal != 0)
					$horas="0".$horas_sin_decimal;

					if($minutos == 0)
						$minutos="00";
					if($minutos < 10 and $minutos != 0)
						$minutos="0".$minutos;

				$horasyminutos=$horas.":".$minutos;

				return $horasyminutos;
			}


			//ANALIZADOR DE ORDENES FUERA DE TIEMPO
			function OrdenfueradeTiempoSioNo($fechaSolicitud,$FechaInicio)
			{
				if($fechaSolicitud != $FechaInicio)
				return $FueradeTiempo=1;
				else
				return $FueradeTiempo=0;
			}
	//

	//insertar todos los datos de LA Base
	/*Obtener Ordenes fuera de tiempo de christian*/
	$consultasql="SELECT * FROM orden1_sistemas s, revisionusuario r  where s.folio=r.folio and fechafinal like '%".$anio.'-'.$mesNum."%' order by s.folio ASC";
	$resultad=mysqli_query($link,$consultasql);
	$numerodelinea=16;
	$Letras = array("B", "C", "D","E", "F", "G", "H","I", "J", "K", "L","M");
	$tempContador=0;
		/*$objPHPExcel->getActiveSheet()->setCellValue('C7',$consultasql);*/
	while($ConsultaGeneral = mysqli_fetch_array($resultad)){

	$objPHPExcel->getActiveSheet()->setCellValue('B'.$numerodelinea,$ConsultaGeneral['folio']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$numerodelinea,$ConsultaGeneral['solicitante']);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$numerodelinea,$ConsultaGeneral['departamento']);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$numerodelinea,$ConsultaGeneral['descripcion']);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$numerodelinea,$ConsultaGeneral['fechasolicitud']);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$numerodelinea,$ConsultaGeneral['fechainicio']);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$numerodelinea,$ConsultaGeneral['fechafinal']);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$numerodelinea,$ConsultaGeneral['hora_inicio']);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$numerodelinea,$ConsultaGeneral['hora_final']);
	$RestaEnMinutos=RestarHoras($ConsultaGeneral['hora_inicio'],$ConsultaGeneral['hora_final']);
	$HoraConFormato=ConvertiraHorasyMinutos($RestaEnMinutos);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$numerodelinea,$HoraConFormato);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$numerodelinea,$ConsultaGeneral['nom_tecnico']);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$numerodelinea,$ConsultaGeneral['calificacion']);

	$OrdenFueradeTiempo=OrdenfueradeTiempoSioNo($ConsultaGeneral['fechasolicitud'],$ConsultaGeneral['fechainicio']);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$numerodelinea,$OrdenFueradeTiempo);

	if( strlen($ConsultaGeneral['comentarios']) >21)
	{
		//poner color a los comentarios destacados
		$objPHPExcel->getActiveSheet()->getStyle('O'.$numerodelinea)->getFill()
				->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => 'ABD7AC')
				));
	}
		$objPHPExcel->getActiveSheet()->setCellValue('O'.$numerodelinea,$ConsultaGeneral['comentarios']);


	$numerodelinea=	$numerodelinea +1;
	}






	$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Reporte.xlsx"');
	header('Cache-Control: max-age=0');

	$writer->save('php://output');
?>
