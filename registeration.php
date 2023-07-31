<?php

$db = mysqli_connect("localhost", "root", "", "elib");

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $stmt = $db->prepare("INSERT INTO `libdata` (`username`, `password`, `email`, `contact`, `address`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $email, $contact, $address);
    $result = $stmt->execute();

    if ($result) {
        echo "Registration is successful";
        header("Location: registeration.php");
        exit(); 
    } else {
        echo "Registration unsuccessful due to -->" . $stmt->error;
    }

    $stmt->close();
}

?>

<!DOCTYPE html> 
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="container">
        <h2>E Library</h2>
        <div class="col-form">
            <form class="row g-3" action="/Elib/registeration.php" method="post">
                <div class="inputs">
                    <label for="inputEmail4" class="form-label">UserName</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="UserName" name="username">
                </div>
                <div class="inputs">
                    <label for="inputPassword4" class="form-label">Password </label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password">
                </div>
                <div class="inputs">
                    <label for="inputPassword4" class="form-label">Email </label>
                    <input type="Email" class="form-control" id="inputPassword4" placeholder="XYZ@xyz.com" name="email">
                </div>
                <div class="inputs">
                    <label for="inputCity" class="form-label">Conatct</label>
                    <input type="text" class="form-control" id="inputCity" placeholder="Mobile no." name="contact">
                </div>
                <div class="inputs">
                    <label for="inputAddress" class="form-label"> Permanent Address</label>
                    <textarea class="add" rows="8" cols="40" placeholder="Please enter your Address" name="address"></textarea>
                </div>
        </div>
       <div class="col-upload">
            <input type="file" id="file" accept="image/*" hidden>
          <div class="img-area" data-img="">
            <label for="file" class="file-label">
            <i class='bx bxs-cloud-upload icon'></i>
            <h3>Upload Photo</h3>
            <p>Image size must be less than 
            <span>2MB</span></p>
            </label>
            <img id="preview-image" src="#" alt="Uploaded Image" style="display: none;">
          </div>
          <button class="select-image">Select Image </button>
        </div>
        <div class="col-reg">
        <button class="register" name="register">Register</button>
        </div> 
    </div>
    <script src="register.js"></script>
</form>
</body>

</html>