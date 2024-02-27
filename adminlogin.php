<?php
include "db.php";

$generateOtp = function ($adminid) use ($conn) {
    $num = (rand(1000, 9999));
    $otp = $num;
    $token = uniqid();
    $sql = "INSERT INTO otp (otp,token, adminid)
VALUES ('$otp','$token', '$adminid')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    return $token;
};

session_start();
if(isset($_SESSION['token'])){

    $tok = $_SESSION["token"];
    $sql = "SELECT token FROM otp where token = '$tok' ";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        header("Location: admindashboardtest.php");
    }
    else{
        session_destroy();
    }

}
if (isset($_REQUEST["username"]) && isset($_REQUEST["password"])) {
    $email = $_REQUEST["username"];
    $password = $_REQUEST["password"];

    $result = $conn->query("SELECT * FROM admin WHERE uname = '" . $email . "' AND pwd = '" . $password . "'");


    if ($result->num_rows > 0) {
        $guest = $result->fetch_assoc();
        $token = $generateOtp($guest['adminid']);
        $conn->close();
        echo 'correct,welcome';
        session_start();
        $_SESSION['token']= $token;
        header("Location: admindashboardtest.php");
    } else {
        echo 'The username or password is incorrect!';
    }
} else {
    //echo 'Enter username and password';
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
body {
    font-family: Arial, sans-serif;
        }

        form {
    width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"], input[type="password"] {
    width: 100%;
    padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
    background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
    background-color: #45a049;
        }

        .error {
    color: red;
}
    </style>
</head>
<body>
<form autocomplete="off" action="adminlogin.php">
    <h2>Login</h2>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" autocomplete="off" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" autocomplete="off" required>
    <div class="error">
        <p id="error-message"></p>
    </div>
    <button type="submit" onclick="login()">Login</button>
    <button type="submit" onclick="location.href='homepage.html'">Home</button>
</form>

<script>
    function login() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if (username == "Nesh" && password == "Nesh") {
            document.getElementById("error-message").innerHTML = "Correct password, welcome.";
            window.location.href = "admindashboardtest.html";

        } else {
            document.getElementById("error-message").innerHTML = "Please enter a valid username and password.";
        }
    }
</script>
</body>
</html>
