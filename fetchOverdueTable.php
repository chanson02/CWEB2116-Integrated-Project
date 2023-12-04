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
$query = mysqli_query($db, "Select * from EqManage.log 
left join requests r on log.checkoutRequests_id = r.id
left join users u on log.users_id = u.id
left join equipment e on e.id = log.equipment_id
where returnDate is null and checkoutDate is not null");
$today = date("Y-m-d H:i:s");

while ($row = mysqli_fetch_array($query)) {
    $returnDate = $row['expectedReturnDate'];
    if (strtotime($returnDate) < strtotime($today)) {
        echo "<tr>";
        echo "<td>",$row['fullname'] ,"</td>";
        echo "<td>",$row['equipment'] ,"</td>";
        echo "<td>",$row['checkoutQty'] ,"</td>";
        echo "<td>",$row['purpose'] ,"</td>";
        echo "<td>",$row['checkoutDate'] ,"</td>";
        echo "<td>",$row['expectedReturnDate'] ,"</td>";
        echo "<td>",$row['checkoutRequests_id'] ,"</td>";
        echo "<td><button type='button' class='btn btn-link' style='padding: 0' id='confirmReturnBtn' onclick='notifyOverdue(".$row['checkoutRequests_id'].")'>Notify</button></td>";
        echo "<td><button type='button' class='btn btn-link' style='padding: 0' id='confirmReturnBtn' onclick='confirmReturn(".$row['checkoutRequests_id'].")'>Return</button></td>";
        echo "</tr>";
    }
}
