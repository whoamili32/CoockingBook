<?php
session_start();
include "bdconnect.php";

// if (isset($_SESSION["logged"]) && $_SESSION["logged"] == "1")
// header("Location: profile.php");

if (isset($_POST["auth"])) {
    $login = $_POST["login"];
    $password = $_POST["password"];
    $hasErrors = false;
    $sql = "SELECT * FROM users WHERE login ='".$login."'";
    $q = mysqli_query($link, $sql);
    $nq = mysqli_num_rows($q);
    if($nq == 0){
        $hasErrors=true;
    } else if($nq == 1){
        $mfq = mysqli_fetch_array($q);
        $hash = $mfq["hash"];
        if (password_verify($password, $hash)) {
            $_SESSION["logged"] = 1;
            $_SESSION["userid"] = $mfq[0];
            Header("Location: profile.php");
        } else {
            $hasErrors = true;
        }
    }
    else $hasErrors=true;
    if ($_POST["login"] == "admin" && $_POST["password"] == "12345678") {
      // Успешная авторизация администратора
      $_SESSION["logged"] = 1;
      $_SESSION["userid"] = "admin";
      $_SESSION["is_admin"] = 1; // Устанавливаем флаг администратора
  
      Header("Location: admin.php");
  } else {
      // Проверка на обычного пользователя
      if (password_verify($password, $hash)) {
          $_SESSION["logged"] = 1;
          $_SESSION["userid"] = $mfq[0];
          Header("Location: profile.php");
      } else {
          $hasErrors = true;
      }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Вход на сайт</title>
</head>
<body>
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Войдите в свой аккаунт</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="" method="POST">
        <div>
          <label for="login" class="block text-sm font-medium leading-6 text-gray-900">Логин</label>
          <div class="mt-2">
            <input id="login" name="login" type="text" autocomplete="on" required class="block w-full p-2 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Пароль</label>
          </div>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
          <?php
          if($hasErrors){
              echo "Вы ввели неправильный логин или пароль<br>";
          }
          ?>
        <div>
          <button type="submit" name="auth" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-650 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Войти</button>
        </div>
      </form>

      <a href="registr.php">Регистрация</a><br>
      <a href="index.php">На главную</a>
    </div>
  </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>