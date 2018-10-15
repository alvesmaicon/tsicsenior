<?php

    ini_set('display_errors', 1);

    $mysqli = new mysqli("localhost","senior","W3i5GWGWTWRn8mul", "seniortsic");
    mysqli_set_charset($mysqli,"utf8");

    $query = "SELECT SUM(documento.total) FROM documento WHERE confirmado = 1;";

    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_array($result);
    $total = $row['SUM(documento.total)'];


    $query = "SELECT iddocumento, total FROM documento WHERE confirmado = 1;";
    $result = mysqli_query($mysqli, $query);

    echo "<br/>";
    echo "<b> Valor total: </b>" .'R$' . number_format($total, 2, ',', '.') . ".";
    echo "<br/><br/>";


    echo "<div class='border border-secondary' style='height: 350px; overflow: auto'>";
    echo "<table class='col-sm-10' style='margin: auto;'>
        <tr>
        <th>Número documento</th>
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
    echo "<td>" . "<b>Total:</b>" . "</td>";
    echo "<td>" .'R$' . number_format($total, 2, ',', '.') . "</td>";
    echo "</tr>";
    echo "</table>";
    echo "</div>";
