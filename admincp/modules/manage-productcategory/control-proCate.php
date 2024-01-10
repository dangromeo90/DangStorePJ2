<?php
include '../../../database/database.php';

// Thêm danh mục sản phẩm
if (isset($_POST['btn-add'])) {
    $procate_name = isset($_POST['procate-name']) ? mysqli_real_escape_string($conn, $_POST['procate-name']) : '';
    $img = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

    $sql_check = "SELECT * FROM productcategory WHERE categoryname = '$procate_name'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        die('<script>alert("Thêm thất bại"); document.location= "../../?manage=pro-category"</script>');
    }

    $img_path = '';
    if ($img) {
        $upload_result = upload_img();
        $img_path = basename($img);
    }

    $sql_add = "INSERT INTO `productcategory`(`categoryname`, `image`) VALUES ('$procate_name','$img_path')";
    $result_add = mysqli_query($conn, $sql_add);

    if ($result_add) {
        echo '<script>alert("Thêm thành công"); document.location= "../../index.php?manage=pro-category"</script>';
    } else {
        die('Lỗi khi thêm dữ liệu: ' . mysqli_error($conn));
    }
}

// Sửa danh mục sản phẩm
if(isset($_POST['btn-update-cate'])){
    $procate_name = isset($_POST['procate-name']) ? mysqli_real_escape_string($conn, $_POST['procate-name']) : '';
    $img = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

    $img_path = '';
    if ($img) {
        $upload_result = upload_img();
        $img_path = basename($img);
    } else {
        $img_path = isset($_POST['img-path']) ? $_POST['img-path'] : '';
    }

    $sql = "UPDATE `productcategory` SET `categoryname`='$procate_name', `image`='$img_path' WHERE categoryid = '".$_GET['categoryid']."'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("Cập nhật thành công"); document.location= "../../index.php?manage=pro-category"</script>';
    } else {
        die('Lỗi khi cập nhật dữ liệu: ' . mysqli_error($conn));
    }
}

// Xoá danh mục sản phẩm 
if (isset($_GET['categoryid']) && isset($_POST['btn-delete'])) {
    $id = $_GET['categoryid'];

    $sql_get_info = "SELECT * FROM productcategory WHERE categoryid = '$id'";
    $result_get_info = mysqli_query($conn, $sql_get_info);
    $row = mysqli_fetch_assoc($result_get_info);

    $sql_del ="DELETE FROM productcategory WHERE categoryid = '$id'";
    $result_del = mysqli_query($conn, $sql_del);

    $cate_img = '../../../img/category/' . $row['image'];
    if (file_exists($cate_img)) {
        unlink($cate_img);
    }

    if ($result_del) {
        echo '<script>alert("Đã xoá"); document.location= "../../index.php?manage=pro-category"</script>';
    } else {
        die('Lỗi khi xoá dữ liệu: ' . mysqli_error($conn));
    }
}

mysqli_close($conn);

// Hàm upload ảnh
function upload_img()
{
    $folder = "../../../img/category/";
    $file_name = $folder . basename($_FILES['image']['name']);
    $file_format = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $ok = 1;

    if (file_exists($file_name) || $_FILES['image']['size'] > (5 * 1024 * 1024) ||
        !in_array($file_format, array("jpg", "png", "webp", "gif"))) {
        $ok = 0;
    }

    if ($ok) {
        move_uploaded_file($_FILES['image']['tmp_name'], $file_name);
    }

    return $ok;
}
?>
