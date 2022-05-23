<?php include('../templates/header.html');   ?>

<body>

<style type="text/css">
#BarraHTML {
background-color: #000;
    padding: 1px;
    position: fixed;
    width: 100%;
z-index: 10000;
}
#BarraHTML ul{
   list-style-type: none;
    
   
}
#BarraHTML li{
   display: inline;
   text-align: center;
   margin: 0 0 0 0;
}
#BarraHTML li a {
   padding: 2px 7px 2px 7px;
   text-decoration: none;
}
#BarraHTML li a:hover{
   background-color: #333333;
   color: #ffffff;
}
#texto{
padding: 60px 0 0 0;
}
   </style>
</head>

<body>

<div id="BarraHTML">
<ul>
<li><a href="#">Home</a></li>
<li><a href="#">Trabajos</a></li>
<li><a href="#">Contacto</a></li>
<li><a href="#">Blog</a></li>
</ul>
</div>


<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  $c= $_POST["codigo_icao"];
  $a = $_POST["nombre_compania"];

  #Se construye la consulta como un string
 	$query = "SELECT vueloespecifico.*, aerodromo.codigo_icao
  FROM vueloespecifico, vuelogenerico, compania, aerodromo
  WHERE vueloespecifico.codigo_vuelo = vuelogenerico.codigo_vuelo AND 
  vuelogenerico.compania_id = compania.compania_id AND 
  vueloespecifico.estado = 'aceptado' AND
  compania.nombre_compania = '$a' AND
  vuelogenerico.aerodromo_llegada_id = aerodromo.aerodromo_id AND
  aerodromo.codigo_icao = '$c';";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$resultado_consulta2 = $result -> fetchAll();
?>

<table>
  <tr>
  <th>VUELO ID</th>
  <th>CÓDIGO VUELO</th>
  <th>RUTA ID</th>
  <th>FECHA SALIDA</th>
  <th>FECHA LLEGADA</th>
  <th>AERONAVE ID</th>
  <th>VELOCIDAD</th>
  <th>ALTITUD</th>
  <th>ESTADO</th>
  <th>CÓDIGO ICAO</th>
  </tr>
  
  <?php
    foreach ($resultado_consulta2 as $p) {
    echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td>
    <td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td><td>$p[9]</td></tr>";
  }
  ?>
      
</table>

<?php include('../templates/footer.html'); ?>
