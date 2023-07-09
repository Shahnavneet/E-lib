<?php

include "insertUser.php";
include "deleteUser.php";
include "getAllUsers.php";


//$result= insertUser("userName5", "email5", "password", 1234, "address");
$result= deleteUser("email4", 1234);
//$result= getAllUsers();

echo $result;
?>