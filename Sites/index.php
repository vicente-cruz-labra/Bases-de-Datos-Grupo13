<?php include('templates/header.html');   ?>

<body>

  <h1 align="center">Consultas Vuelos </h1>
  
  <br>

  <div>
  <h3 align="center"> Vuelos pendientes de ser aprobados por la DGAC</h3>

  <form action="consultas/consulta1.php" method="get">
    <input type="submit" value="Buscar">
  </form>
  </div>

  <br>
  <br>
  <br>

  <h3 align="center"> 2. Vuelos aceptados por cierta aerolínea que
tienen como destino el aeródromo del código</h3>

    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("config/conexion.php");

    #Se construye la consulta como un string
    $query = "SELECT nombre_compania FROM compania;";

    #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
    $result = $db -> prepare($query);
    $result -> execute();
    $nombres_companias = $result -> fetchAll();
    ?>

  <form align="center" action="consultas/consulta2.php" method="post">
    Código ICAO:
    <input type="text" name="codigo_icao">
    <br/>
    Aerolínea:
    <select name="nombre_compania">
      <?php
        foreach ($nombres_companias as $p) {echo "<option value=$p[0]>$p[0]</option>";}
      ?>
    </select>
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> 3. Tickets asociados al código, 
junto a sus pasajeros y costos</h3>

  <form align="center" action="consultas/consulta3.php" method="post">
    Código reserva:
    <input type="text" name="codigo_reserva">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

  <h3 align="center"> 4. Por cada aerolinea, el cliente que ha comprado la mayor cantidad de tickets</h3>

  <form action="consultas/consulta4.php" method="get">
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

  <h3 align="center"> 5. Cantidad de vuelos que tienen en cada
uno de los estados la aerolínea ingresada</h3>

  <form align="center" action="consultas/consulta5.php" method="post">
    Aerolínea:
    <input type="text" name="nombre_compania">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

  <h3 align="center"> 6. Aerolínea que tiene el mayor porcentaje de vuelos aceptados</h3>

  <form action="consultas/consulta6.php" method="get">
    <input type="submit" value="Buscar">
  </form>
