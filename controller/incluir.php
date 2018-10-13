<?php
    header('Content-type: text/json');
    require_once '../model/Produto.php';
    require_once '../model/Documento.php';


    ini_set('display_errors', 1);
    $mysqli = new mysqli("localhost","senior","W3i5GWGWTWRn8mul", "seniortsic");

    $prod = new Produto();
    $id = (int) $_POST["cod_produto"];
    $prod->setCodigo($id);



    $query = "SELECT descricao, preco FROM produto WHERE idproduto=$id";


    $result = $mysqli->query($query,MYSQLI_STORE_RESULT);



    if ($result->num_rows > 0) {


        // IF DOCUMENT CODE IS SET, A NEW DOCUMENT IS NOT NECESSARY
        if (isset($_POST["codigo_documento"]) && !empty($_POST["codigo_documento"])){
            $cod_documento =  $_POST["codigo_documento"];

            $query = "INSERT INTO item (iddocumento, idproduto) VALUES ((int)$cod_documento, $id)";
            $result = mysqli_query($mysqli, $query);

        } else {


            // OTHERWISE CREATE DOCUMENT WITH INCREMENTAL ID AND TOTAL OF PRODUCTS AND CONFIRMED STATUS.
            // CREATE ASSOCIATION BETWEEN PRODUCT AND DOCUMENT

            $doc = new Documento();

            $total = 1;
            $confirmed = 0;

            $query = "INSERT INTO documento (total, confirmado) VALUES ($total, $confirmed)";
            $result = mysqli_query($mysqli, $query);


            $last_id = mysqli_insert_id($mysqli);

            $query = "INSERT INTO item (iddocumento, idproduto) VALUES ($last_id, $id)";
            $result = mysqli_query($mysqli, $query);

            echo json_encode($last_id);

        }
    }
    else{
        // DISPLAY ALERT OF UNEXISTENT PRODUCT
    }


