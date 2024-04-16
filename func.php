<?php
//Вывод категорий из БД – таблицы categories и добавление их в тег "<option>
 function show_categories(){
include "bdconnect.php";
$sql="SELECT * FROM category";
$result = mysqli_query($link,$sql) or die("Query failed");
while( $row=mysqli_fetch_array($result)){
$array_category[$row["id"]]=$row["name"];
};
$str="";
foreach($array_category as $key => $value){
$str=$str. "<option value='".$key."' >".$value."</option>";
}
return $str;
 }
 

 function show_orders($id_user){
    include "bdconnect.php";
    //вывод всех товаров без имени, только идентификатор товара
    // $sql="SELECT * FROM orders WHERE orders.id_user=$id_user";
    //вывод всех товаров по наименованию
    $sql="SELECT title, id_cat, description, ingredients, instructions, author_id,date_posted FROM recepts,users WHERE users.id=$id_user AND recepts.author_id=$id_user";
    echo $sql;
    $result = mysqli_query($link,$sql) or die("Query failed");
    $str="";
    while( $row=mysqli_fetch_array($result)){
    $str=$str."<tr>
    <td>".$row["title"]."</td>
    <td>".$row["id_cat"]."</td>
    <td>".$row["description"]."</td>
    <td>".$row["ingredients"]."</td>
    <td>".$row["author_id"]."</td>
    <td>".$row["date_posted"]."</td>

    <td><a href='tovar.php?id=".$row["id_tovar"]."'>Подробнее</a></td>
    </tr>";
    };
    echo $str;
}


function show_tovars() {
    include "bdconnect.php";
   
    //все
    $sql="SELECT recepts.id, title, description, ingredients, instructions, author_id, date_posted FROM recepts, category WHERE recepts.id_cat=category.id";
    //категории
    if (isset($_POST['filtr'])) {
        $category=$_POST["category"];
        if($category=="Все"){
            $sql = "SELECT recepts.id, title, description, ingredients, instructions, author_id, date_posted FROM recepts, category WHERE recepts.id_cat=category.id"; 
        } else {
            $sql = "SELECT recepts.id, title, description, ingredients, instructions, author_id, date_posted FROM recepts, category WHERE recepts.id_cat=category.id=$category";
        }
    }
    // //по цене
    // if (isset($_POST["sort"])) {
    //     $cena = $_POST["cena"];
    //     if ($cena == "0") {
    //         $sql = "SELECT tovars.id, name, category, cena, kol, srok, img FROM tovars, categories WHERE tovars.id_cat = categories.id";
    //     }
    //     if ($cena == "min") {
    //         $sql = "SELECT tovars.id, name, category, cena, kol, srok, img FROM tovars, categories WHERE tovars.id_cat = categories.id ORDER BY cena";
    //     }
    //     if ($cena == "max") {
    //         $sql = "SELECT tovars.id, name, category, cena, kol, srok, img FROM tovars, categories WHERE tovars.id_cat = categories.id ORDER BY cena DESC";
    //     }
    // }
    // if (isset($_POST["searchbtn"])) {
    //     $search = $_POST["search"];
    //     $sql = "SELECT tovars.id, name, category, cena, kol, srok, img FROM tovars, categories WHERE tovars.id_cat = categories.id AND name LIKE '%$search%'";
    // }

    //запрос
    $result = mysqli_query($link, $sql) or die ("Query failed");
    $str="";
    while ($row=mysqli_fetch_array($result)){
        $id = $row[0];
        $str=$str."<tr>
        <td>".$row['id']."</td>
        <td>".$row['title']."</td>
        <td><img class='img' src='images/".$row['img']."'></td>
        <td>".$row['ingredients']."</td>
        <td>".$row['instructions']."</td>
        <td>".$row['author_id']."</td>
        <td>".$row['date_posted']."</td>
        <td><input type='checkbox' name='id[]' value='".$row["id"]."'/></td>
        </tr>";
    };
    return $str;
}
?>

