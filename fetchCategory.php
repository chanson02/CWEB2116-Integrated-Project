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

include("serverconnect.php");

$categoryid = $_POST['categoryID'];

$query = "SELECT * FROM EqManage.categories WHERE id=".$categoryid;

$result = mysqli_query($db, $query);

$html = '<div>';
while($row = mysqli_fetch_array($result)) {
    $name = $row['categoryName'];

    $html .= "<span class='head'>Category Name : </span><span>".$name."</span><br/>";

}
$html .= '</div>';

echo $html;
