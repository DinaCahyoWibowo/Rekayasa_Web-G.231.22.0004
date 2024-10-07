<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('api/Rest.php');
$api = new Rest();

switch($requestMethod) {
    case 'POST':
        // Use $_POST to send data and call insertWisata
        $api->insertWisata($_POST);
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
?>
