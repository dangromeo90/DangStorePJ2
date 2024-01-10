<main>
    <?php 
    if(isset($_GET['pages']))
    {
        $tam = $_GET['pages'];
    }else
    {
        $tam='';
    }
    if($tam=='product-category')
    {
        include "pages/main/product-category.php";
    }
    else if($tam=='product-categories')
    {
        include "pages/main/product-categories.php";
    }
    else if($tam=='post'){
        include "pages/main/blog.php";
    }
    else if($tam=='salenew'){
        include "pages/main/salenew.php";
    }
    else if($tam=='contact'){
        include "pages/main/contact.php";
    }
    else if($tam=='profile'){
        include "pages/main/profile.php";
    }
    else if($tam=='myprofile'){
        include "pages/main/profile.php";
    }
    else if($tam=='customer-address'){
        include "pages/main/myprofile/customer-address.php";
    }
    else if($tam=='change-password'){
        include "pages/main/myprofile/change-password.php";
    }
    else if($tam=='purchased-order'){
        include "pages/main/myprofile/purchased-order.php";
    }
    else if($tam=='order-detail'){
        include "pages/main/myprofile/order-detail.php";
    }
    else if($tam=='product'){
        include "pages/main/product-detail.php";
    }
    else if($tam=='cart'){
        include "pages/main/cart.php";
    }
    else if($tam=='search'){
        include "pages/main/search-product.php";
    }
    else if($tam=='checkout'){
        include "pages/main/order.php";
    }
    else if($tam=='order-delivery'){
        include "pages/main/order/order-delivery.php";
    }
    else if($tam=='order-confirm'){
        include "pages/main/order/order-confirm.php";
    }
   
   
    else{
    include 'main/main-index.php';
    }
    ?> 
</main>