<?php

    ini_set('display_errors', 1);

    $mysqli = new mysqli("localhost","senior","W3i5GWGWTWRn8mul", "seniortsic");

    $query = "SELECT SUM(documento.total) FROM documento WHERE confirmado = 1;";

    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_array($result);
    $total = $row['SUM(documento.total)'];


    $query = "SELECT iddocumento, total FROM documento WHERE confirmado = 1;";
    $result = mysqli_query($mysqli, $query);

    echo "<table>
        <tr>
        <th>Documento nº</th>
        <th>Valor documento</th>
        </tr>";


    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>" . $row['iddocumento'] . "</td>";
        echo "<td>" . 'R$' . number_format($row['total'], 2, ',', '.') . "</td>";
        echo "</tr>";
    }


    echo "<tr>";
    echo "<td>" . "Valor total:" . "</td>";
    echo "<td>" .'R$' . number_format($total, 2, ',', '.') . "</td>";
    echo "</tr>";
    echo "</table>";
