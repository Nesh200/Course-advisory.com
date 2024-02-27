<?php
include "db.php";
session_start();
$tok = $_SESSION["token"];
$sql ="DELETE FROM otp  WHERE token = '$tok'";
$result = $conn->query($sql);
session_destroy();
header("Location: adminlogin.html");