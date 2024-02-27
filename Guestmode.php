<?php
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

$sql = "SELECT inst_code,inst_name,institution_full_names FROM institution";

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
        tr:nth-child(odd) {
            background-color: cadetblue;
        }
        tr:nth-child(even) {
            background-color: lightgrey;
        }
    </style>
</head>
<body>
<p><a href= "regitser.html">Register With Us!</a></p>
<div class="bg">
    <table>
        <tr>
            <th style="width: 30%">Institution Code</th>
            <th style="width: 30%">Institution short name</th>
            <th style="width: 30%">Institution Full name</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['inst_code']; ?></td>
                <td><?php echo $row['inst_name']; ?></td>
                <td><?php echo $row['institution_full_names']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
</body>
</html>
