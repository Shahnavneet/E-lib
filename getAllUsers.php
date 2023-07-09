<?php

function getAllUsers()
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
        $stmt = $conn->prepare("SELECT * FROM users");

        if (!$stmt)
            return json_encode(array("status" => 0, "message" => "Prepare statement failed"));


        // Bind parameters to the statement
        // $stmt->bind_param("sssss");


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
            return json_encode(array("status" => 0, "message" => "User Extraction Unsuccessful" ));
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
