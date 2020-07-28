<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    date_default_timezone_set('America/Monterrey');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ordenes de Servicio</title>

    <link rel="icon" href="imagenes/Ordenes.png" type="image/png"  />
    <link rel="stylesheet" href="css/ordenes.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/fecha.js"></script>
    <script type="text/javascript" src="js/fecha.js"></script>
</head>
<script>

</script>

<body>
    <section class="containertitulo">
      <div class="itemtitulo">
        <div class="mifecha">
        <div id="ano" class="ano"></div>
        <div id="dia" class="dia"></div>
        <div id="mes" class="mes"></div>
        </div>
      </div>
      <div class="itemtitulo">
            <h1>ORDEN DE SERVICIO DE SISTEMAS</h1>
      </div>
      <div class="itemtitulo">
            <h1></h1>
      </div>

    </section>



 <!-- INICIA EL CODIGO PHP -->
 <?php
        date_default_timezone_set('America/Mexico_City');
        $link=mysqli_connect("localhost", "root", "pirineos", "ordenes");

        /*DATOS */
            $solicitante=$_POST["solicitante"];
            $departamento=$_POST["departamento"];
            $ubicacion=$_POST["ubicacion"];

            $fechasolicitud = $_POST["fechasolicitud"]; //2019-08-27
            $fechainicio =$_POST["fechainicio"];
            $fechafinal =$_POST["fechafinal"];

            $tipo_servicio=$_POST["tipo"];
            $descripcion=$_POST["Descripcion"];

            /*horas */
            $hora_inicio=$_POST["h_inicio"]; //00:00
            $hora_final=$_POST["h_final"];

            $elaboro=$_POST["elaboro"];

            $fechaactual=date('Y-m-d H:i:s');
            $presionarguardar=$_POST["Guardar"];

            $EstaRepetido='No';
        //FIN DE LOS DATOS


        //Para analizar repetidos
        $consultasql="SELECT * FROM orden1_sistemas order by folio desc limit 1";
        $resultad=mysqli_query($link,$consultasql);
        mysqli_data_seek($resultad,0);
        $ultima_fila_insertada = mysqli_fetch_row($resultad);

        $fila_a_insertar = array("SoloParaIniciar",$solicitante,$departamento,$ubicacion,$tipo_servicio,$descripcion);
        $contador=0;
        for ($i = 1; $i <= 5; $i++)
        {
            if($ultima_fila_insertada[$i] == $fila_a_insertar[$i]){
                ++$contador;
            }
            if($contador == 5)
                $EstaRepetido='Si';
        }
        ///

        ///PARA NO INSERTAR ORDENES DE MESES ANTERIORES
        $SeInsertanAtiempo='No';
        $mesACTUAL =substr($fechaactual, 5, 2);
        $mesINSERTADO =substr($fechafinal, 5, 2);
        if($mesACTUAL == $mesINSERTADO)
        {
          $SeInsertanAtiempo='Si';
        }
        //fin del analisis de MESES


        if($presionarguardar == "Guardar")
        {

                /* NO INSERTAR SI ESTA VACIA LA PALABRA */
                if ( empty($solicitante)==1 or empty($descripcion)==1 or empty($tipo_servicio)==1 )
                {
                    echo'<script type="text/javascript"> alert("No se puede insertar, llene los campos");</script>';

                }
                elseif ($EstaRepetido == 'Si') {
                    echo'<script type="text/javascript"> alert("Datos Repetidos, No se puede insertar");</script>';

                }
                elseif ($SeInsertanAtiempo == 'No') {
                    echo'<script type="text/javascript"> alert("Esta Orden Pertenece al mes pasado, No se puede insertar");</script>';
                }
                else //cuando se an insertado la mayoria de los valores
                {
                    //GENERADOR DE FOLIO PARA INSERTAR
                    $consultasql="SELECT * FROM orden1_sistemas order by folio desc limit 1";
                    $resultad=mysqli_query($link,$consultasql);
                    mysqli_data_seek($resultad,0);
                    $folioactual = mysqli_fetch_row($resultad);
                    $foliosiguiente=$folioactual[0]+1;
                ///// FIN GENERADOR DE FOLIO

                /*insertar en la tabla de primer pesaje */
                $solicitud_sin_validar="INSERT INTO orden1_sistemas (folio,solicitante,departamento,ubicacion,tipo,descripcion,hora_inicio,hora_final,fecha_registrado,fechasolicitud,fechainicio,fechafinal,estado,nom_tecnico) VALUES
                ($foliosiguiente,'$solicitante','$departamento','$ubicacion','$tipo_servicio','$descripcion','$hora_inicio','$hora_final','$fechaactual','$fechasolicitud','$fechainicio','$fechafinal','Incompleto','$elaboro')";

                mysqli_query($link,$solicitud_sin_validar);

                    /*echo "<SCRIPT>window.open('prueba.php','Informacion del Registro');</SCRIPT>";*/ //abre una ventana nueva con informacion
                echo'<script type="text/javascript"> alert("Ingresa a 192.168.18.197/ordenes_servicios/validarOrden.php\n Su folio es : '.$foliosiguiente.' ");</script>';
                }
        }

