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
$query = mysqli_query($db, "Select * from EqManage.log left join EqManage.requests on requests.id = log.checkoutRequests_id where requests.state='approved' and log.checkoutDate IS NULL");
$nPending = mysqli_num_rows($query);
if ($nPending == 0) {
    echo "<h3 class=\"card-title\">0</h3>";
} else {
    echo "<h3 class=\"card-title\">".$nPending."</h3>";
}
