<?php

require_once __DIR__ . "/../libservidorphp/manejaErrores.php";
require_once __DIR__ . "/../libservidorphp/recibeTextoObligatorio.php";
require_once __DIR__ . "/../libservidorphp/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";

$nombre = recibeTextoObligatorio("nombre");

$bd = Bd::conexion();
$stmt = $bd->prepare(
 "INSERT INTO PASATIEMPO (
    PAS_NOMBRE
   ) values (
    TRIM(:PAS_NOMBRE)
   )"
);
$stmt->execute([
 ":PAS_NOMBRE" => $nombre
]);
$id = $bd->lastInsertId();

$query = http_build_query(["id" => $id]);
devuelveCreated(
 "/api/pasatiempo-vista-modifica.php?$query",
 [
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
 ]
);
