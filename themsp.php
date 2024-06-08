<?php
require_once 'database.php';
$workDB = new myDBClass();

function uploadHinh($inputName, $uploadDir = 'uploads/') {
    $fileTmpPath = $_FILES[$inputName]['tmp_name'];
    $fileName = $_FILES[$inputName]['name'];
    $destPath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmpPath, $destPath)) {
        return $destPath;
    } else {
        return 'Lỗi.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadedFilePath = uploadHinh('fHinh');

    if (strpos($uploadedFilePath, 'uploads/') === 0) {
        $iMaSP = $_POST['iMaSP'];
        $iTenSP = $_POST['iTenSP'];
        $iMoTa = $_POST['iMoTa'];
        $iGiaDx = $_POST['iGiaDx'];
        $iGiaBan = $_POST['iGiaBan'];
        $iSoLuong = $_POST['iSoLuong'];
        $selTT = $_POST['selTT'];
        $fHinh = $uploadedFilePath;

        $sql = "INSERT INTO SP (masp, tensp, mota, giadx, giaban, sl, tt, `hinh`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $workDB->runQuery($sql);
        $stmt->bind_param('ssssssss', $iMaSP, $iTenSP, $iMoTa, $iGiaDx, $iGiaBan, $iSoLuong, $selTT, $fHinh);

        if ($stmt->execute()) {
            echo "Thêm sản phẩm mới thành công";
        } else {
            echo "Thêm sản phẩm mới thất bại: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo $uploadedFilePath; 
    }
}

$workDB->closeDB();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
</head>
<style>
    table, th, td {
        border: 1px solid black;
        width: 300px;
        margin: 0 auto;
        padding: 5px 10px;
        background-color: gainsboro;
        color: darkblue;
        border-collapse: collapse;
        border-spacing: 0;
    }
</style>
<body>
    <form action="themsp.php" method="post" id="frmThemSP" enctype="multipart/form-data">
        <table>
            <tbody>
                <tr>
                    <td><label for="iMaSP">Mã sản phẩm: </label></td>
                    <td><input type="text" name="iMaSP" id="iMaSP" required pattern="^[A-Z]{3}[0-9]{6}$" title="Mã sản phẩm phải gồm 3 chữ cái hoa và 6 chữ số"></td>
                </tr>
                <tr>
                    <td><label for="iTenSP">Tên sản phẩm: </label></td>
                    <td><input type="text" name="iTenSP" id="iTenSP" required></td>
                </tr>
                <tr>
                    <td><label for="iMoTa">Mô tả: </label></td>
                    <td><input type="text" name="iMoTa" id="iMoTa"></td>
                </tr>
                <tr>
                    <td><label for="iGiaDx">Giá đề xuất: </label></td>
                    <td><input type="number" name="iGiaDx" id="iGiaDx" required></td>
                </tr>
                <tr>
                    <td><label for="iGiaBan">Giá bán: </label></td>
                    <td><input type="number" name="iGiaBan" id="iGiaBan" required></td>
                </tr>
                <tr>
                    <td><label for="iSoLuong">Số lượng: </label></td>
                    <td><input type="number" name="iSoLuong" id="iSoLuong" required></td>
                </tr>
                <tr>
                    <td><label for="selTT">Tình trạng: </label></td>
                   <td>
                        <select name="selTT" id="selTT">
                            <option value="1">Hiện</option>
                            <option value="0">Ẩn</option>
                        </select>
                   </td>
                </tr>
                <tr>
                    <td><label for="fHinh">Hình: </label></td>
                    <td><input type="file" name="fHinh" id="fHinh" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Thêm sản phẩm mới" name="submit">
                        <button type="reset">Xóa form</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>
