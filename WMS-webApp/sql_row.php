<?php
include('config.php');
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Gets data from URL parameters.

$tid = $_POST['tid'];
$add = $_POST['add'];
$lat = $_POST['lat'];
$lng = $_POST['lon'];
$bid = $_POST['bid'];

// Inserts new row with place data.
$query = "INSERT INTO tanks (tank_id,lat,lng,b_id,tank_add)
VALUES ($tid,$lat,$lng,$bid,'$add')";


if (mysqli_query($db, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($db);
}
?>
