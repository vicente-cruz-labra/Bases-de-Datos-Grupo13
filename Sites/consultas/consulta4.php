<?php include('../templates/header.html');   ?>

<body>
<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    #Se construye la consulta como un string
    $query = "SELECT compania.compania_id, compania.nombre_compania, cliente.cliente_id,
    cliente.nombre_cliente, a.compras
FROM cliente, compania, (
  SELECT a.compania_id as compania_id, MAX(a.compras) as max
  FROM cliente, (
      SELECT reserva.cliente_id as cliente_id, 
             compania.compania_id as compania_id, COUNT(*) as compras
      FROM reserva, compania, vueloespecifico, vuelogenerico, reservapasajero
      WHERE reserva.vuelo_id = vueloespecifico.vuelo_id and
            vueloespecifico.codigo_vuelo = vuelogenerico.codigo_vuelo and 
            vuelogenerico.compania_id = compania.compania_id  AND
            reservapasajero.reserva_id = reserva.reserva_id
      GROUP BY compania.compania_id, reserva.reserva_id 
     )as a 
  WHERE a.cliente_id = cliente.cliente_id
  GROUP BY a.compania_id) as b,
  (SELECT reserva.cliente_id as cliente_id, compania.compania_id 
          as compania_id, COUNT(*) as compras
      FROM reserva, compania, vueloespecifico, vuelogenerico, reservapasajero
      WHERE reserva.vuelo_id = vueloespecifico.vuelo_id and
            vueloespecifico.codigo_vuelo = vuelogenerico.codigo_vuelo and 
            vuelogenerico.compania_id = compania.compania_id  AND
            reservapasajero.reserva_id = reserva.reserva_id
      GROUP BY compania.compania_id, reserva.reserva_id) as a
WHERE  compania.compania_id = b.compania_id AND 
    a.compras = b.max AND a.compania_id = b.compania_id AND   
    a.cliente_id = cliente.cliente_id
ORDER BY compania.compania_id ;";

    #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
    $result = $db -> prepare($query);
    $result -> execute();
    $resultado_consulta4 = $result -> fetchAll();
?>

<table>
    <tr>
    <th>COMPAÑIA ID</th>
    <th>NOMBRE COMPAÑIA</th>
    <th>CLIENTE ID</th>
    <th>NOMBRE CLIENTE</th>
    <th>COMPRAS</th>
    </tr>

    
    <?php
    foreach ($resultado_consulta4 as $p) {
    echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td></tr>";
    }
    ?>
        
</table>

<?php include('../templates/footer.html'); ?>

