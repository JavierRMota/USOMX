<?php
function getCategorias()
{
  global $connection;
  $queryCategorias = $connection->query('SELECT * FROM CATEGORIAS');
  $array =array();
  if($queryCategorias->num_rows!=0)
  {
    while($filaCategorias= $queryCategorias->fetch_assoc())
    {
      $array[$filaCategorias['ID']] = $filaCategorias['NOMBRE'];
    }
  }
  return $array;

}
?>
