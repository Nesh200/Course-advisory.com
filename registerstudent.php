<?php

$name = $_REQUEST ['name'];
$grd = $_REQUEST['grade'];
$math = $_REQUEST ['math'];
$languages = $_REQUEST ['languages'];
$applied = $_REQUEST ['applied'];
$science = $_REQUEST ['science'];
$likes = $_REQUEST ['Likes'];
$specific_liked_course = $_REQUEST ['specific_liked_course'];
$liked_institution = $_REQUEST ['liked_institution'];
session_start();
$id_session = $_SESSION["id"];

echo "My name is:" . "$name", "My math is:" . "$math", "My languages is:" . "$languages", "My applied is:" . "$applied", "My science is:" . "$science", "My likes is:" . "$likes", "My liked_institution is:" . "$liked_institution", "My specific liked course is:" . "$specific_liked_course";

include 'db.php';


$sql = "INSERT INTO students (student_name, grade_stud, math, languages, applied, science, likes, specific_liked_course, liked_institution)
VALUES ('$name', '$grd','$math', '$languages', '$applied', '$science', '$likes', '$specific_liked_course', '$liked_institution')";
echo "<br/>";
if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "New record created successfully. <br/> Last inserted ID is: " . $last_id;
    $id_session = $last_id;

    $_SESSION["id"] = $id_session;
    echo "<br/>";
    echo "Session test" . $id_session;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;

}
if (isset($_REQUEST["id"])) {
    $id_session = $last_id;
    session_start();
    $_SESSION["id"] = $id_session;
} else {
    echo "you are not in a session";
}

$conn->close();
header("Location: check_qualification.php");