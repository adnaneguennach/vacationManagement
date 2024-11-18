<?php 
$user = "root";
$password = "";
$host = "localhost";  
$dbname = "cc4";


function diffDates($date1, $date2) {
    $dateTime1 = new DateTime($date1);
    $dateTime2 = new DateTime($date2);
    $interval = $dateTime1->diff($dateTime2);
    return $interval->days;
}

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    die("Erreur: " . $e->getMessage());
}



?>

