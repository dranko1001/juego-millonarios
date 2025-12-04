<?php

require_once __DIR__ . '/../models/pdoconexion.php';

$codigo = null;
$mensaje = null;
try{
    $db= new PDOConnection();
    $conexion = $db->getConexion();
}