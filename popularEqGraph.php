<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
} // silence a warning
if(!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}
if (!$_SESSION['admin']) {
    header('Location: index.php?adminonly=1');
    exit(); // silence `headers already set` warning
}

$dataPoints = array();

include('serverconnect.php');
$equipmentID = $_POST['id'] ?? null;
$result = mysqli_query($db, "select * from EqManage.equipment order by popularity");
while ($row = mysqli_fetch_array($result)) {
    $popularity = $row['popularity'];
    $name = $row['equipment'];
    array_push($dataPoints, array("label" => $name, "y" => $popularity));
}
echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
