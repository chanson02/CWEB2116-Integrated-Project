<?php
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//$equipmentID = $_POST['eqID'];
//$result = mysqli_query($db,"Select *
//from users u
//left join log l on u.id = l.users_id
//left join equipment e on l.equipment_id = e.id
//where e.id = '$equipmentID' and l.returnDate IS NULL");
//while ($row = mysqli_fetch_array($result)) {
//
//    echo $row['equipment_id'];
//    $equipmentName = $row['equipment'];
//    $equipmentID = $row['id'];
//    $barcodeID = $row['barcodeID'];
//    $fullname = $row['fullname'];
//    $returnDate = $row['expectedReturnDate'];
//    echo "<option value='$equipmentID' data-checkoutRequestsID='$equipmentID'>$fullname | Returning $returnDate </option>";
//}
//;
//};

session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: login.php');
    exit();
}
if ($_SESSION['username'] != 'administrator'){
    header('Location: index.php?adminonly=1');
}

include('serverconnect.php');
$equipmentID = $_POST['id'];
$result = mysqli_query($db,"Select distinct u.fullname, u.id, l.users_id
from users u
left join log l on u.id = l.users_id
left join equipment e on l.equipment_id = e.id
where e.id = '$equipmentID' and l.returnDate IS NULL and l.checkoutDate IS NULL");

$users_arr = array();
while ($row = mysqli_fetch_array($result)) {
    $equipmentName = $row['equipment'];
    $barcodeID = $row['barcodeID'];
    $fullname = $row['fullname'];
    $returnDate = $row['expectedReturnDate'];
    $fullname = $row['fullname'];
    $userID = $row['users_id'];
    $returnDate = $row['expectedReturnDate'];
    $users_arr[] = array("id" => $userID, "name" => $fullname, "returnDate" => $returnDate, "eqID" => $equipmentID);
}
echo json_encode($users_arr);


