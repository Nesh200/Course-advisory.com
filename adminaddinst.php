<?php
include "session.php";
$inst_code = $_REQUEST ['instcode'];
$inst_name = $_REQUEST ['instname'];
$inst_full_name = $_REQUEST ['Inst_full_name'];

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "advisory_new";

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully <br/>";

if(isset($_SESSION['token'])) {
    $sql = "INSERT INTO institution (inst_code, inst_name, institution_full_names)
VALUES ('$inst_code', '$inst_name',  '$inst_full_name')";
    echo "<br/>";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully. <br/> Last inserted ID is: " . $last_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;

    }
    header("Location: adminaddinst.html");
}
else{
    header("Location: adminlogin.html");
}
$conn->close();