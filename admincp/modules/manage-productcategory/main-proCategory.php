<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
<?php 
$sql = "SELECT * FROM `productcategory`";
$result = mysqli_query($conn , $sql);
?>
<h4>Danh mục sản phẩm</h4>
<div class="wrapper-add">
    <button id="add"  data-toggle="modal" data-target="#modal-add-procate">
        <img src="../img/icon/plus2.jpg" alt="" width="35">
        <span>Thêm</span>
    </button>
</div>
<div class="wrapper-table">          
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Hình ảnh</th>
                <th>Quản lý</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $i = 0;
            while($row = mysqli_fetch_array($result)) {
            $i++;?>
            <tr>
                <td><?php echo $i ?></td>   
                <td><?php echo $row['categoryname']; ?></td>
                <td><img src="../img/category/<?php echo $row['image']?>" alt="" width="50"></td>
                <td>
                <form action="modules/manage-productcategory/control-proCate.php?categoryid=<?php echo $row['categoryid']; ?>" method="post"
                     onsubmit="return confirm('Bạn có chắc chắn muốn xoá không?');">
                    <button  type="submit" name="btn-delete" id='btn-delete' >
                        <img src="../img/icon/delete.png" class="img-manage" width="30">
                    </button>
                    <a href="?manage=edit&categoryid=<?php echo $row['categoryid'] ?>">
                        <img src="../img/icon/edit.jpg" alt="" class="img-manage" width="30">
                    </a>
                </form>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>
<?php include 'add-proCate.php';?>
<script>
function confirmDelete() {
    // Hiển thị hộp thoại xác nhận xoá
    var result = confirm("Bạn có chắc muốn xoá danh mục có ID   không?");
    
    // Nếu người dùng nhấn OK, form sẽ tiếp tục gửi
    // Nếu người dùng nhấn Cancel, form sẽ không được gửi
    return result;
}
</script>
