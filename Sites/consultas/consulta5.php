<?php include('../templates/header.html');   ?>

<body>
<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    #Se obtiene el valor del input del usuario
    $c= $_POST["nombre_compania"];

    #Se construye la consulta como un string
    $query = "SELECT vueloespecifico.estado, COUNT(*) as cantidad_de_vuelos
    FROM vueloespecifico, vuelogenerico, compania
    WHERE vueloespecifico.codigo_vuelo = vuelogenerico.codigo_vuelo AND
          vuelogenerico.compania_id = compania.compania_id AND
          compania.nombre_compania = '$c'
    GROUP BY vueloespecifico.estado
   ;";


    #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
    $result = $db -> prepare($query);
    $result -> execute();
    $resultado_consulta5 = $result -> fetchAll();
?>

<table>
    <tr>
    <th>ESTADO</th>
    <th>CANTIDAD DE VUELOS</th>
    </tr>
    
    <?php
        foreach ($resultado_consulta5 as $p) {
        echo "<tr><td>$p[0]</td><td>$p[1]</td></tr>";
    }
    ?>
        
</table>

<?php include('../templates/footer.html'); ?>
