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

header("Location: ../index.html");
exit();


