<?php include('../templates/header.html');   ?>

<body>
<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    #Se obtiene el valor del input del usuario
    $c= $_POST["codigo_reserva"];

    #Se construye la consulta como un string
    $query = "SELECT reserva.reserva_id, reserva.codigo_reserva, reservapasajero.ticket_id,
    reservapasajero.cliente_id, costoticket.costo
    FROM reservapasajero, reserva, vueloespecifico, costoticket
    WHERE reserva.reserva_id = reservapasajero.reserva_id AND 
    reserva.codigo_reserva = '$c' AND 
    reserva.vuelo_id = vueloespecifico.vuelo_id AND 
    vueloespecifico.ruta_id = costoticket.ruta_id AND 
    vueloespecifico.aeronave_id = costoticket.aeronave_id;";

    #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
    $result = $db -> prepare($query);
    $result -> execute();
    $resultado_consulta3 = $result -> fetchAll();
?>

<table>
    <tr>
    <th>VUELO ID</th>
    <th>RUTA ID</th>
    <th>CÓDIGO VUELO</th>
    <th>AERONAVE ID</th>
    <th>FECHA SALIDA</th>
    <th>FECHA LLEGADA</th>
    <th>VELOCIDAD</th>
    <th>ALTITUD</th>
    <th>ESTADO</th>
    <th>CÓDIGO ICAO</th>
    </tr>
    
    <?php
        foreach ($resultado_consulta3 as $p) {
        echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td>
        <td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td></tr>";
    }
    ?>
        
</table>

<?php include('../templates/footer.html'); ?>
