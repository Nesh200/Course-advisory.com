<?php
session_start();
$id = $_SESSION['id'];
// Create connection
include 'db.php';
$sql = 'SELECT student_id,math,languages,applied,science,likes,liked_institution,specific_liked_course FROM students WHERE student_id =' . $id;
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // If not using tables
        // PHP allows you to call fetch_assoc() on a result only once
        $result_student = $result->fetch_assoc();
        print_r($result_student);
    } else {
        echo "0 results";
    }

} else {
    echo "Error in " . $result . "<br>" . $result;
}
$liked_institution = $result_student['liked_institution'];
echo "<br/>";
echo $liked_institution;
$conn->close();
include "check_university_entry.php";
if ($studgrade >= 7) {
    $sql1 = "SELECT inst_code, inst_name, institution_full_names FROM institution WHERE inst_name ='$liked_institution' ";
    $result_org_query = $conn->query($sql1);
    $result_org_fname = $result_org_query->fetch_assoc();

    $inst_full_name = $result_org_fname['institution_full_names'];
    print_r($inst_full_name);
   // include "grade_calculations.php";
    if ($result_org_query->num_rows > 0) {
        $institution_code = $result_org_fname['inst_code'];
        $liked_course = $result_student['specific_liked_course'];
        $sql2 = "SELECT course_code, course_name, course_cluster, cartegory FROM courses WHERE course_code LIKE '$institution_code%' AND course_name = '$liked_course' AND course_cluster <= $total_cluster";
        $coursesin_liked_inst = $conn->query($sql2);
        echo "<br/>";
        //echo $liked_course;
        if ($coursesin_liked_inst->num_rows > 0) {
            echo "<br/>";
            echo " The institution you have selected offers a courses that you selected and you have met the cluster point";
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <title>Register</title>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <style>
                    body, html {
                        height: 100%;
                        margin: 0;
                    }

                    .bg {

                        /* Full height */
                        height: 100%;

                        /* Center and scale the image nicely */
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }

                    table {
                        font-family: arial, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                    }

                    td, th {
                        border: 1px solid #dddddd;
                        text-align: left;
                        padding: 8px;
                    }
                </style>
            </head>
            <body>
            <div class="bg">
                <table>
                    <tr>
                        <th style="width: 30%">course code</th>
                        <th style="width: 30%">Course name</th>
                        <th style="width: 30%">Course cluster</th>
                        <th style="width: 30%">Course category</th>
                    </tr>
                    <?php
                    while ($row = $coursesin_liked_inst->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['course_code']; ?></td>
                            <td><?php echo $row['course_name']; ?></td>
                            <td><?php echo $row['course_cluster']; ?></td>
                            <td><?php echo $row['cartegory']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <p><a href="courses_offeredin_likedinst.php"> Want to see other courses same faculty that you have met the cluster point in the same institution? </a>| <a href="othersame_courses.php">Want to see courses of same faculty that you have met the cluster point in diffrent institutions? </a></p>
            </div>
            </body>
            </html>
            </body>
            </html>
            <?php
            //} else {
            // echo "liked institution does not offer liked course ";
            //}
            //header("Location: courses_offeredin_likedinst.php");
        } else {
            //$cartegory = $result_student['likes'];
           // $sql3 = "SELECT course_code, course_name, course_cluster, cartegory FROM courses WHERE cartegory = '$cartegory' AND course_name = '$liked_course' AND course_cluster <= $total_cluster";
            echo "Your prefered institution does not offer any course of your liking";
            header ("Location: courses_offeredin_likedinst.php");
        }
    } else {
        header("Location: no_liked_institution.php");
    }

} else {
    header("Location: gradefailed.php");
    echo " you have failed";
}
$conn->close();
?>