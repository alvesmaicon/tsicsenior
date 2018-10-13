
<?php

    require '../model/Produto.php';
    require '../model/Documento.php';

    ini_set('display_errors', 1);


    $mysqli = new mysqli("localhost","senior","W3i5GWGWTWRn8mul", "seniortsic");


    if (isset($_POST["codigo_documento"]) && !empty($_POST["codigo_documento"])){
        $iddocumento = (int) $_POST["codigo_documento"];

        $query = "SELECT p.idproduto, p.descricao, p.preco
              FROM seniortsic.produto p
              INNER JOIN seniortsic.item i ON p.idproduto = i.idproduto
              INNER JOIN seniortsic.documento d ON i.iddocumento  = d.iddocumento 
              WHERE d.iddocumento = $iddocumento;";

        $result = mysqli_query($mysqli,$query);

        echo "<table>
        <tr>
        <th>Código</th>
        <th>Descrição</th>
        <th>Preço</th>
        </tr>";

        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['idproduto'] . "</td>";
            echo "<td>" . $row['descricao'] . "</td>";
            echo "<td>" . $row['preco'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "Lista vazia";
    }



mysqli_close($mysqli);


