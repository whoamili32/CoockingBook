<?php
include "func.php"; //файл, который будет хранить функции для работы с БД
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Добавление категории</title>
</head>
<body>
<style>
body {
  font-family: 'Roboto', sans-serif;
  background-color: #f2f2f2;
  padding: 20px;
  color: #333;
}

input[type="text"] {
  margin-bottom: 10px;
  padding: 5px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

input[type="submit"] {
  padding: 10px 20px;
  background-color: #ff6600;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #e65c00;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.section {
  margin-bottom: 40px;
}

@media (max-width: 768px) {
  body {
    padding: 10px;
  }
}
</style>
<form action="insert_category.php" method="post" name="form1" >
Название категории <input type="text" name="name" /><br>
Описание <input type="text" name="description" /><br>
<input type="submit" name="insert" value="Добавить" >
</form>
<a href="index.php">На главную</a>
</body>
</html>