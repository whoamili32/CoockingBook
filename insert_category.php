<?php
include "bdconnect.php";
$name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
$sql="INSERT INTO category (name, description) VALUES 
('$name','$description')";
$result = mysqli_query($link,$sql) or die("Query failed");
Header("Location: uspex.php?i=1");
?>