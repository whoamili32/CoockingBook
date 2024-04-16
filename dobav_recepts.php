<?php
include "func.php"; //файл, который будет хранить функции для работы с БД
include "validate_user.php";
if(isset($_SESSION["logged"]) && $_SESSION["logged"]=="1" && $_SESSION["userid"]=="1")
header("Location: profile_admin.php");
else if(isset($_SESSION["logged"]) && $_SESSION["logged"]=="1" )
{
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
</head>
<body>
<style>
body{
font-family: 'Roboto', sans-serif;
  background-color: #f2f2f2;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}

form {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}

input[type="text"],
input[type="password"] {
  
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  width: 90%;
}
input[type="submit"] {
  padding: 15px 20px;
  background-color: #ff6600;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
  width: 90%;
}

input[type="submit"]:hover {
  background-color: #e65c00;
}
</style>
<form action="insert_recipe.php" method="post" name="form1" enctype="multipart/form-data">
Название рецепта <input type="text" name="title" /><br>
Категория рецепта
<select name="id_cat">
<?php
echo show_categories(); //вывод категорий из БД
?>
</select><br>
Фотография рецепта<input type="file" name="filename"><br>
Описание <input type="text" name="description" /><br>
Ингредиенты:<br>
<ol id="ingredientList">
    <li><input type="text" name="ingredient1"></li>
    <li><input type="text" name="ingredient2"></li>
    <li><input type="text" name="ingredient3"></li>
</ol>
<button type="button" onclick="addIngredient()">Добавить еще ингредиент</button>

<script>
function addIngredient() {
    var ingredientList = document.getElementById("ingredientList");
    var newIngredient = document.createElement("li");
    var newInput = document.createElement("input");
    var numIngredients = ingredientList.getElementsByTagName("li").length + 1;
    newInput.type = "text";
    newInput.name = "ingredient" + numIngredients;
    newIngredient.appendChild(newInput);
    ingredientList.appendChild(newIngredient);
}
</script><br>
Инструкции <textarea type="textarea" name="instructions"></textarea><br>
<input type="submit" name="insert" value="Добавить рецепт">
</form>
<!-- <?php
}
else header("Location: index.php");
?> -->

<a href="index.php">На главную</a>
</body>
</html>
