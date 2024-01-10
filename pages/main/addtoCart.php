<!-- Thêm sản phẩm vào giỏ hàng -->
<?php
session_start();
//session_destroy();
include '../../database/database.php';
        if (isset($_POST['addtoCart'])) {
            $proid = $_GET['proid'];
            $sql = "SELECT * FROM product WHERE product.productid = '$proid'";
            $result = mysqli_query($conn, $sql);
            $sql_variant = "SELECT * FROM attribute WHERE attribute.productid ='$proid'";
            $result_variant = mysqli_query($conn, $sql_variant);
            if($result && $result_variant) {
                $row = mysqli_fetch_array($result);
                $row_variant = mysqli_fetch_array($result_variant);
            $amount = isset($_POST['amount']) ? $_POST['amount'] : 1;
            $found = false;
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $key => $product) {
                    if ($product['proid'] == $proid) {
                        $_SESSION['cart'][$key]['proAmount'] += $amount;
                        $found = true;
                        break;
                    }
                }
            }
            if(!$found) {
                $_SESSION['cart'][] = array(
                    'proid' => $proid,
                    'proName' => $row['productname'],
                    'proAmount' => $amount,
                    'prosalePrice' => $row['saleprice'],
                    'proVariant' => $row['value'],
                    'proImage' => $row['image'],
                );
            }
            // echo '<script>
            //             Swal.fire({
            //                 title: "Đã thêm vào giỏ",
            //                 icon: "success",
            //                 timer: 2000,
            //                 showConfirmButton: false
            //             })
            //     </script>';
          
            // Đếm số lượng sản phẩm
          $_SESSION['cart-count'] = isset($_SESSION['cart-count']) ? $_SESSION['cart-count'] + $amount : $amount;
        }
    } 
    header('Location:../../index.php?pages=cart');

 //Xoá từng sản phẩm
if(isset($_GET['delete']) && isset($_SESSION['cart'])){
    $proidDelete = $_GET['delete'];
    $product = array();
    foreach ($_SESSION['cart'] as $value) {
        if ($value['proid'] != $proidDelete) {
            $product[] = $value;
        } else {
            $_SESSION['cart-count'] -= $value['proAmount'];
        }
    }
    $_SESSION['cart'] = $product;
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
    header('Location:../../index.php?pages=cart');
}
// Cộng sản phẩm trong giỏ hàng
if (isset($_GET['plus'])) {
    $proid = $_GET['plus'];
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['proid'] == $proid && $product['proAmount'] <= 9) {
            $_SESSION['cart'][$key]['proAmount']++;
            $_SESSION['cart-count']++;
            break;
        } elseif ($product['proid'] == $proid && $product['proAmount'] >= 9) {
            echo '<script>
            alert("Bạn đặt quá số lượng");
            </script>';
        }
    }
    header('Location:../../index.php?pages=cart');
}
// trừ sản phẩm trong giỏ hàng
if (isset($_GET['minus'])) {
    $proid = $_GET['minus'];
    foreach ($_SESSION['cart'] as $key => $product){
        if ($product['proid'] == $proid && $product['proAmount'] >= 1) {
            $_SESSION['cart'][$key]['proAmount']--;
            $_SESSION['cart-count']--;
            if ($_SESSION['cart'][$key]['proAmount'] == 0) {
                unset($_SESSION['cart']);
            }
            break;
        } 
    }
    header('Location:../../index.php?pages=cart');
}
?>
   