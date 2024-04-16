<?php
include "bdconnect.php";
//Подключение к БД
//пагинация
$page = 1; // текущая страница
$kol = 4; //количество записей для вывода
if (isset($_GET['page'])){
$page = $_GET['page'];
}else $page = 1;
$art = ($page * $kol) - $kol; // определяем, с какой записи нам выводить
$res = mysqli_query($link,"SELECT COUNT(*) FROM recepts");
$row = mysqli_fetch_row($res);
$total = $row[0]; // всего записей
$str_pag = ceil($total / $kol);
/* Скрипт для удаления информации из БД */
//получаем массив идентификаторов (номеров) $mass, записи которых нужно удалить
if($_POST["ud_id"])
{
$mass=$_POST["ud_id"];
$i=0;
while($mass[$i])
{
//выполнение SQL-запроса к базе данных workers – удаление массива записей
$sql="DELETE FROM recepts WHERE id=$mass[$i]";
$result1 = mysqli_query($link, $sql) or die("Query failed");
$i++;
}
//Перенаправление пользователя на страницу uspex.php; при этом предаем параметр i=2 –

Header("Location: uspex.php?i=2");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>Склад товаров->Удаление или редактирование товара товара</title>
</head>
<body>
</body>
</html>
<h3 align="center">Список товаров</h3>
<!-- Форма для удаления и редактирования информации из БД -->
<form method="post" action=" ud_recepts.php" >
<table width="100%" border="2">
<tr>
<td>Номер</td><td>Наименование</td>
<td>Цена</td>
<td>Количество</td>
<td>Срок</td>
<td>Редактировать</td>
<td>Удалить</td>
</tr>
<?php
$result = mysqli_query($link,"SELECT * FROM recepts LIMIT $art,$kol");
while($row = mysqli_fetch_array($result))
{
$id=$row[0];
//переменная $id содержит идентификатор (номер) записи
echo "<tr>
<td>".$row["title"]."</td>
        <td><img src='images/".$row["img"]."'></td>
        <td>".$row["description"]."</td>
        <td>".$row["ingredients"]."</td>
        <td>".$row["name"]."</td>
        <td>".$row["instructions"]."</td>
        <td>".$row["date_posted"]."</td>"
?>
<a href="update.php?id=<? echo $id ?>">Редактировать</a></td><td>
<!--добавляем в таблицу столбец с флажком, каждый флажок указывает на номер записи-->
<input type=checkbox name=ud_id[] value="<? echo $id ?>">
<?php echo "</td>
</tr>";
}
?>
</table>
<?php
for ($i = 1; $i <= $str_pag; $i++){
echo "<a href=ud_recepts.php?page=".$i."> Страница ".$i." </a>";
}
?>
<! - - Кнопка «Удалить» - ->
<center><input type=submit name="ud" value=удалить></center>
</form>
<a href="index.php">На главную</a>