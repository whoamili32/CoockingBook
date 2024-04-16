<?php
include "bdconnect.php"; // Подключение к базе данных

if(isset($_POST["reg"])){
 $name=htmlspecialchars($_POST["name"]);
 $login=htmlspecialchars($_POST["login"]);
 $password=htmlspecialchars($_POST["password"]);
 $hash=password_hash($password,PASSWORD_BCRYPT);
 $q=mysqli_query($link,"SELECT * FROM users WHERE login='".$login."'");
 $nq=mysqli_num_rows($q);
 if($nq==0){
    $sql="INSERT INTO users (login, hash, name) VALUES ('$login','$hash','$name')";
    $result=mysqli_query($link,$sql);
    $_SESSION["logged"] = 1;
    $sql="SELECT max(id) FROM users";
    $result=mysqli_query($link,$sql);
    $mfq=mysqli_fetch_array($result);
    $_SESSION["userid"] = $mfq[0];
    Header("Location: login.php");
 }else {
    echo "Логин уже занят";
 }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Регистрация</title>
</head>
<body>
<style>
   body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  padding: 20px;
}

form {
  max-width: 300px;
  margin: 0 auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
  width: calc(100% - 22px);
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

input[type="submit"] {
  width: calc(100% - 22px);
  padding: 10px;
  margin-bottom: 10px;
  border: none;
  border-radius: 3px;
  background-color: #007bff;
  color: #fff;
}

a.submit_login {
  display: block;
  text-align: center;
  text-decoration: none;
}
 </style>
 <form action="registr.php" method="post">
 <label for="login">Логин</label>
 <input type="text" name="login" id="login" autocomplete="on" required>
 <label for="name">Имя</label>
 <input type="text" name="name" id="name" autocomplete="on" required>
 <label for="password" >Пароль</label>
 <input type="password" name="password" id="password" autocomplete="current-password" required>
 <input type="submit" value="Зарегистрироваться" name="reg">
 <a href="login.php" class="submit_login" name="login">Авторизироваться</a>
 </form>
</body>
</html>
