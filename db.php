<?php

$servername = "localhost";
$username = "root";
$password = "";


// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS `6470`";
if (mysqli_query($conn, $sql)) {
  //echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}


mysqli_close($conn);

#create table in the db
$db='6470';
$conn1=mysqli_connect($servername, $username, $password, $db);

$sqltable='CREATE TABLE IF NOT EXISTS `6470exerciseusers` (
    id INT AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash CHAR(40) NOT NULL ,
    phone CHAR(10) NOT NULL,
    PRIMARY KEY (id)
)';

if (mysqli_query($conn1, $sqltable)) {
  //echo "Table created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn1);
}



#create table in the db
//mysqli_close($conn1);

if(!$conn1)
{
    echo "cannot connect to the server";
}



?>