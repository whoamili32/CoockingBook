<?php
$i=0;
$i=$_GET["i"];
if($i==1) $st="данные успешно добавлены";
if($i==2) $st="записи успешно удалены";
if($i==3) $st="записи успешно обновлены";
?>
<table border=0 width=100% >
<tr align=center>
 <td><br><br><br><br><br><br><br><br>
 <H4 class="big"><?php echo $st ?></H4> </td>
</tr>
</table>
<a href="index.php">На главную</a>