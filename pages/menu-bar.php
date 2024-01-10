<?php
    $sql = "SELECT * FROM productcategory";
    $result = mysqli_query($conn, $sql);
?>
<div class="menu">
    <ul class="menu-bar">
        <li class="menu-bar-home">
            <i class="fas fa-home"></i>
            <a href="index.php" class="home">Trang chủ</a>
        </li>
        <li class="dropdown">
            <div  class="menu-bar-cate">
                <i class="fas fa-bars"></i>
                <a href="">Danh mục</a>  
            </div>
                <ul class="dropdown-content1">
                <?php while($row = mysqli_fetch_array($result)){ ?>
                    <li>
                        <a href="?pages=product-category&cateid=<?php echo $row['categoryid'] ?>">
                            <?php echo $row['categoryname']?>
                        </a>
                    </li>
                <?php } ?>
                </ul>
        </li>
        <li><a href="?pages=post">Blog</a></li>
        <li><a href="?pages=salenew">Khuyến mãi</a></li>
        <li><a href="?pages=contact">Liên hệ</a></li>
    </ul>
</div>
