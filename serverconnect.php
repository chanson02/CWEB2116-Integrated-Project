<?php

//session_start();

// initializing variables
$username = "";
$fullname = "";
$email    = "";
$errors = array();

// connect to the database
//$db = mysqli_connect('remotemysql.com', 'tgsK9nTZNV', 'UFJLMZcF2L', 'tgsK9nTZNV');
//$db = mysqli_connect('remotemysql.com', 'aJNhE8Tihv', '9gY0DX3OdL', 'aJNhE8Tihv');
$db = mysqli_connect('localhost', 'root', 'abc', 'EqManage');

// Can change admin by doing
// UPDATE users SET admin = 1 WHERE id=13;
# my user is 13, you can force me to get a notification by running
# INSERT INTO notification (target, message, status, datetime) VALUES (13, 'Notification!!!', 0, NOW());

if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
