<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Grupo 13 </title>
    <style>
      input {
    width: 10%;
    height: 20px;
}

input[type=text] {
    font-size: 20px;
}

input[type=submit] {
    width: 10em;
    height: 2em;
    font-size: 25px;
}

button {
    background-color: green;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 25px;
    padding: 5px;
    size: 30px;
}

h1 {
    border: black;
    background-color: black;
    color: white;
}

h1,
h2,
h3,
h4 {
    text-align: center;
}

body {
    width: 100%;
    font-size: 20px;
    text-align: center;
    background-image: url('https://fondosmil.com/fondo/31175.jpg');
}

table.center {
    margin-left: auto;
    margin-right: auto;
    border: 1px solid black;
    width: 90%;
    text-align: center;
    font-size: 20px
}

th {
    background-color: #1c27b8;
    color: white;
}

tr:hover {
    background-color: #f5f5f5;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

p {
    border: black;
    background-color: rgba(175, 170, 170, 0.75);
    padding: 40px;
}


    </style>
</head>

<body>

  <h1 align="center">Biblioteca Vuelos </h1>
  
  <p style="text-align:center;">Aquí podrás encontrar información sobre vuelos.</p>

  <br>

  <h3 align="center"> 1. Muestre todos los vuelos pendientes de ser aprobados por la DGAC</h3>

  <form action="consultas/consulta1.php" method="get">
    <input type="submit" value="Buscar">
  </form>

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
