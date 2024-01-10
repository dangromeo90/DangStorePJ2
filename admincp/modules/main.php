<main>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'?>
            <div class="col-md-9">
                <div class="wrapper-content">
                    <?php   
                        if(isset($_GET['manage'])){
                        $manage = $_GET['manage'];
                        }else $manage ='';

                        if($manage=='order'){
                            include 'manage-order/main-order.php';
                        }
                        elseif($manage=='pro-category'){
                            include 'manage-productcategory/main-proCategory.php';
                        }
                        elseif($manage=='edit'){
                            include 'manage-productcategory/update-proCate.php';
                        }
                        elseif($manage=='product'){
                            include 'manage-product/main-product.php';
                        }
                       
                        else{
                            include 'dashboard.php';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
