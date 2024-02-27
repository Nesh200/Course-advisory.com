<?php
//session_start();
$id = $_SESSION['id'];
include "db.php";
$sql = 'SELECT student_id,grade_stud,math,languages,applied,science,likes, liked_institution FROM students WHERE student_id =' . $id;
$result = $conn->query($sql);
$results = $result->fetch_assoc();
//print_r($results);
include "grade_calculations.php";
$studgrade = subjectPoints($results['grade_stud']);
//echo "</br>";
//echo $studgrade;
$subjectmath = $results['math'];
$subjectlanguage = $results['languages'];
$subjectapplied = $results['applied'];
$subjectscience = $results['science'];
$total_cluster= 0;
$total_cluster =  subjectPoints($subjectmath);
$total_cluster +=  subjectPoints($subjectlanguage);
$total_cluster +=  subjectPoints($subjectscience);
$total_cluster +=  subjectPoints($subjectapplied);
//echo "</br>";






