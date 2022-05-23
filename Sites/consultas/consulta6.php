<?php include('../templates/header.html');   ?>

<body>
<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    #Se construye la consulta como un string
    $query = "SELECT t.compania_id , a.nombre_compania, ROUND(a.aceptados * 1.0 * 100/t.todos, 2) as porcentaje
    FROM (
        SELECT compania.compania_id as compania_id, COUNT(*) as todos
        FROM compania, vuelogenerico, vueloespecifico
        WHERE vuelogenerico.codigo_vuelo = vueloespecifico.codigo_vuelo and
              vuelogenerico.compania_id = compania.compania_id
        GROUP BY compania.compania_id
         ) as t,
         (
        SELECT compania.nombre_compania as nombre_compania, compania.compania_id as compania_id, COUNT(*) as aceptados
        FROM compania, vuelogenerico, vueloespecifico
        WHERE vuelogenerico.codigo_vuelo = vueloespecifico.codigo_vuelo and
              vuelogenerico.compania_id = compania.compania_id and 
              vueloespecifico.estado = 'aceptado'
        GROUP BY compania.compania_id
        ) as a
    WHERE a.compania_id = t.compania_id
    ORDER BY porcentaje DESC LIMIT 1
    ;";

    #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
    $result = $db -> prepare($query);
    $result -> execute();
    $resultado_consulta6 = $result -> fetchAll();
?>

<table>
    <tr>
    <th>COMPAÑIA ID</th>
    <th>NOMBRE COMPAÑIA</th>
    <th>PORCENTAJE</th>
    </tr>

    
    <?php
    foreach ($resultado_consulta6 as $p) {
    echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td></tr>";
    }
    ?>
        
</table>

<?php include('../templates/footer.html'); ?>
