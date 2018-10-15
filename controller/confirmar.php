<?php
    header('Content-type: text/json');

    ini_set('display_errors', 1);
    $mysqli = new mysqli("localhost","senior","W3i5GWGWTWRn8mul", "seniortsic");
    mysqli_set_charset($mysqli,"utf8");



    if (isset($_POST["codigo_documento"]) && !empty($_POST["codigo_documento"])){
        $id = (int) $_POST["codigo_documento"];

        $query = "UPDATE documento SET confirmado = 1 WHERE iddocumento = $id;";

        $result = mysqli_query($mysqli, $query);

        echo json_encode($result);
    }
    mysqli_close($mysqli);

