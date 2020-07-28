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
    <title>Reporte final Servicios</title>

    <link rel="icon" href="imagenes/reporte.png" type="image/png"  />
    <link rel="stylesheet" href="css/ordenes.css">
    <link rel="stylesheet" href="css/panel_control.css">
    <script type="text/javascript" src="js/fecha.js"></script>
    <script type="text/javascript" src="js/fecha.js"></script>

</head>


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
            <h1>SECCIÓN DE REPORTES</h1>
      </div>
      <div class="itemtitulo">
            <h1></h1>
      </div>

    </section>



<!-- INICIA EL CODIGO PHP -->
<?php
        date_default_timezone_set('America/Mexico_City');
        $link=mysqli_connect("localhost", "root", "pirineos", "ordenes");



?>



    <section class="container"> <!-- CONTENEDOR DE LA SECCION CENTRAL 2 -->

            <div class="item"><!-- TERCERA SECCION, ES LA SECCION DE "CHOFER" -->

                    <div class="item centrado">

                                <!--<div class="item centrado">
                                    <fieldset><legend>Evidencia</legend>
                                    <select class="basic-slide" name="anio" id="anio">
                                        <option value="2019" selected>2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                    </select>
                                    <select class="basic-slide" name="select">
                                        <option value="Enero" selected>Enero</option>
                                        <option value="Febrero">Febrero</option>
                                        <option value="Marzo">Marzo</option>
                                    </select>
                                        <input type="submit" class="botonnaranja" value="Ver" id="BotonReporteEvidencia" name="BotonReporteEvidencia">
                                    </fieldset>
                                </div>
                               -->
                                <br>

                                <form ACTION="reportesexcel\excelreport.php" METHOD=post name="excelreportM" id="excelreportM">
                                    <div class="item centrado">
                                        <fieldset><legend>Generar Reporte Para Firmar</legend>
                                        <select class="basic-slide" name="anio" id="anio">
                                            <option value="2019" selected>2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                        </select>
                                        <select class="basic-slide" name="mes" id="mes">
                                            <option value="Enero" selected>Enero</option>
                                            <option value="Febrero">Febrero</option>
                                            <option value="Marzo">Marzo</option>
                                            <option value="Abril" >Abril</option>
                                            <option value="Mayo">Mayo</option>
                                            <option value="Junio">Junio</option>
                                            <option value="Julio">Julio</option>
                                            <option value="Agosto">Agosto</option>
                                            <option value="Septiembre">Septiembre</option>
                                            <option value="Octubre">Octubre</option>
                                            <option value="Noviembre">Noviembre</option>
                                            <option value="Diciembre">Diciembre</option>
                                        </select>
                                            <input type="submit" class="botonnaranja" value="Ver" id="BotonReporteCorto" name="BotonReporteCorto">
                                        </fieldset>
                                    </div>
                                </form>

                                <br>
                                <form ACTION="reportesexcel\excelreportFull.php" METHOD=post name="excelreportF" id="excelreportF">
                                    <div class="item centrado">
                                        <fieldset><legend>Generar Reporte Completo</legend>
                                        <select class="basic-slide" name="anio2" id="anio2">
                                            <option value="2019" selected>2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                        </select>
                                        <select class="basic-slide" name="mes2" id="mes2">
                                            <option value="Enero" selected>Enero</option>
                                            <option value="Febrero">Febrero</option>
                                            <option value="Marzo">Marzo</option>
                                            <option value="Abril" >Abril</option>
                                            <option value="Mayo">Mayo</option>
                                            <option value="Junio">Junio</option>
                                            <option value="Julio">Julio</option>
                                            <option value="Agosto">Agosto</option>
                                            <option value="Septiembre">Septiembre</option>
                                            <option value="Octubre">Octubre</option>
                                            <option value="Noviembre">Noviembre</option>
                                            <option value="Diciembre">Diciembre</option>
                                        </select>
                                            <input type="submit" class="botonnaranja" value="Ver" id="BotonReporteFull" name="BotonReporteFull">
                                        </fieldset>
                                    </div>
                                </form>
                                <br>
                                <br>

                                <!--
                                <div class="item centrado">
                                    <fieldset><legend>GRAFICAS</legend>
                                            <select class="basic-slide" name="anio" id="anio">
                                                <option value="2019" selected>2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                            </select>
                                            <select class="basic-slide" name="select">
                                                <option value="Enero" selected>Enero</option>
                                                <option value="Febrero">Febrero</option>
                                                <option value="Marzo">Marzo</option>
                                            </select>
                                            <select class="basic-slide" name="select">
                                                <option value="Enero" selected>Solicitudes por mes</option>
                                                <option value="Febrero">Horas Perdidas de red</option>
                                                <option value="Marzo">Desarrollo de software</option>
                                                <option value="Marzo">Calidad en el servicio</option>
                                                <option value="Marzo">Total de Servicios</option>
                                                <option value="Marzo">Total de Horas</option>
                                            </select>
                                                <input type="submit" class="botonnaranja" value="Ver" id="ReporteCorto" name="ReporteCorto">
                                    </fieldset>
                                </div>

                              -->
                    </div>


            </div><!-- FIN, SECCION DE "CHOFER" -->

    </section><!-- FIN DE LA SECCION CENTRAL 2 -->




    <script>
        var fechaactual=setfecha();


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
