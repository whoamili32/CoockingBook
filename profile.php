<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Личный кабинет</title>
  <style>
    /* Стили для header */
    header {
      background-color: #f2f2f2;
      padding: 10px;
      text-align: right;
    }

    header a {
      margin-left: 10px;
      text-decoration: none;
      color: #000;
    }

    /* Стили для рецептов */
    .recipe-cards {
      display: flex;
      flex-wrap: wrap;
      flex-direction: column;
    }

    .recipe-card {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      margin-bottom: 20px;
      width: 30%;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      display: flex;
    }

    .recipe-card img {
      width: 40%;
      border-radius: 5px;
      margin-right: 20px;
    }

    .recipe-card-content {
      flex: 1;
    }

    .recipe-card h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .recipe-card p {
      margin-bottom: 10px;
    }
    .favorite-button {
      background-color: #ffcc00;
      color: #fff;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      font-size: 18px;
      margin-top: auto;
    }
  </style>
</head>

<body>
  <header>
    <a href="registr.php">Регистрация</a>
    <a href="login.php">Авторизация</a>
    <a href="dobav_recepts.php">Добавить рецепт</a>
    <a href="table_recepts.php">Просмотр рецептов</a>
  </header>

  <?php

  include "bdconnect.php";
  include "func.php";
  include "validate_user.php";
  if (isset($_SESSION["logged"]) && $_SESSION["logged"] == "1") {
    $userId = $_SESSION["userid"];
    $user = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM users WHERE id = '$userId'"));
  ?>
    <h2>Вы вошли под именем, <?php echo $user["name"]; ?>!</h2>
    <div class="recipe-cards">
      <?php
      $result = mysqli_query($link, "SELECT recepts.id, title, recepts.description, ingredients, instructions, date_posted, img FROM recepts WHERE author_id = '$userId'");
      while ($row = mysqli_fetch_array($result)) {
        echo "<div class='recipe-card'>";
        echo "<img src='images/" . $row["img"] . "' alt='Delicious Recipe'>";
        echo "<div class='recipe-card-content'>";
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p>" . $row["description"] . "</p>";
        echo "<a href='show_recepts.php?id=".$row["id"]."' class='recipe-card-button'>Подробнее о рецепте</a>";
        echo "<button class='favorite-button'>&#9733;</button>";
        echo "</div>";
        echo "</div>";
      }
      ?>
    </div>
    <a href="logout.php">Выйти из аккаунта</a><br>
    <a href="index.php">На главную</a>
  <?php
  } else {
    header("Location: index.php");
  }
  ?>
</body>

</html>