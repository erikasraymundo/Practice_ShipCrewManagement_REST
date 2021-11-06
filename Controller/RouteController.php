<?php

require_once "../Database/connection.php";

$table = "route";
$columns = ["location1", "lat1", "long1", "location2", "lat2", "long2", "distance"];

// handle the adding
if (isset($_POST["add"])) {

    $location1 = $_POST['location1'];
    $lat1 = $_POST['lat1'];
    $long1 = $_POST['long1'];
    $location2 = $_POST['location2'];
    $lat2 = $_POST['lat2'];
    $long2 = $_POST['long2'];
    $distance = $_POST['distance'];

    $values = "'$location1', '$lat1','$long1', '$location2', '$lat2', '$long2', '$distance'";

    $status = $conn->query("INSERT INTO $table (" . implode(', ', $columns) . ") VALUES ($values)");
    echo $status ? "ok" : "$conn->error";
}

// handle the displaying
if (isset($_GET["table"])) {

    $results = $conn->query("SELECT " . implode(', ', $columns) . " FROM $table");
    if ($results->num_rows > 0) {


        echo "<table class='table-data'>";
        echo "<tr class='table-header'>
                <th>$columns[0]</th>
                <th>$columns[1]</th>
                <th>$columns[2]</th>
                <th>$columns[3]</th>
                <th>$columns[4]</th>
                <th>$columns[5]</th>
                <th>$columns[6]</th>
            </tr>
        ";

        while ($row = $results->fetch_assoc()) {

            echo "<tr>";
            echo "<td>" . $row[$columns[0]] . "</td>";
            echo "<td>" . $row[$columns[1]] . "</td>";
            echo "<td>" . $row[$columns[2]] . "</td>";
            echo "<td>" . $row[$columns[3]] . "</td>";
            echo "<td>" . $row[$columns[4]] . "</td>";
            echo "<td>" . $row[$columns[5]] . "</td>";
            echo "<td>" . $row[$columns[6]] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}

// handle the displaying
if (isset($_GET["option"])) {

    $routes = $conn->query("SELECT id, location1, location2 FROM $table");
    if ($routes->num_rows > 0) {


        while ($route = $routes->fetch_assoc()) {

            echo "<option value='" . $route['id'] . "'> " . $route['location1'] . "-" . $route['location2'] . "</option>";
        }

        echo "</table>";
    }
}

// getting only one value
if (isset($_GET["distance"])) {

    $routes = $conn->query("SELECT distance FROM $table WHERE id = '" . $_GET['route_id'] . "'");
    if ($routes->num_rows > 0) {
        while ($route = $routes->fetch_assoc()) {
            echo $route['distance'];
        }
    }
}

function generateID()
{
}
