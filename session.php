<?php
include "db.php";

session_start();
if(!isset($_SESSION['token'])){
    header("Location: adminlogin.php");
}
else{
    $tok = $_SESSION["token"];
    $sql = "SELECT token FROM otp where token = '$tok' ";
    $result = $conn->query($sql);
    if ($result->num_rows < 1) {
       session_destroy();
       header("Location: adminlogin.php");
    }


}
