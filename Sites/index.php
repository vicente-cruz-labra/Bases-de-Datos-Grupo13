<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Biblioteca Vuelos </h1>
  <p style="text-align:center;">Aquí podrás encontrar información sobre vuelos.</p>

  <br>

  <h3 align="center"> 1. Muestre todos los vuelos pendientes de ser aprobados por la DGAC</h3>

  <form action="consultas/constulta1.php" method="get">
    <input type="submit" value="Buscar">
  </form>

  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("config/conexion.php");

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
        // echo $companias_total;
        foreach ($resultado_consulta1 as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td><td>$p[3]</td><td>$p[4]</td>
          <td>$p[5]</td><td>$p[6]</td><td>$p[7]</td><td>$p[8]</td></tr>";
      }
      ?>
      
  </table>



  <br>
  <br>
  <br>

  <h3 align="center"> 2. Dado un código ICAO de un aeródromo ingresado por el usuario y una aerolínea
seleccionada por el usuario, liste todos los vuelos aceptados de dicha aerolínea que
tienen como destino el aeródromo.</h3>

  <form align="center" action="consultas/consulta2.php" method="post">
    Código ICAO:
    <input type="text" name="codigo_icao">
    <br/>
    Aerolínea:
    <select name="nombre_compania">
      <option value="IBERIA">IBERIA</option>
      <option value="LATAM ECUADOR">LATAM ECUADOR</option>
      <option value="AEROVIAS DAP (centro/norte)">AEROVIAS DAP (centro/norte)</option>
      <option value="LAW">LAW</option>
      <option value="ETHOPIAN AIRLINES">ETHOPIAN AIRLINES</option>
      <option value="KALITTA AIR">KALITTA AIR</option>
      <option value="LACSA">LACSA</option>
      <option value="LATAM CARGO">LATAM CARGO</option>
      <option value="ALITALIA">ALITALIA</option>
      <option value="OCEANAIR">OCEANAIR</option>
      <option value="QANTAS">QANTAS</option>
      <option value="LATAM DOMESTICO">LATAM DOMESTICO</option>
      <option value="LATAM INTER">LATAM INTER</option>
      <option value="EASTERN AIRLINES">EASTERN AIRLINES</option>
      <option value="KOREAN AIR">KOREAN AIR</option>
      <option value="BRITISH">BRITISH</option>
      <option value="LATAM ARGENTINA">LATAM ARGENTINA</option>
      <option value="MARTINAIR HOLLAND">MARTINAIR HOLLAND</option>
      <option value="NO_COMPANY">NO_COMPANY</option>
      <option value="UNITED">UNITED</option>
    </select>
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> 3. Dado un código de reserva ingresado por el usuario, liste los tickets asociados a esta
junto a sus pasajeros y costos</h3>

  <h3 align="center"> 4. Por cada aerolinea, muestre al cliente que ha comprado la mayor cantidad de tickets</h3>

  <h3 align="center"> 5. Al ingresar el nombre de una aerolínea, liste la cantidad de vuelos que tienen en cada
uno de los estados</h3>

  <h3 align="center"> 6. Muestre la aerolínea que tiene el mayor porcentaje de vuelos aceptados</h3>

  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT * FROM compania;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <?php
  foreach ($dataCollected as $d) {
    echo "<b>$d[0]:$d[1]:$d[2]</b>";
  }
  ?>