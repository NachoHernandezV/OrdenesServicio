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
    <link rel="stylesheet" href="css/ordenes.css">
    <link rel="stylesheet" href="css/regresar.css">
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
            <h1>Gracias!!</h1>
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
            $folio=$_POST["folio"];
            $fechaactual=date('Y-m-d H:i:s');
            $presionarenviar=$_POST["EnviarC"];
            $calificacion=$_POST["calificacion"];
            $comentarios=$_POST["Comentarios"];
            $_SESSION['folio']=$folio;
        //FIN DE LOS DATOS


        if($presionarenviar == "Enviar")
        {
            //ver si ESTA SIN CALIFICAR POR EL USUARIO
            $consultasql="SELECT * FROM orden1_sistemas where folio='".$_SESSION['folio']."'";
            $resultad=mysqli_query($link,$consultasql);
            mysqli_data_seek($resultad,0);
            $SinCalificar = mysqli_fetch_row($resultad);

            if($SinCalificar[12] == "Incompleto" and empty($calificacion)==0 )
            {
                    /*ACTUALIZAR EL DE ORDENES  */
                    $sql = "UPDATE orden1_sistemas SET estado = 'Completo' WHERE folio = '".$_SESSION['folio']."'";
                    mysqli_query($link,$sql);

                    //$_SERVER["REMOTE_ADDR"]
                    $nombrehost= $_SERVER["REMOTE_HOST"];

                    $nombrePC = gethostbyaddr($_SERVER["REMOTE_ADDR"]);

                    //$nombrePC=gethostname();
                    /*Insertamos en la tabla de revision del USUARIO*/
                    $solicitud_sin_validar="INSERT INTO revisionusuario (folio,calificacion,comentarios,computadora) VALUES ('".$_SESSION['folio']."','$calificacion','$comentarios','$nombrePC')";
                    mysqli_query($link,$solicitud_sin_validar);

                    echo'<script type="text/javascript"> alert("Gracias Por Calificar!!");</script>';
            }
            else{
                echo'<script type="text/javascript"> alert("Esta Orden ya fue calificada");</script>';
            }


        }

?>


<form action="validarOrden.php" method="POST" name="form_principal" id="form_principal">
    <section class="container"> <!-- CONTENEDOR DE LA SECCION CENTRAL 2 -->

            <div class="item"><!-- TERCERA SECCION, ES LA SECCION DE "CHOFER" -->
                    <div class="item">
                            <h1>CALIFICAR OTRA ORDEN</h1>

                                <div class="item centrado">
                                        <input type="submit" class="botonnaranja boton"  value="Regresar" id="Regresar" name="Regresar">
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
