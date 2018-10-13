
<?php

    $mysqli = new mysqli("localhost","senior","W3i5GWGWTWRn8mul", "seniortsic");


    $query = "SELECT "

    $result = mysqli_query($con,"SELECT * FROM Persons");

echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($con);

