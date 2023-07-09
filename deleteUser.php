<?php

function deleteUser($email, $password)
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
        $stmt = $conn->prepare("DELETE FROM users where email= ? && password= ?");

        if (!$stmt)
            return json_encode(array("status" => 0, "message" => "Prepare statement failed"));
 

        // Bind parameters to the statement
        $stmt->bind_param("ss", $email, $password);

        // Execute the statement
        if ($stmt->execute() === TRUE)
        {
             // Get the result
             $result = $stmt->get_result();

             if ($result->num_rows > 0) 
             {
                 // Fetch all user rows
                 $users = array();
                 while ($row = $result->fetch_assoc())
                 {
                     $users[] = $row;
                 }
 
                 // Return the response with the list of users
                 return json_encode(array("status" => 1, "message" => "Users Extracted Successfully", "data" => $users));
             } 
             else 
             {
                 return json_encode(array("status" => 0, "message" => "No users found"));
             }
        }
           
        else
            return json_encode(array("status" => 0, "message" => "User Deletion Unsuccessful" ));
    } 
    
    
    catch (Exception $e) 
    {
        echo "Error: " . $e->getMessage();
    }

    finally {
        // Debug statement: Print the prepared statement with parameters
        $preparedQuery = str_repeat('?, ', $stmt->param_count);
    $preparedQuery = rtrim($preparedQuery, ', ');
    echo "Prepared statement: {$stmt->sql} ($preparedQuery)";
        // Close the statement and the connection
        $stmt->close();
        $conn->close();
    }
}
?>