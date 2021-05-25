<?php
// php  -S 0.0.0.0:8083 -t ./
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=localhost;dbname=test', 'dev', '');

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET' :
        if (!empty($_GET['id'])) {
            $req = $pdo->prepare('SELECT c.id, c.name, p.providerName FROM cars c LEFT JOIN provider p ON c.providerId = p.id WHERE c.id=:id;');
            $req->execute(['id' => $_GET['id']]);
            echo json_encode($req->fetch(PDO::FETCH_ASSOC));
        } else {
            $req = $pdo->query('SELECT c.id, c.name, p.providerName FROM cars c LEFT JOIN provider p ON c.providerId = p.id ;');
            echo json_encode($req->fetchAll(PDO::FETCH_ASSOC));
        }
        break;
    case 'POST' :
        if (!empty($_POST['name']) && !empty($_POST['providerId'])) {
            $req = $pdo->prepare('INSERT INTO cars (name, providerId) VALUES (:name, :providerId);');
            if ($result = $req->execute(['name' => $_POST['name'], 'providerId' => $_POST['providerId']])) {
                echo json_encode(['result' => 'OK', "id" => $pdo->lastInsertId()]);
            } else {
                echo json_encode(['result' => 'NOT OK']);
            }
        } else {
            echo json_encode(['result' => 'NOT OK', 'reason' => "empty fields"]);
        }
        break;
    case 'PUT' :
        break;
    case 'DELETE' :
        break;
}

//$req = $pdo->query('SELECT c.id, c.name, p.providerName FROM cars c LEFT JOIN provider p ON c.providerId = p.id ;');
//$allCars = $req->fetchAll(PDO::FETCH_ASSOC);
//
//
//var_dump($allCars);
