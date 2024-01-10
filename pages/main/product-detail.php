<?php
$proid =$_GET['proid'];
    $sql = "SELECT * FROM product  WHERE product.productid = '$proid' " ;
    $result = mysqli_query($conn, $sql);
    $sql_cm = "SELECT * FROM comment cm, customer ct, product p WHERE cm.customerid = ct.customerid 
    AND cm.productid = p.productid AND p.productid = '$_GET[proid]'";
    $result_cm = mysqli_query($conn, $sql_cm);
    if(isset($_POST['btn-rating']) && isset($_SESSION['customerid'])){
        $customerid = $_SESSION['customerid'];
        $rating = $_POST['star'];
        $content = $_POST['comment'];
       
        // kiểm tra customerid đã có chưa.
        $sql_check = "SELECT * FROM comment WHERE customerid = '$customerid' AND productid = '$proid'";
        $result_check = mysqli_query($conn, $sql_check);
        $row_check = mysqli_num_rows($result_check);
        if($row_check == 0){
            $sql_add_cm = "INSERT INTO `comment`(`commentid`, `productid`, `customerid`, `content`, `date`, `ratingvalue`) 
                VALUES ('','$_GET[proid]',' $customerid','$content ',CURRENT_DATE,' $rating')";
            
            $result_add_cm = mysqli_query($conn, $sql_add_cm);
    
            if($result_add_cm){
                echo '<script>
                    Swal.fire({
                        title: "Đánh giá thành công",
                        icon: "success",
                        text: "Cảm ơn bạn đã dành thời gian để đánh giá và nhận xét sản phẩm của shop"
                    }).then(function() {
                        window.location.href = "index.php";
                    });
                </script>';
            } else {
                echo "Lỗi server. Vui lòng đánh giá lại sau" . $conn->error;
            }
        } else {
            echo '<script>
                Swal.fire({
                    title: "Bạn đã đánh giá sản phẩm này rồi",
                    icon: "error",
                    text: "Cảm ơn bạn đã quan tâm đến sản phẩm"
                });
            </script>';
        }
    }
    while ($row = mysqli_fetch_array($result)){ ?>
        <div class="row wrapper-product-detail"> 
            <div class="col-sm-5 ">
                <div class="wrapper-left-detail">
                    <div class="left-detail-image">
                        <img src="img/products/<?php echo $row['image'] ?>" alt="" width="420px">
                    </div>
                    <div class="left-detail-thumbnail">
                        <?php 
                            $thumbnail = explode(';', $row['thumbnail']);
                            foreach ($thumbnail as $key) { ?>
                                <a href="#" class="thumbnail-link" data-image="img/products/<?php echo $key ?>">
                                    <img src="img/products/<?php echo $key ?>" alt="">
                                </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 right-detail">
              <form action="pages/main/addtoCart.php?proid=<?php echo $row['productid']?>" method="POST">
                   <div class="wrapper-right-detail">
                        <p >Thương hiệu: <span class="product-brand"><?php echo $row['brand']; ?></span> </p>
                        <p class="product-name"><?php echo $row['productname'] ?></p>
                        <div class="wrapper-price">
                            <p class="product-saleprice"><?php echo number_format($row['saleprice'],0,',','.') .'đ' ?></p> 
                            <p class="product-price"><?php echo number_format($row['price'],0,',','.') .'đ' ?></p>
                        </div>
                        <p>Số lượng: <span><?php echo $row['quantity']; ?></span></p>

                        <div class="table-cart-amount">
                            <button type="button" onclick="handleMinus()"><i class="fas fa-minus"></i></button>
                             <input type="text" id="quantity" name="amount" value="1" min="1">
                            <button type="button" onclick="handlePlus()"><i class="fas fa-plus"></i></button>
                        </div>

                        <input type="submit" name="addtoCart" id="addtoCart" value="Thêm vào giỏ" data-toggle="modal" data-target="#modal-addtoCart">
                        <div class="product-info">
                            <?php echo $row['discription']?>
                        </div>
                   </div>
                </form>
            </div>
        </div>
<?php }?> 

        <div class="container-fluid wrapper-cm-all">
            <div class="row ">
                <div class="col-sm-9 col-md-6 col-lg-8">
                    <div class="wrapper-comment-rating">
                        <div class="title-comment">
                            <h4>Đánh giá và nhận xét</h4>
                            <div class="wrapper-btn-comment">
                            <?php if(isset($_SESSION['customerid']))
                                echo '<button onclick="showcommentForm()">Viết nhận xét</button>'; ?>
                            </div>
                            
                        </div>
                    <?php while($row_cm = mysqli_fetch_array($result_cm)) {?>
                        <div class="wrapper-comment">
                            <div class="wrapper-cm-info">
                                <div class="avatar-cm">
                                    <img src="img/avatar/<?php echo $row_cm['avatar']?>" alt="" width="50px">
                                </div>
                                <div class="cm-name">
                                    <p><?php echo $row_cm['lastname'] .' '. $row_cm['firstname']?></p>
                                    <div class='rating-stars text-center'>
                                        <ul id='stars'>
                                           <?php 
                                           $ratingValue = $row_cm['ratingvalue'];
                                           if( $ratingValue)
                                                for ($i = 1; $i <= $ratingValue; $i++) {
                                                echo "<li class='star' data-value='$i'>
                                                        <i class='fa fa-star fa-fw'></i>
                                                    </li>";
                                                }
                                            else
                                           ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper-cm-content">
                                <p><?php  echo $row_cm['content']?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
               </div>
                <div class="col-sm-3 col-md-6 col-lg-4">
                    <div class="wrapper-cm-right">
                        <div class="form-comment" > 
                            <form action="" id="commentForm" method="post">
                                <p>Đánh giá:</p>
                                <div class="stars">
                                    <input class="star star-5" id="star-5" type="radio" name="star" value="5" required/>
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" id="star-4" type="radio" name="star" value="4"required/>
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" id="star-3" type="radio" name="star" value="3"required/>
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" id="star-2" type="radio" name="star" value="2"required/>
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" id="star-1" type="radio" name="star" value="1"required/>
                                    <label class="star star-1" for="star-1"></label>
                                </div>
                                <p>Nhận xét:</p>
                                <textarea  id="comment" name="comment" rows="4" required></textarea><br>
                                <button type="submit" id ="btn-rating" name="btn-rating">Gửi đánh giá</button>
                            </form>
                        </div>
                    </div>         
                </div>
            </div>

     <div class="modal fade" id="modal-addtoCart">
    <div class="modal-dialog">
        <div class="modal-content loginform">
            <button type="" class="close" data-dismiss="modal"><img src="img/icon/close2.jpg" width="25px"></button>
            <div class="modal-header1">
                <p>Đã thêm vào giỏ</p>
            </div>
        </div>
    </div>
</div>
<script>
    // đổi ảnh thumbnail
    $(document).ready(function() {
        $('.thumbnail-link').on('click', function(e) {
            e.preventDefault();
            var newImage = $(this).data('image');
            $('.left-detail-image img').attr('src', newImage);
        });
    });
    // mở đóng form đánh giá
    function showcommentForm() {
    var commentForm = document.getElementById("commentForm");
    // Lấy giá trị thực của thuộc tính display
    var computedStyle = window.getComputedStyle(commentForm);
    var displayValue = computedStyle.getPropertyValue("display");
    // So sánh giá trị thực để xác định trạng thái hiện tại
    if (displayValue === "none") {
        commentForm.style.display = "block";
    } else {
        commentForm.style.display = "none";
    }
}

</script>
