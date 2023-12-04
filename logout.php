<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
} // silence a warning
session_destroy();
header('Location: login.php?logout=1');
