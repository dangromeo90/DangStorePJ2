<div class="modal fade" id="modal-add-procate">
    <div class="modal-dialog">
        <div class="modal-content form-add">
            <button type="button" class="close" data-dismiss="modal" ><img src="../img/icon/close2.jpg" width="30px"></button>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục sản phẩm</h5>
            </div>
            <div class="modal-body">
               <form action="modules/manage-productcategory/control-proCate.php?categoryid=" method="post" enctype="multipart/form-data" class="form-signup">
                    <div class="form-group ">
                      <input type="text" class="form-control" placeholder="" name="procate-name" required>
                      <label for="email">Tên danh mục</label>
                    </div>
                    <div class="wrapper-img">
                        <input type="file" name="image" id="imgInputAdd" accept="image/*" onchange="previewImage('imgInputAdd', 'img-cate-add')">
                        <label for="imgInputAdd">Chọn ảnh</label>
                    </div>
                    <div class="wrapper-img-change">
                        <img src="" id="img-cate-add" alt="" width="100px">
                    </div>
                   
                    <div class="wrapper-btn-add">
                        <input type="submit" name="btn-add" id="btn-add" value="Thêm">
                     </div>
                </form>
            </div>
        </div>
    </div>
</div>