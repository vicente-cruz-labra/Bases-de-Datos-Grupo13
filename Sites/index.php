<?php include('templates/header.html');   ?>

<body>

  <div class="text-center p-3 mb-2 bg-dark text-white">
        <h1>Entrega 2</h1>
  </div>

  <br>

  <div align='center' style="display: flex; flex-flow: wrap;">
    <h3 align="center"> 1. Muestre todos los vuelos pendientes de ser aprobados por la DGAC</h3>

    <form action="consultas/consulta1.php" method="get">
      <input type="submit" value="Buscar">
    </form>
  </div>

  <br>
  <br>
  <br>

  <h3 align="center"> 2. Dado un código ICAO de un aeródromo ingresado por el usuario y una aerolínea
seleccionada por el usuario, liste todos los vuelos aceptados de dicha aerolínea que
tienen como destino el aeródromo.</h3>

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

  <h3 align="center"> 3. Dado un código de reserva ingresado por el usuario, liste los tickets asociados a esta
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

  <h3 align="center"> 4. Por cada aerolinea, muestre al cliente que ha comprado la mayor cantidad de tickets</h3>

  <form action="consultas/consulta4.php" method="get">
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

  <h3 align="center"> 5. Al ingresar el nombre de una aerolínea, liste la cantidad de vuelos que tienen en cada
uno de los estados</h3>

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

  <form align="center" action="consultas/consulta5.php" method="post">
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

  <h3 align="center"> 6. Muestre la aerolínea que tiene el mayor porcentaje de vuelos aceptados</h3>

  <form action="consultas/consulta6.php" method="get">
    <input type="submit" value="Buscar">
  </form>
