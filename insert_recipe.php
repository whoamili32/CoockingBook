<?php
session_start();
include "bdconnect.php";
$title=$_POST["title"];
$description=$_POST["description"];
$ingredients=$_POST["ingredients"];
$instructions=$_POST["instructions"];
$date_posted = date("Y-m-d");
$author_id=$_SESSION["userid"];//заменить после регистрации
$id_cat=$_POST["id_cat"];
if( is_uploaded_file($_FILES["filename"]["tmp_name"]))
{
    $img=$_FILES['filename']['name'];
    move_uploaded_file
    (
        $_FILES["filename"]["tmp_name"],
        __DIR__ . DIRECTORY_SEPARATOR."images".
        DIRECTORY_SEPARATOR.$_FILES["filename"]["name"]
    );
} else{
    echo("Ошибка загрузки файла");
}
// Подготавливаем ингредиенты для добавления в базу данных
// Подготавливаем ингредиенты для добавления в базу данных
$ingredientsList = [];
for ($i = 1; isset($_POST["ingredient$i"]); $i++) {
    $ingredientsList[] = mysqli_real_escape_string($link, $_POST["ingredient$i"]);
}
$escapedIngredientsString = implode(",", $ingredientsList);

$sql = "INSERT INTO recepts (title, img, id_cat, description, ingredients, instructions, date_posted, author_id) VALUES ('$title', '$img', '$id_cat', '$description', '$escapedIngredientsString', '$instructions', '$date_posted', '$author_id')";
   

$result = mysqli_query($link, $sql) or die("Query failed");
header("Location: uspex.php?i=1");
?>
Дополни код так что бы из этого php кода ингридиенты коректно вночились и добавлялись в 