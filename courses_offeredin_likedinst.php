<?php
include "db.php";
session_start();
$id = $_SESSION['id'];
//echo $id;
include "check_university_entry.php";

$cartegory = $results['likes'];
$liked_inst = $results['liked_institution'];
$sql5 = "SELECT inst_code, inst_name FROM institution WHERE inst_name = '$liked_inst' ";
$inst_code = $conn->query($sql5);
$inst_codes = $inst_code->fetch_assoc();
$institution_code = $inst_codes['inst_code'];
//print_r($institution_code);
$sql3 = "SELECT course_code, course_name, course_cluster, cartegory, course_full_name FROM courses WHERE cartegory = '$cartegory'  AND course_cluster <= $total_cluster  AND course_code LIKE '$institution_code%'";
$same_cartegory_sinst = $conn->query($sql3);
if ($same_cartegory_sinst->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <title>Look for courses</title>
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
                <th style="width: 30%">Course Full Name</th>
                <th style="width: 30%">Course cluster</th>
                <th style="width: 30%">Course category</th>
            </tr>
            <?php
            while ($row = $same_cartegory_sinst->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['course_code']; ?></td>
                    <td><?php echo $row['course_name']; ?></td>
                    <td><?php echo $row['course_full_name']; ?></td>
                    <td><?php echo $row['course_cluster']; ?></td>
                    <td><?php echo $row['cartegory']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <p><a href="othersame_courses.php">Want to see courses of same faculty that you have met the cluster point in diffrent institutions? </a></p></p>
    </div>
    </body>
    </html>
    </body>
    </html>
    <?php
} else {
    header("Location: othersame_courses.php");
    echo "Your have not qualified for other courses in the fuculty you would like in the same institution";
}