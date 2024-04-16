<?php 
session_start(); 
include "bdconnect.php"; 

if (isset($_SESSION["logged"]) && $_SESSION["logged"] == "1") { 
    // Проверка на администратора 
    if ($_SESSION["is_admin"] == 1) { 
        // Администратор авторизован, показываем контент для администратора 

        // Получаем список всех зарегистрированных пользователей
        $query = "SELECT * FROM users";
        $result = mysqli_query($link, $query);

    }
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 5px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

        a.btn {
            display: block;
            width: 97%;
            padding: 15px 20px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }

        a.btn:hover {
            background-color: #0056b3;
        }

        .btn-index{
            display:flex;
            justify-content: center;
        }
    </style>
    <!-- Мета-теги и стили -->
</head>
<body>
    <div class="container">
        <h1>Добро пожаловать, администратор!</h1>
        
        <h2>Список зарегистрированных пользователей:</h2>
        <ul class="user-list">
            <?php
                // Ваш код для вывода пользователей с пагинацией
                // Пример:
                $usersPerPage = 10; // Количество пользователей на странице
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Текущая страница
                
                $offset = ($currentPage - 1) * $usersPerPage; // Смещение для запроса
                
                $query = "SELECT * FROM users LIMIT $offset, $usersPerPage";
                $result = mysqli_query($link, $query);
                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>{$row['id']} - {$row['login']} - {$row['name']}</li>";
                }
                
                // Добавьте код для пагинации
                // Пример:
                $totalUsers = mysqli_num_rows(mysqli_query($link, "SELECT * FROM users"));
                $totalPages = ceil($totalUsers / $usersPerPage);
                
                echo "<div class='pagination'>";
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<a href='admin.php?page=$i'>$i</a>";
                }
                echo "</div>";
            ?>
        </ul>

        <a href="dobav_categ.php" class="btn">Создать категорию</a>
        <a href="dobav_recepts.php" class="btn">Создать рецепт</a>
        <a href="edit_product.php" class="btn">Редактировать рецепты</a>
        <!-- Добавьте другие кнопки для других функций админа -->
    </div>
    <a href="index.php" class="btn-index">На главную</a>
</body>
</html>

