<?php include('../templates/header.html');   ?>

<body>
<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    #Se obtiene el valor del input del usuario
    $c= $_POST["codigo_reserva"];

    #Se construye la consulta como un string
    $query = "SELECT ticket.numero_ticket, cliente.nombre_cliente, cliente.pasaporte_cliente, cliente.nacionalidad_cliente, cliente.fecha_nacimiento_cliente,
    ticket.numero_asiento, ticket.clase, ticket.comida_y_maleta, costoticket.costo
    FROM reservapasajero, reserva, vueloespecifico, costoticket, cliente, ticket
    WHERE reserva.reserva_id = reservapasajero.reserva_id AND 
    reserva.codigo_reserva = '$c' AND 
    reserva.vuelo_id = vueloespecifico.vuelo_id AND
    vueloespecifico.ruta_id = costoticket.ruta_id AND 
    reservapasajero.cliente_id = cliente.cliente_id AND
    ticket.ticket_id = reservapasajero.ticket_id AND
    vueloespecifico.aeronave_id = costoticket.aeronave_id;";


    #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
    $result = $db -> prepare($query);
    $result -> execute();
    $resultado_consulta3 = $result -> fetchAll();
?>

<table>
    <tr>
    <th>CLIENTE</th>
    <th>TICKET ID</th>
    <th>ASIENTO</th>
    <th>CLASE</th>
    <th>COMIDA Y MALETA</th>
    <th>COSTO</th>
    </tr>
    
    <?php
        foreach ($resultado_consulta3 as $p) {
        echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td>
        <td>$p[5]</td><td>$p[6]</td><td>$p[7]</td></tr>";
    }
    ?>
        
</table>

<?php include('../templates/footer.html'); ?>
