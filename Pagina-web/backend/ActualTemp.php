<?php

require_once 'Database.php';

$Database = new Database();
$db = $Database->getConnection();

//Realiza la consulta para obtener la temperatura actual (último valor registrado)
$sql = "SELECT t.valor, t.fecha, t.hora
FROM Temperatura t
JOIN Sensor s ON t.id_sensor = s.id_sensor
WHERE s.id_camara = :id_camara
ORDER BY t.fecha DESC, t.hora DESC
LIMIT 1";

//Deja preparada la consulta, la ejecuta y obtiene el resultado
$consulta = $db->prepare($sql);
$consulta->execute();

$temperatura_actual = $consulta->fetch(PDO::FETCH_ASSOC);
//Devuelve la temperatura actual en formato JSON(para que el frontend pueda procesarla fácilmente)
echo json_encode($temperatura_actual);

?>