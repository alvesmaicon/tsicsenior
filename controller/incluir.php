<?php
    header('Content-type: text/json');
    require '../model/Produto.php';
    require '../model/Documento.php';


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



            $cod_documento =  (int) $_POST["codigo_documento"];

            $query = "INSERT INTO item (iddocumento, idproduto) VALUES ($cod_documento, $id)";
            $result = mysqli_query($mysqli, $query);

            // UPDATING TOTAL VALUE IN DOCUMENT
            $query = "SELECT SUM(p.preco)
              FROM seniortsic.produto p
              INNER JOIN seniortsic.item i ON p.idproduto = i.idproduto
              INNER JOIN seniortsic.documento d ON i.iddocumento  = d.iddocumento 
              WHERE d.iddocumento = $cod_documento;";

            $result = mysqli_query($mysqli, $query);
            $row = mysqli_fetch_array($result);
            $preco_total = $row['SUM(p.preco)'];

            $query = "UPDATE documento SET total = $preco_total WHERE iddocumento = $cod_documento;";
            $result = mysqli_query($mysqli, $query);

            echo json_encode($cod_documento);
        } else {


            // OTHERWISE CREATE DOCUMENT WITH INCREMENTAL ID AND TOTAL OF PRODUCTS AND CONFIRMED STATUS.
            // CREATE ASSOCIATION BETWEEN PRODUCT AND DOCUMENT

            $row = mysqli_fetch_array($result);
            $total = $row['preco'];
            $confirmed = 0;


            $query = "INSERT INTO documento (total, confirmado) VALUES ($total, $confirmed)";
            $result = mysqli_query($mysqli, $query);


            $last_id = mysqli_insert_id($mysqli);

            $query = "INSERT INTO item (iddocumento, idproduto) VALUES ($last_id, $id)";
            $result = mysqli_query($mysqli, $query);

            echo json_encode($last_id);

        }
    }
    else if(isset($_POST["codigo_documento"]) && !empty($_POST["codigo_documento"]) && $result->num_rows == 0){
        $cod_documento =  (int) $_POST["codigo_documento"];
        $retorno = array('codigo' => 2, 'codigo_documento' => $cod_documento);
        echo json_encode($retorno);
    }
    else{
        $retorno = array('codigo' => 1);
        echo json_encode($retorno);

    }

mysqli_close($mysqli);
