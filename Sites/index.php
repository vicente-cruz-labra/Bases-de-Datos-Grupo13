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

  <div>
  <h3 align="center"> Vuelos aceptados de aerolíneas que tienen como destino el aeródromo</h3>

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
    <br/>
    <input type="text" name="codigo_icao">
    <br/><br/>
    Aerolínea:
    <br/>
    <select name="nombre_compania">
      <?php
        foreach ($nombres_companias as $p) {echo "<option value=$p[0]>$p[0]</option>";}
      ?>
    </select>
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  </div>
  
  <br>
  <br>
  <br>

  <div>
  <h3 align="center"> Tickets asociados al código, junto a sus pasajeros y costos</h3>

  <form align="center" action="consultas/consulta3.php" method="post">
    Código reserva:
    <br/>
    <input type="text" name="codigo_reserva">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  </div>

  <br>
  <br>
  <br>

  <div>
  <h3 align="center"> Por cada aerolinea, el cliente que ha comprado la mayor cantidad de tickets</h3>

  <form action="consultas/consulta4.php" method="get">
    <input type="submit" value="Buscar">
  </form>
  </div>

  <br>
  <br>
  <br>

  <div>
  <h3 align="center"> Cantidad de vuelos que tienen en cada uno de los estados la aerolínea </h3>

  <form align="center" action="consultas/consulta5.php" method="post">
    Aerolínea:
    <br/>
    <input type="text" name="nombre_compania">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  </div>

  <br>
  <br>
  <br>

  <div>
  <h3 align="center"> Aerolínea que tiene el mayor porcentaje de vuelos aceptados</h3>

  <form action="consultas/consulta6.php" method="get">
    <input type="submit" value="Buscar">
  </form>
  </div>
