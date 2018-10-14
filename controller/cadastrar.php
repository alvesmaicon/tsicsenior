<?php

    require_once '../model/Produto.php';


    ini_set('display_errors', 1);

    $prod = new Produto();

    $prod->setCodigo($_POST["codigo_produto"]);
    $prod->setDescricao($_POST["descricao_produto"]);
    $prod->setPreco($_POST["preco_produto"]);

    $mysqli = new mysqli("localhost","senior","W3i5GWGWTWRn8mul", "seniortsic");

    $query = "INSERT INTO produto SET idproduto=?, descricao=?, preco=?";

    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query);
    $stmt->bind_param('ssd',$prod->getCodigo(),$prod->getDescricao(), $prod->getPreco());


    $stmt->execute();
    $stmt->close();
    $mysqli->close();


exit();



/*
    header('Content-type: text/json');
    require '../model/Produto.php';
    require '../model/Documento.php';


    ini_set('display_errors', 1);
    $mysqli = new mysqli("localhost","senior","W3i5GWGWTWRn8mul", "seniortsic");

    $id = (int)$_POST["codigo_produto"];
    $descricao = $_POST["descricao_produto"];
    $preco = $_POST["preco_produto"];

    $query = "INSERT INTO produto (idproduto, descricao) VALUES ($id, $descricao);";
    $result = mysqli_query($mysqli, $query);

    echo json_encode($result);

    $mysqli->close();
*/


