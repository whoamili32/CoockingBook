<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <style>
    header {
      background-color: #f2f2f2;
      padding: 10px;
      text-align: right;
    }

    .button_header {
      margin-left: 10px;
      text-decoration: none;
      color: #000;
    }

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
      width: 40%;
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

    .recipe-card-button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: block; /* Изменено на block */
      font-size: 16px;
      margin-top: 10px; /* Изменено на margin-top */
      cursor: pointer;
      border-radius: 5px;
    }

    .favorite-button {
      background-color: #4CAF50;
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
    <style>
      header {
  background-color: #f2f2f2;
  padding: 10px;
  text-align: center;
}

header a {
  text-decoration: none;
  color: #333;
  margin: 0 10px;
}

header a:hover {
  color: #ff6600;
}

header form {
  margin-top: 10px;
}

header select {
  padding: 5px;
  font-size: 16px;
}

header input[type="submit"] {
  padding: 5px 10px;
  background-color: #ff6600;
  color: #fff;
  border: none;
  cursor: pointer;
}
    </style>
    <a href="registr.php">Регистрация</a>
    <a href="login.php">Авторизация</a>
    <a href="dobav_recepts.php">Добавить рецепт</a>
    <!-- Добавляем выпадающий список для выбора категории -->
    <form action="" method="post">
        <select name="category">
            <option value="">Выберите категорию</option>
            <option value="1">Супы</option>
            <option value="2">Салаты</option>
            <option value="3">Категория 3</option>
        </select>
        <input type="submit" value="Отфильтровать">
    </form>
  </header>

  <div class="recipe-cards">
    <?php
    include "bdconnect.php";
    // Если выбрана категория, обновляем запрос SQL
    if(isset($_POST['category']) && !empty($_POST['category'])) {
        $category = $_POST['category'];
        $result = mysqli_query($link, "SELECT recepts.id, title, recepts.description, ingredients, instructions, date_posted, img, name FROM recepts,category WHERE recepts.id_cat=category.id AND category.id = '$category'");
    } else {
        $result = mysqli_query($link, "SELECT recepts.id, title, recepts.description, ingredients, instructions, date_posted, img, name FROM recepts,category WHERE recepts.id_cat=category.id");
    }
    
    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='recipe-card'>";
        echo "<img src='images/".$row["img"]."' alt='Delicious Recipe'>";
        echo "<div class='recipe-card-content'>";
        echo "<h2>".$row["title"]."</h2>";
        echo "<p>".$row["description"]."</p>";
        
        // Разделяем ингредиенты на отдельные строки
        $ingredientsList = explode(",", $row["ingredients"]);
        echo "<ul>";
        foreach ($ingredientsList as $ingredient) {
            echo "<li>".$ingredient."</li>";
        }
        echo "</ul>";
        
        echo "<p>".$row["name"]."</p>";
        echo "<p>".$row["instructions"]."</p>";
        echo "<p>".$row["date_posted"]."</p>";
        echo "<a href='show_recepts.php?id=".$row["id"]."' class='recipe-card-button'>Подробнее о рецепте</a>";
        echo "<button class='favorite-button'>&#9733;</button>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>

  

  <a href="index.php">На главную</a>
</body>

</html>
