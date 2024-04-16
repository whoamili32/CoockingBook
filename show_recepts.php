<?php
include "bdconnect.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT recepts.id, title, recepts.description, ingredients, instructions, date_posted, img FROM recepts, category WHERE recepts.id_cat = category.id AND recepts.id=$id";
    $result = mysqli_query($link, $sql) or die("Рецепт не найден");
    $row = mysqli_fetch_array($result);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f8f8;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

.slider {
    text-align: center;
    margin: 20px 0;
}

.tovarimg {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
}

.card {
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 20px 0;
    padding: 20px;
    border-radius: 10px;
}

.carditem {
    margin: 10px 0;
}

.cardtitle {
    font-weight: bold;
}

.cardvalue, ul {
    margin-top: 5px;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    background: #eee;
    margin: 5px 0;
    padding: 10px;
    border-radius: 5px;
}

a {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    margin-top: 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #0056b3;
}

@media (min-width: 768px) {
    .card {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .carditem {
        display: flex;
        align-items: center;
    }

    .cardtitle {
        min-width: 150px;
    }
}
body {
    font-family: Arial, sans-serif;
    background-color: #f8f8f8;
    color: #333;
    line-height: 1.6;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

.slider {
    text-align: center;
    margin: 20px 0;
}

.tovarimg {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
}

.card {
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin: 20px 0;
    padding: 20px;
    border-radius: 10px;
}

.carditem {
    margin: 10px 0;
}

.cardtitle {
    font-weight: bold;
}

.cardvalue, ul {
    margin-top: 5px;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    background: #eee;
    margin: 5px 0;
    padding: 10px;
    border-radius: 5px;
}

a {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    margin-top: 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #0056b3;
}

@media (min-width: 768px) {
    .card {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .carditem {
        display: flex;
        align-items: center;
    }

    .cardtitle {
        min-width: 150px;
    }
}
    </style>
    <title>Document</title>
</head>
<body>
    <h1>Информация о рецепте</h1>
    <div class="slider">
        <img class="tovarimg" src="images/<?php echo $row["img"] ?>" alt="Товар">
    </div>
    <div class="card">
        <div class="carditem">
            <span class="cardtitle">Номер рецепта:</span>
            <span class="cardvalue"><?php echo $row["id"] ?></span>
        </div>
        <div class="carditem">
            <span class="cardtitle">Название рецепта:</span>
            <span class="cardvalue"><?php echo $row["title"] ?></span>
        </div>
        <div class="carditem">
            <span class="cardtitle">Описание:</span>
            <span class="cardvalue"><?php echo $row["description"] ?></span>
        </div>
        <div class="carditem">
    <span class="cardtitle">Ингридиенты:</span>
    <?php
    // Разделяем ингредиенты на отдельные строки и выводим в виде списка
    $ingredientsList = explode(",", $row["ingredients"]);
    echo "<ul>";
    foreach ($ingredientsList as $ingredient) {
        echo "<li>".$ingredient."</li>";
    }
    echo "</ul>";
    ?>
</div>

        <div class="carditem">
            <span class="cardtitle">Инструкция по приготовлению:</span>
            <span class="cardvalue"><?php echo $row["instructions"] ?></span>
        </div>
        <div class="carditem">
            <span class="cardtitle">Дата публикации:</span>
            <span class="cardvalue"><?php echo $row["date_posted"] ?></span>
        </div>
       
    </div> 
    <a href="index.php">На главную</a>
</body>
</html>



