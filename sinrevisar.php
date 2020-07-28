<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    date_default_timezone_set('America/Monterrey');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imagenes/inspeccion.png" type="image/png"  />

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ordenes Sin Validar</title>
    <link rel="stylesheet" href="css/ordenes.css">
    <link rel="stylesheet" href="css/panel_control.css">
    <script type="text/javascript" src="js/fecha.js"></script>
    <script type="text/javascript" src="js/fecha.js"></script>

    <style type="text/css">
        table {
          font-family: "Arial";
          font-size: 11px;
          color: black;
          }
          h1{
            font-family: "Arial";
            font-size: 18px;
            color: black;
          }
    </style>

</head>


<body>
   <h1>Ordenes sin revisar</h1>

   <div style="text-align:center;">


<!-- INICIA EL CODIGO PHP -->
<?php
        date_default_timezone_set('America/Mexico_City');
        $con=mysqli_connect("localhost", "root", "pirineos", "ordenes");

        echo " <table border='1' style='margin: 0 auto;'>";

        //fila numero 1
        echo " <tr> ";
            echo "  <td>Folio</td>";  //0
            echo "  <td>Solicitante</td>";//1
            echo "  <td>Departamento</td>";//2
            echo "  <td>descripcion</td>";//5
            echo "  <td>Hora Inicio</td>";//6
            echo "  <td>Hora Final</td>";//7
            echo "  <td>Fecha</td>";//10
            echo "  <td>Estatus</td>";//12
            echo "  <td>Tecnico</td>";//13
        echo " </tr>";

        $sql="SELECT * FROM orden1_sistemas where estado='Incompleto'";
        $resultado=mysqli_query($con,$sql);
        while($consulta = mysqli_fetch_array($resultado))
        {
            echo " <tr> ";
                echo "  <td>".$consulta[0]."</td>";  //0
                echo "  <td>".$consulta[1]."</td>";//1
                echo "  <td>".$consulta[2]."</td>";//2

                echo "  <td>".$consulta[5]."</td>";//8
                echo "  <td>".$consulta[6]."</td>";//8
                echo "  <td>".$consulta[7]."</td>";//8
                echo "  <td>".$consulta[10]."</td>";//8

                echo "  <td>".$consulta[12]."</td>";//12
                echo "  <td>".$consulta[13]."</td>";//13
            echo " </tr>";
        }

        echo "</table>";

?>

</div>

</body>
</html>
