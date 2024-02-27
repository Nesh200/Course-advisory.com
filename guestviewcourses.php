<?php
include "db.php";
$sql = "SELECT CourseName, CourseshortName, carrtegory FROM coursenames";

$result = $conn->query($sql);

/*if ($result->num_rows > 0) {
    // If not using tables
    // PHP allows you to call fetch_assoc() on a result only once
    while ($row = $result->fetch_assoc()) {
        echo "Firstname: " . $row["firstname"] . "  Lastname: " . $row["lastname"] . "  Email: " . $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}*/

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<title>Courses</title>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 10%;
        }

        button:hover {
            background-color: #45a049;
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
        tr:nth-child(odd) {
            background-color: cadetblue;
        }
        tr:nth-child(even) {
            background-color: lightgrey;
        }
    </style>
</head>
<body>
<button type="submit"  onclick="location.href='homepage.html'">Wanna go back Home?</button>
<div class="bg">
    <table>
        <tr>
            <th style="width: 30%">Course Name</th>
            <th style="width: 30%">Course short name</th>
            <th style="width: 30%">Cartegory</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['CourseName']; ?></td>
                <td><?php echo $row['CourseshortName']; ?></td>
                <td><?php echo $row['carrtegory']; ?></td>

            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
</body>
</html>
