<?php
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Email = $_POST['Email'];
    $Contact = $_POST['Contact'];
    $Address = $_POST['Address'];
    
    $conn = new mysqli('localhost','root','','elib');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }
    else{
        $stmt = $conn->prepare("insert into elib(Username,Password,Email,Contact,Address)values(?,?,?,?,?)");
        $stmt->bind_param("sssis",$Username,$Password,$Email,$Contact,$Address);
        $stmt->execute();
        echo "Registration Successfull";
        $stmt->close();
        $conn->close();

    }

?>