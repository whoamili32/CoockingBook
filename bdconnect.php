<?php
$host="localhost";
$user="root";
$pass="root";
$dbName="fymxuptv_m2";
//Создать соединение с сервером и БД
$link = mysqli_connect($host, $user, $pass, $dbName) or die (mysqli_error()); 
?>