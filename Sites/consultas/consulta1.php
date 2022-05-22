<?php include('../templates/header.html');   ?>

<body>
<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    #Se construye la consulta como un string
    $query = "SELECT *
    FROM vueloespecifico, vuelogenerico, compania, aeronave, costoticket 
    WHERE vueloespecifico.codigo_vuelo = vuelogenerico.codigo_vuelo AND 
    vueloespecifico.aeronave_id = aeronave.aeronave_id AND 
    vueloespecifico.ruta_id = costoticket.ruta_id AND 
    vuelogenerico.compania_id = compania.compania_id AND 
    costoticket.aeronave_id = aeronave.aeronave_id AND 
    vueloespecifico.estado = 'pendiente';";

    #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
    $result = $db -> prepare($query);
    $result -> execute();
    $resultado_consulta1 = $result -> fetchAll();
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
</tr>

    
<?php
    foreach ($resultado_consulta1 as $p) {
    echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td>
    <td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td></tr>";
}
?>
        
</table>

<?php include('../templates/footer.html'); ?>