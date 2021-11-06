<?php

require_once "../Database/connection.php";

$table = "ship";
$columns = ["id", "name", "speed_class", "price", "eta", "route_id"];

// handle the adding
if (isset($_POST["add"])) {

    $id = generateID();
    $name = $_POST['name'];
    $speed_class = $_POST['speed_class'];
    $price = $_POST['price'];
    $eta = $_POST['eta'];
    $route_id = $_POST['route_id'];

    $values = "'$id', '$name','$speed_class', '$price', '$eta', '$route_id'";

    $status = $conn->query("INSERT INTO $table (".implode(', ', $columns).") VALUES ($values)");
    echo $status ? "ok" : "db error: $conn->error";
}

// handle the displaying
if (isset($_GET["table"])) {

    $results = $conn->query("SELECT ".implode(', ', $columns)." FROM $table");
    if ($results->num_rows > 0) {


        echo "<table class='table-data'>";
        echo "<tr class='table-header'>
                <th>$columns[0]</th>
                <th>$columns[1]</th>
                <th>$columns[2]</th>
                <th>$columns[3]</th>
                <th>$columns[4]</th>
                <th>$columns[5]</th>
            </tr>
        ";

        while ($row = $results->fetch_assoc()) {

            echo "<tr>";
            echo "<td>".$row[$columns[0]]."</td>";
            echo "<td>".$row[$columns[1]]."</td>";
            echo "<td>".$row[$columns[2]]."</td>";
            echo "<td>".$row[$columns[3]]."</td>";
            echo "<td>".$row[$columns[4]]."</td>";
            echo "<td>".$row[$columns[5]]."</td>";
            echo "</tr>";

        }

        echo "</table>";
    }
}

function generateID() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $id = 'SHIP-';

    for ($i = 0; $i < 6; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $id .= $characters[$index];
    }

    return $id;
}