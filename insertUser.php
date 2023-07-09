<?php

function insertUser($username, $email, $password, $contact, $address)
{
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "asdfghjkl";
    $dbname = "test";

    try 
    {
        // Create connection
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);


        // Check connection
        if ($conn->connect_error) 
            return json_encode(array("status" => 0, "message" => "Connection Error"));


        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, contact, address) VALUES (?, ?, ?, ?, ?)");

        if (!$stmt)
            return json_encode(array("status" => 0, "message" => "Prepare statement failed"));


        // Bind parameters to the statement
        $stmt->bind_param("sssss", $username, $email, $password, $contact, $address);


        // Execute the statement
        if ($stmt->execute() === TRUE)
            return json_encode(array("status" => 1, "message" => "User Inserted Successfully" ));
        
        else
            return json_encode(array("status" => 0, "message" => "User Insertion Unsuccessful" ));
    } 
    
    catch (Exception $e) 
    {
        echo "Error: " . $e->getMessage();
    }

    finally
    {
        // Close the statement and the connection
        $stmt->close();
        $conn->close();
    }
}
?>
