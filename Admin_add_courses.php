<?php
include "session.php";
$course_code = $_REQUEST ['Course_code'];
$course_name = $_REQUEST ['Course_name'];
$course_cluster = $_REQUEST ['Course_Cluster'];
$category = $_REQUEST ['category'];
$course_full_name = $_REQUEST ['Course_full_name'];
echo "course code is:" . "$course_code", " course name is:" . "$course_name", " course cluster is:" . "$course_cluster", " category is:" . "$category", " course full name is:" . "$course_full_name";

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
    $sql = "INSERT INTO courses (course_code, course_name, course_cluster, cartegory, course_full_name)
VALUES ('$course_code', '$course_name', '$course_cluster', '$category', '$course_full_name')";
    echo "<br/>";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully. <br/> Last inserted ID is: " . $last_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;

    }
    header("Location: Admin_add_courses.html");
}
else{
    header("Location: adminlogin.html");
}
$conn->close();