<?php

$db_host = 'ID396978_watergroep1997.db.webhosting.be';
$db_user = 'ID396978_watergroep1997';
$db_password = 'rootpass1997';
$db_db = 'ID396978_watergroep1997';
$db_port = 3306;


$db_host = '127.0.0.1';
$db_user = 'root';
$db_password = 'root';
$db_db = 'watergroep';
$db_port = 3307;

try {
    $pdo = new PDO('mysql:host=' . $db_host . '; port=' . $db_port . '; dbname=' . $db_db, $db_user, $db_password);
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}

function getData()
{


    global $pdo;

    $sql = "SELECT * FROM watergroep_klanten ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();


    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


    return $results;
};


function checkData($id)
{


    global $pdo;

    $sql = "SELECT * FROM watergroep_klanten WHERE id=:id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);

    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);


    return $results;
}


$dataAll = getData();


function sendData($meterstand, $id)
{
    global $pdo;

    $data = [
        'meterstand' => $meterstand,
        'watergroep_klanten_id' => $id,
    ];



    $sql = "INSERT INTO watergroep_inzendingen (meterstand, watergroep_klanten_id) VALUES (:meterstand,:watergroep_klanten_id) ";
    $pdo->prepare($sql)->execute($data);
}


function previousMeterstand($id)
{


    global $pdo;

    $sql = "SELECT meterstand FROM watergroep_inzendingen WHERE watergroep_klanten_id=:id ORDER BY id DESC LIMIT 1";


    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);

    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$results) {
        false;
    } else {
        return $results;
    }
}
