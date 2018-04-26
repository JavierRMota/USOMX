<?php
$server = "localhost";
$username = "root";
$password = "Javieruchiha1";
$database = "USO_INTELIGENTE";

// Conectar
$connection = new mysqli($server, $username, $password,$database);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
/*
function consulta($sql)
{
  global $connection;
  if (!($sentencia = $connection->prepare($sql)))
      echo "Falló el query: (" . $connection->errno . ") " . $connection->error;
  if (!$sentencia->execute())
      echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
  return $sentencia->get_result();
}
function consult($sql, $tipo, $arg)
{
  global $connection;
  if (!($sentencia = $connection->prepare($sql)))
    echo "Falló la preparación: (" . $connection->errno . ") " . $connection->error;
  $sentencia->bind_param($tipo,...$arg);
  if (!$sentencia->execute())
    echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
  return $sentencia->get_result();
}
*/
?>
