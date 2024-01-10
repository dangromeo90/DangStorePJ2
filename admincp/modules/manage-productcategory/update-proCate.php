<?php 
     $sql = "SELECT * FROM productcategory WHERE categoryid = '$_GET[categoryid]'";
     $result = mysqli_query($conn, $sql);
     $row = mysqli_fetch_array($result);
 ?>
<h4>Cập nhật danh mục sản phẩm</h4>
<div class="wrapper-form">  
    <form action="modules/manage-productcategory/control-proCate.php?categoryid=<?php echo $_GET['categoryid']; ?>" method="post" enctype="multipart/form-data" class="form-edit">
        <div class="form-group form-group-profile">
            <input type="text" class="form-control" placeholder="" name="procate-name" value="<?php echo $row['categoryname']?>" required>
            <label for="email">Tên danh mục</label>
        </div>
        <div class="wrapper-img">
            <input type="file" name="image" id="imgInputUpdate" accept="image/*" onchange="previewImage('imgInputUpdate', 'img-cate-update')">                            
            <label for="imgInputUpdate">Chọn ảnh</label>
       </div>
       <div class="wrapper-img-change">
       <img src="../img/category/<?php echo $row['image'] ?>" id="img-cate-update" alt="" width="100px">
        </div>
        <div class="wrapper-btn-add">
            <input type="submit" name="btn-update-cate" id="btn-add" value="Cập nhật">
        </div>  
    </form>
</div>

<style>
    .form-edit{
        width: 50%;
        padding: 40px;
        margin-top: 20px;
        box-shadow: 0 0 4px rgb(241, 6, 81);
    }

</style>
<!-- <div class="modal fade" id="modal-update-procate">
    <div class="modal-dialog">
        <div class="modal-content form-add">
            <button type="button" class="close" data-dismiss="modal" ><img src="../img/icon/close2.jpg" width="30px"></button>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật danh mục sản phẩm</h5>
            </div>
            <div class="modal-body">
            <form action="modules/manage-productcategory/control-proCate.php?categoryid=" method="post" enctype="multipart/form-data" class="form-signup">
            <input type="text" class="form-control" placeholder="" name="procate-name" value="" required>
                      <label for="email">Tên danh mục</label>
                   
                    <div class="wrapper-img">
                        <div class="chose-img">
                        <input type="file" name="image" id="imgInputUpdate" accept="image/*" 
                        onchange="previewImage('imgInputUpdate', 'img-cate-update')">                            
                        <label for="imgInputUpdate">Chọn ảnh</label>
                       
                    </div>
                        <div class="wrapper-img-change">
                        <img src="img/category/" id="img-cate-update" alt="" width="100px">
                        </div>
                    </div>
                    <div class="wrapper-btn-add">
                        <input type="submit" name="btn-update-cate" id="btn-add" value="Cập nhật">
                     </div>
                </form>
               
            </div>
        </div>
    </div>
</div> -->
