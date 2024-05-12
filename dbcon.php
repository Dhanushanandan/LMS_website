<?php

//creating a database connection
$con = mysqli_connect("localhost", "root", "", "LMS");

//check connection
if (!$con) {
    die("Connection faild" . mysqli_connect_error());
}

?>