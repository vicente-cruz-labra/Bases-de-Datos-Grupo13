<?php include('../templates/header.html');   ?>

<body>
<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    #Se obtiene el valor del input del usuario
    $c= $_POST["codigo_reserva"];

    #Se construye la consulta como un string
    $query = "SELECT reservapasajero.*
    FROM reservapasajero, reserva, vueloespecifico, costoticket
    WHERE reserva.reserva_id = reservapasajero.reserva_id AND 
    reserva.codigo_reserva = 'LAT5532-4263' AND 
    reserva.vuelo_id = vueloespecifico.vuelo_id;";

    #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
    $result = $db -> prepare($query);
    $result -> execute();
    $resultado_consulta3 = $result -> fetchAll();
?>

<table>
    <tr>
    <th>RESERVA ID</th>
    <th>CLIENTE ID</th>
    <th>TICKET ID</th>
    </tr>
    
    <?php
        foreach ($resultado_consulta3 as $p) {
        echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td></tr>";
    }
    ?>
        
</table>

<?php include('../templates/footer.html'); ?>
