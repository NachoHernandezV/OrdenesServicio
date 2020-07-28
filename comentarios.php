<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    date_default_timezone_set('America/Monterrey');
    $link=mysqli_connect("localhost", "root", "pirineos", "ordenes");

    $_SESSION['folio']=$_POST["folio"];

    $sqlmesnombre="SELECT count(*) FROM orden1_sistemas where folio='".$_SESSION['folio']."' and estado='Completo'";
    $tablanombre1=mysqli_query($link,$sqlmesnombre);
    mysqli_data_seek($tablanombre1,0);
    $yaseEvaluo= mysqli_fetch_row($tablanombre1);
    $_SESSION['yaseEvaluo']= $yaseEvaluo[0];

    if($_SESSION['yaseEvaluo']==1)
    {
        $_SESSION['yaseEvaluo']=0;
        echo '<script>alert("Este folio ya fue evaluado");</script>';
    	echo '<script>window.location="regresar.php"</script>';
    }


?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validacion de Servicios</title>
    <link rel="stylesheet" href="css/ordenes.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_comentarios.css">
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
            $fechaactual=date('Y-m-d H:i:s');
        //FIN DE LOS DATOS

?>



<form action="regresar.php" method="POST" name="form_principal" id="form_principal">
    <section class="container"> <!-- CONTENEDOR DE LA SECCION CENTRAL 2 -->

            <div class="item"><!-- TERCERA SECCION, ES LA SECCION DE "CHOFER" -->
                    <div class="item">
                            <h1>Evalue la calidad del servicio</h1>

                            <div class="item centrado">
                                    <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFolio&nbsp&nbsp&nbsp

                                        <?php
                                            echo '<input class="basic-slide" type="text" id="folio" name="folio" readonly="readonly" value="'.$_SESSION['folio'].'">';
                                        ?>
                                    </p>
                                </div>

                                <div class="item centrado">
                                    <p>Elaboro el servicio&nbsp

                                        <?php
                                            $con = mysqli_connect('localhost', 'root', 'pirineos', 'ordenes');
                                            $sql5="SELECT * FROM orden1_sistemas where folio=". $_SESSION['folio'];
                                            $resultad=mysqli_query($con,$sql5);
                                            while($row2 = mysqli_fetch_array($resultad))
                                            echo '<input class="basic-slide" type="text" id="tecnico" name="tecnico" readonly="readonly" value="'.$row2['nom_tecnico'].'">';
                                        ?>
                                    </p>
                                </div>
                                <div class="item centrado">
                                    <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSolicitante&nbsp

                                        <?php
                                            $con = mysqli_connect('localhost', 'root', 'pirineos', 'ordenes');
                                            $sql5="SELECT * FROM orden1_sistemas where folio=". $_SESSION['folio'];
                                            $resultad=mysqli_query($con,$sql5);
                                            while($row2 = mysqli_fetch_array($resultad))
                                            echo '<input class="basic-slide" type="text" id="tecnico" name="tecnico" readonly="readonly" value="'.$row2['solicitante'].'">';
                                        ?>
                                    </p>
                                </div>
                                <div class="item centrado">
                                    <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFecha&nbsp

                                        <?php
                                            $con = mysqli_connect('localhost', 'root', 'pirineos', 'ordenes');
                                            $sql5="SELECT * FROM orden1_sistemas where folio=". $_SESSION['folio'];
                                            $resultad=mysqli_query($con,$sql5);
                                            while($row2 = mysqli_fetch_array($resultad))
                                            echo '<input class="basic-slide" type="text" id="tecnico" name="tecnico" readonly="readonly" value="'.$row2['fechafinal'].'">';
                                        ?>
                                    </p>
                                </div>
                                <div class="item centrado">
                                    <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspTiempo Total&nbsp

                                        <?php
                                            $con = mysqli_connect('localhost', 'root', 'pirineos', 'ordenes');
                                            $sql5="SELECT * FROM orden1_sistemas where folio=". $_SESSION['folio'];
                                            $resultad=mysqli_query($con,$sql5);
                                            function RestarHoras($horaini,$horafin)
                                            {
                                                $f1 = new DateTime($horaini);
                                                $f2 = new DateTime($horafin);
                                                $d = $f1->diff($f2);
                                                return $d->format('%H Horas y %I Minutos');
                                            }
                                            while($row2 = mysqli_fetch_array($resultad)){
                                            $tiempototal=RestarHoras($row2['hora_inicio'],$row2['hora_final']);
                                            echo '<input class="basic-slide" type="text" id="tiempototal" name="tiempototal" readonly="readonly" value="'.$tiempototal.'">';
                                            }
                                        ?>
                                    </p>
                                </div>


                                <div class="item centrado">
                                    <p>Descripción&nbsp </p>

                                        <?php
                                            $con = mysqli_connect('localhost', 'root', 'pirineos', 'ordenes');
                                            $sql5="SELECT * FROM orden1_sistemas where folio=". $_SESSION['folio'];
                                            $resultad=mysqli_query($con,$sql5);
                                            while($row2 = mysqli_fetch_array($resultad))
                                            echo '<textarea rows="3" cols="82" id="descripcion" class="basic-slide_c" name="descripcion" readonly="readonly">'.$row2['descripcion'].'</textarea>';
                                        ?>
                                </div>


                                <br>

                                <br>
                                <div class="item centrado">
                                        <fieldset><legend>Calidad en el Servicio</legend>
                                        <input type="radio" class="checbox" name="calificacion" value="Malo">MALO&nbsp&nbsp
                                        <input type="radio" class="checbox" name="calificacion"  value="Regular">REGULAR&nbsp&nbsp
                                        <input type="radio" class="checbox" name="calificacion"  value="Bueno" >BUENO&nbsp&nbsp
                                        <input type="radio" class="checbox" name="calificacion"  value="Excelente" >EXCELENTE&nbsp&nbsp
                                    </fieldset>
                                </div>

                                <div class="item centrado">
                                    <br>
                                    <p>Ingrese sus comentarios</p>
                                    <textarea rows="3" cols="85" id="Comentarios" name="Comentarios" ></textarea>

                                </div>


                                <div class="item boton derecha">
                                        <input type="submit" class="botonnaranja" value="Enviar" id="EnviarC" name="EnviarC">
                                </div>
                    </div>
            </div><!-- FIN, SECCION DE "CHOFER" -->

    </section><!-- FIN DE LA SECCION CENTRAL 2 -->
    </form>






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
