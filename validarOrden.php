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
    <link rel="stylesheet" href="css/style2.css">
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
            <h1>Bienvenido a la pagina para evaluar la calidad del servicio de sistemas </h1>
      </div>
      <div class="itemtitulo">
            <h1></h1>
      </div>

    </section>
   


 <!-- INICIA EL CODIGO PHP -->
 <?php
       
  ?>

<form action="comentarios.php" method="POST" name="form_principal" id="form_principal">
    <section class="container"> <!-- CONTENEDOR DE LA SECCION CENTRAL 2 -->

            <div class="item"><!-- TERCERA SECCION, ES LA SECCION DE "CHOFER" -->
                    <div class="item">
                            <h1>Ingrese su folio para evaluar</h1>
                            
                           
                                <div class="item centrado">
                                    <input class="basic-slide" type="text" id="folio" name="folio" placeholder="Folio">
                                </div>
                                
                               
                                <div class="item boton derecha">
                                        <input type="submit" class="botonnaranja" value="Enviar" id="Enviar" name="Enviar">
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
