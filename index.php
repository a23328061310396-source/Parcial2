<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POKEMON</title>
    <style>
        body {
          background-color: #548fc0;
          color: white;
          font-family: 'Arial', sans-serif;
          padding: 2em;
        }

        h1 {
          text-align: center;
          margin-bottom: 30px;
        }

        table {
          width: 100%;
          margin-top: 20px;
          background-color: white;
          color: black;
          border-collapse: collapse;
        }

        th, td {
          border: 1px solid #333;
          padding: 10px;
          text-align: center;
        }

        th {
          background-color: #2c3e50;
          color: white;
        }

        .img-pokemon {
            max-width: 60px;
            height: auto;
        }

        .historia {
            text-align: justify;
        }
    </style>
</head>
<body>
    <h1>POKEMON</h1>

    <?php 
    // Datos de conexión
    $servername = "localhost";
    $username = "root";
    $password = "";
    $basededatos = "pokecagada"; // nombre de la base de datos

    // Crear conexión
    $conexion = new mysqli($servername, $username, $password, $basededatos);

    // Verificar conexión
    if ($conexion->connect_error) {
        die("La conexión a la base de datos falló: " . $conexion->connect_error);
    }

    // Consulta SQL
    $sql = "SELECT * FROM pokecagada"; 
    $result = $conexion->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>HP</th>
                <th>Ataque</th>
                <th>Defensa</th>
                <th>Ataque Especial</th>
                <th>Defensa Especial</th>
                <th>Especial</th>
                <th>Velocidad</th>
                <th>Historia</th>
                <th>Creación</th>
                <th>Imagen</th>
              </tr>";
    
        while ($row = $result->fetch_assoc()) {
            $imagen = !empty($row['imagen'])
                ? '<img class="img-pokemon" src="data:image/jpeg;base64,'. base64_encode($row['imagen']) . '" alt="Pokemon">'
                : '<img class="img-pokemon" src="noimg.png" alt="Sin Imagen">';

            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . htmlspecialchars($row['nombre']) . "</td>
                    <td>" . htmlspecialchars($row['hp']) . "</td>
                    <td>" . htmlspecialchars($row['ataque']) . "</td>
                    <td>" . htmlspecialchars($row['defensa']) . "</td>
                    <td>" . htmlspecialchars($row['ataque_especial']) . "</td>
                    <td>" . htmlspecialchars($row['defensa_especial']) . "</td>
                    <td>" . htmlspecialchars($row['especial']) . "</td>
                    <td>" . htmlspecialchars($row['velocidad']) . "</td>
                    <td class='historia'>" . nl2br(htmlspecialchars($row['historia'])) . "</td>
                    <td>" . $row['creation'] . "</td>
                    <td>" . $imagen . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron registros en la base de datos.</p>";
    }

    $conexion->close();
    ?>
</body>
</html>
