<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $codigo_icao = $_POST["codigo_icao"];
  $nombre_compania = $_POST["nombre_compania"];
  #$codigo = intval($altura);

  #Se construye la consulta como un string
 	$query = "SELECT * FROM compania;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$companias_total = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Código</th>
    </tr>
  
      <?php
        // echo $companias_total;
        foreach ($companias_total as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
