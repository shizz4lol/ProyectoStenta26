<?php

require_once 'Database.php'; //Incluye la clase 'Database'

// Crea objeto
$database = new Database();
$db = $database->getConnection();

$temp_a_registrar = $_POST['temperatura'];
$id_camara_a_registrar = $_POST['id_camara'];

// sql para obtener los limites de temperaturas
$sql_limite_maximo = "SELECT temperatura FROM limites_temperaturas WHERE descripcion = 'maxima'";
$stmt = $db->prepare($sql_limite_maximo);
$stmt->execute();
$temp_MAXIMA = $stmt->fetch(PDO::FETCH_ASSOC);

$sql_limite_minimo = "SELECT temperatura FROM limites_temperaturas WHERE descripcion = 'minima'";
$stmt = $db->prepare($sql_limite_minimo);
$stmt->execute();
$temp_MINIMA = $stmt->fetch(PDO::FETCH_ASSOC);

// sql para registrar la temperatura
$sql = "INSERT INTO temperatura(temp, id_camara) VALUES ($temp_a_registrar, $id_camara_a_registrar)";
$stmt = $db->prepare($sql);
$stmt->execute();

if ($temp_a_registrar > $temp_MAXIMA) {
    $respuesta_final = "La temperatura supera la temperatura maxima normativa";

} else if ($temp_a_registrar < $temp_MINIMA) {
    $respuesta_final = "la temperatura es menor a la temperatura minima normativa";
    
} else {
    $respuesta_final = "Temperatura normal";
}

echo $respuesta_final;

?>
