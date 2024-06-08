<?php
require_once 'database.php';
$workDB = new myDBClass();
$workDB->connectDB();
$sql = "SELECT * FROM SP WHERE tt = 1";
$result = $workDB->runQuery($sql);
$result->execute();
$result1 = $result->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>Mã SP</th>
            <th>Tên SP</th>
            <th>Mô tả</th>
            <th>Giá đề xuất</th>
            <th>Giá bán</th>
            <th>Số lượng</th>
            <th>Hình</th>
            <th></th>
        </tr>
        <?php
            while($row = $result1->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$row['masp']."</td>";
                echo "<td>".$row['tensp']."</td>";
                echo "<td>".$row['mota']."</td>";
                echo "<td>".$row['giadx']."</td>";
                echo "<td>".$row['giaban']."</td>";
                echo "<td>".$row['sl']."</td>";
                echo "<td><img src='" . $row['hinh'] . "' alt='Hình sản phẩm' width='100'></td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>