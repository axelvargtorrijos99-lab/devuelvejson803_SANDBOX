<?php

require_once __DIR__ . "/../libservidorphp/manejaErrores.php";
require_once __DIR__ . "/../libservidorphp/recibeEnteroObligatorio.php";
require_once __DIR__ . "/../libservidorphp/validaEntidadObligatoria.php";
require_once __DIR__ . "/../libservidorphp/devuelveJson.php";
require_once __DIR__ . "/Bd.php";

$id = recibeEnteroObligatorio("id");

$bd = Bd::conexion();
$stmt = $bd->prepare("SELECT * FROM PASATIEMPO WHERE PAS_ID = :PAS_ID");
$stmt->execute([":PAS_ID" => $id]);
$modelo = $stmt->fetch(PDO::FETCH_ASSOC);

$modelo = validaEntidadObligatoria("Pasatiempo",  $modelo);

devuelveJson([
 "id" => ["value" => $id],
 "nombre" => ["value" => $modelo["PAS_NOMBRE"]],
]);
