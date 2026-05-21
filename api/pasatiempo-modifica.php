<?php

require_once __DIR__ . "/../libservidorphp/manejaErrores.php";
require_once __DIR__ . "/../libservidorphp/recibeEnteroObligatorio.php";
require_once __DIR__ . "/../libservidorphp/recibeTextoObligatorio.php";
require_once __DIR__ . "/../libservidorphp/devuelveJson.php";
require_once __DIR__ . "/Bd.php";

$id = recibeEnteroObligatorio("id");
$nombre = recibeTextoObligatorio("nombre");

$bd = Bd::conexion();
$stmt = $bd->prepare(
 "UPDATE PASATIEMPO
   SET
    PAS_NOMBRE = TRIM(:PAS_NOMBRE)
   WHERE
    PAS_ID = :PAS_ID"
);
$stmt->execute([
 ":PAS_NOMBRE" => $nombre,
 ":PAS_ID" => $id,
]);

devuelveJson([
 "id" => ["value" => $id],
 "nombre" => ["value" => $nombre],
]);
