<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="center">
        <h1>E-Library</h1>
        <form method="post" action="/Elib/login.php">
            <div class="text_field">
                <label for="username"> Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="text_field">
                <label for="password">password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="btn_login">
                <button class="login">Login</button>
            </div>
            
            <div class="btn_register">New to Library
                <a href="file:///C:/Users/User/Desktop/Elib/register.html?"><Button class="register"
                        type="button">Register</Button></a>
            </div>
            </form>
       

    </div>
</body>

</html>

<?php
$conn = mysqli_connect("localhost", "root", "", "elib");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "connection successfull";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check the user's credentials using prepared statements
    $query = "SELECT * FROM libdata WHERE username=? ";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            // Password is correct, user is authenticated
            header("Location: welcome.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username.";
    }
}

mysqli_close($conn);

?>