?>

<form action="ordenes.php" method="POST" name="form_principal" id="form_principal">
    <section class="container"> <!-- CONTENEDOR DE LA SECCION CENTRAL 2 -->

            <div class="item"><!-- TERCERA SECCION, ES LA SECCION DE "CHOFER" -->
                    <div class="item">
                            <h1>LLene su Orden</h1>
                            <?php
                                date_default_timezone_set('America/Mexico_City');
                                $link=mysqli_connect("localhost", "root", "pirineos", "ordenes");

                                    $consultasql="SELECT * FROM orden1_sistemas order by folio desc limit 1";
                                    $resultad=mysqli_query($link,$consultasql);

                                    mysqli_data_seek($resultad,0);
                                    $folioactual = mysqli_fetch_row($resultad);

                                    $foliosiguiente=$folioactual[0]+1;
                                    $_SESSION['folio']=$foliosiguiente;

                                    echo "<h2 id='folio'>"."Folio ".$_SESSION['folio']."</h2>";
                            ?>


                                <div class="item centrado">
                                    <p >Solicitante&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <input class="basic-slide" type="text" id="solicitante" name="solicitante" placeholder="Ingrese el nombre"></p>
                                </div>
                                <div class="item centrado">
                                    <p>Departamento&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <select class="basic-slide" id="departamento" name="departamento">
                                        <?php
                                            $con = mysqli_connect('localhost', 'root', 'pirineos', 'ordenes');
                                            $sql5="SELECT * FROM departamentos";
                                            $resultad=mysqli_query($con,$sql5);
                                            while($row2 = mysqli_fetch_array($resultad))
                                                echo '<option value="'.$row2['departamento'].'">'.$row2['departamento'].'</option>';
                                        ?>
                                    </select></p>

                                </div>
                                <div class="item centrado">
                                    <p >Ubicación&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <select class="basic-slide" id="ubicacion" name="ubicacion">
                                        <?php
                                            $con = mysqli_connect('localhost', 'root', 'pirineos', 'ordenes');
                                            $sql5="SELECT * FROM ubicaciones";
                                            $resultad=mysqli_query($con,$sql5);
                                            while($row2 = mysqli_fetch_array($resultad))
                                                echo '<option value="'.$row2['ubicacion'].'">'.$row2['ubicacion'].'</option>';
                                        ?>
                                    </select></p>
                                </div>
                                <br>
                                <div class="item-graficos">
                                    <div class="item">
                                        <p>Fecha Solicitud
                                        <input   type="date" id="fechasolicitud" name="fechasolicitud" value=""></p>
                                    </div>
                                    <div class="item">
                                        <p>Fecha Inicio
                                        <input  type="date" id="fechainicio" name="fechainicio" value=""></p>
                                    </div>
                                    <div class="item">
                                            <p>Fecha Final
                                            <input type="date" id="fechafinal" name="fechafinal" value="">
                                            </p>
                                    </div>
                                 </div>
                                <br>

                                <div class="item centrado">
                                        <fieldset><legend>Tipo de Servicio</legend>
                                        <input type="radio" class="checbox" id="tipo" name="tipo" value="Hardware">Hardware&nbsp&nbsp
                                        <input type="radio" class="checbox" id="tipo" name="tipo"  value="Software">Software&nbsp&nbsp
                                        <input type="radio" class="checbox" id="tipo" name="tipo"  value="Red" >Red&nbsp&nbsp
                                        <input type="radio" class="checbox" id="tipo" name="tipo"  value="Mantenimiento" >Mantenimiento&nbsp&nbsp
                                        <input type="radio" class="checbox" id="tipo" name="tipo"  value="Perdida de Red" >Perdida de Enlace&nbsp&nbsp
                                        <input type="radio" class="checbox" id="tipo" name="tipo"  value="Desarrollo" >Desarrollo&nbsp&nbsp
                                    </fieldset>
                                </div>

                                <div class="item centrado">
                                    <br>
                                    <p>Descripción</p>
                                    <textarea rows="2" cols="90" id="Descripcion" name="Descripcion" ></textarea>

                                </div>

                                <div class="item centrado">
                                    <p>Hora Inicio&nbsp
                                      <input type="time" clase="basic-slide"  min="00:00" value="08:00:00" max="23:59" id="h_inicio" name="h_inicio" step="1"></p>
                                    <p>Hora Final&nbsp&nbsp
                                      <input type="time" clase="basic-slide horascortas" value="08:00:00" min="00:00" max="23:59" id="h_final" name="h_final" step="1"></p>
                                </div>

                                <div class="item centrado">
                                    <p >Elaboro&nbsp&nbsp&nbsp
                                    <select class="basic-slide" id="elaboro" name="elaboro">
                                        <?php
                                            $con = mysqli_connect('localhost', 'root', 'pirineos', 'ordenes');
                                            $sql5="SELECT * FROM tecnicos ORDER BY id DESC";
                                            $resultad=mysqli_query($con,$sql5);
                                            while($row2 = mysqli_fetch_array($resultad))
                                                echo '<option value="'.$row2['nombre'].'">'.$row2['nombre'].'</option>';
                                        ?>
                                    </select>


                                <div class="item boton derecha">
                                        <input type="submit" class="botonnaranja" value="Guardar" id="Guardar" name="Guardar">
                                </div>
                    </div>
            </div><!-- FIN, SECCION DE "CHOFER" -->

    </section><!-- FIN DE LA SECCION CENTRAL 2 -->
    </form>








    <script>
        var fechaactual=setfecha();

        /*
         document.form_reportes.fechainicioR.value = fechaactual;
         document.form_reportes.fechasalidaR.value = fechaactual;*/

         document.form_principal.fechasolicitud.value=fechaactual;
         document.form_principal.fechainicio.value=fechaactual;
         document.form_principal.fechafinal.value=fechaactual;


         

         /*calendario IZQUIERDO*/
         var f=new Date();
         var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         document.getElementById('ano').innerHTML=f.getFullYear();
         document.getElementById('dia').innerHTML=f.getDate();
         document.getElementById('mes').innerHTML=meses[f.getMonth()];


        /*HORA EN MINUTOS, SEGUNDOS Y HORA*/
         function startTime()
         {
             today=new Date();
             h=today.getHours();
             m=today.getMinutes();
             s=today.getSeconds();
             m=checkTime(m);
             s=checkTime(s);
             document.getElementById('reloj').innerHTML=h+":"+m+":"+s; t=setTimeout('startTime()',500);
         }

         function checkTime(i) {
           if (i<10) {i="0" + i;}
           return i;
         }
         window.onload=function()
         {
           startTime();
         }
   </script>
</body>
</html>
