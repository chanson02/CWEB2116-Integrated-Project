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

$result = mysqli_query($db, "select distinct e.equipment, e.barcodeID, e.id
from equipment e
inner join log l
on e.id = l.equipment_id
where l.returnDate IS NULL and l.checkoutDate IS NULL");

echo "<select id=\"eqselect\" style=\"width: 100%; text-align: left;margin-bottom: 10px\" >";
echo "<option value=\"\">Select equipment</option>";

while ($row = mysqli_fetch_array($result)) {
    $equipmentName = $row['equipment'];
    $equipmentID = $row['id'];
    $barcodeID = $row['barcodeID'];
    echo "<option value='$equipmentID' data-checkoutRequestsID='$equipmentID'>$barcodeID | $equipmentName </option>";
};
echo " </select>";
echo "<script src=\"assets/js/select2.min.js\"></script>
<script src=\"assets/js/adminScript.js\"></script>";
