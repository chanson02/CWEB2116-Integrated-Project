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

include('serverconnect.php');
$equipmentID = $_POST['id'] ?? null;
$result = mysqli_query($db, "Select distinct u.fullname, u.id, l.users_id
from users u
left join log l on u.id = l.users_id
left join equipment e on l.equipment_id = e.id
where e.id = '$equipmentID' and l.returnDate IS NULL and l.checkoutDate is not null");

$users_arr = array();
while ($row = mysqli_fetch_array($result)) {
    $equipmentName = $row['equipment'];
    $barcodeID = $row['barcodeID'];
    $fullname = $row['fullname'];
    $returnDate = $row['expectedReturnDate'];
    $fullname = $row['fullname'];
    $userID = $row['users_id'];
    $returnDate = $row['expectedReturnDate'];
    $users_arr[] = array("id" => $userID, "name" => $fullname,"eqID" => $equipmentID);
}

echo json_encode($users_arr);
