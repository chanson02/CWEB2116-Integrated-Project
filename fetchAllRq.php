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
$userPOSTID = $_POST['id'] ?? null;
$equipmentID = $_POST['eqID'] ?? null;
$result = mysqli_query($db, "Select u.fullname, u.id, l.users_id, l.checkoutRequests_id, l.checkoutRequestDate, l.expectedReturnDate
from users u
left join log l on u.id = l.users_id
left join equipment e on l.equipment_id = e.id
where e.id = '$equipmentID' and l.returnDate IS NULL and l.users_id = '$userPOSTID' and l.checkoutDate IS NULL");

$users_arr = array();
while ($row = mysqli_fetch_array($result)) {
    $equipmentName = $row['equipment'];
    $equipmentID = $row['id'];
    $barcodeID = $row['barcodeID'];
    $fullname = $row['fullname'];
    $returnDate = $row['expectedReturnDate'];
    $fullname = $row['fullname'];
    $userID = $row['users_id'];
    $returnDate = $row['expectedReturnDate'];
    $checkoutID = $row['checkoutRequests_id'];
    $checkoutDate = $row['checkoutRequestDate'];
    $users_arr[] = array("id" => $checkoutID, "requestDate" => $checkoutDate, "returnDate" => $returnDate);
}

echo json_encode($users_arr);
