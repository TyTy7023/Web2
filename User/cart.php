<?php
 include 'components/connection.php'; 
    session_start();
    if (isset($_SESSION['user_id'])) 
        $user_id = $_SESSION['user_id'];
    else $user_id = '';
    if(isset($_POST['logout'])){
        session_destroy();
        header('Location: login.php');
    }
   
    // delete item from cart
    if(isset($_POST['delete_item'])){
        $cart_id = $_POST['cart_id'];
        $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

        $varify_cart = $conn->prepare("SELECT * FROM cart WHERE id = ?");
        $varify_cart->execute([$cart_id]);
        
        if($varify_cart->rowCount() > 0){
            $delete_cart = $conn->prepare("DELETE FROM cart WHERE id = ?");
            $delete_cart->execute([$cart_id]);
            $message_msg[] = "Product removed from cart";
        }else{
            $message_msg[] = "cart item already deleted";
        }

    }

?>
<!-- Used to embed css file into this file -->
<style type="text/css">
    <?php include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Green Coffee - Cart page</title>
</head>
<body> 
    <?php include 'components/header.php'; ?> <!--add header-->
    <div class="main">
        <div class="banner">
            <h1>My cart</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home</a><span> / cart </span>
        </div>
        <section class= "products">
            <h1 class="title">product added in cart</h1>
            <div class="box-container">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM cart WHERE user_id=? " );
                    $select_products->execute([$user_id]);
                    $total_products = $select_products->rowCount();
                // phân trang sản phẩm trong cart
                    $products_per_page = 6; // Số sản phẩm trên mỗi trang
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Xác định trang hiện tại
                    $offset = ($current_page - 1) * $products_per_page; // Tính offset
        
                    // Hiển thị danh sách sản phẩm
                    if ($select_products->rowCount() > 0) {
                        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                            // Xử lý hiển thị sản phẩm trong cart
                            $grand_total = 0;
                            $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
                            $select_cart->execute([$user_id]);
                            if ($select_cart->rowCount() > 0) {
                                while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                                    $select_products = $conn->prepare("SELECT * FROM `product` WHERE id = ?");
                                    $select_products->execute([$fetch_cart['product_id']]); // Fix: Use $fetch_cart instead of $fetch_cart
                                    if ($select_products->rowCount() > 0) {
                                        $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                ?>
                <form method="post" action="" class="box">
                    <input type="hidden" name="cart_id" value="<?=$fetch_cart['id']; ?>">
                    <img src="img/<?=$fetch_products['image']; ?>" class="img">
                    <h3 class="name"><?=$fetch_products['name']; ?></h3>
                    <div class="flex">
                        <p class="price">price $<?=$fetch_products['price']; ?>/-</p>
                        <input type="number" name="qty" required min="1" value="1" max="99" class="qty">
                        <button type="submit" name="update_cart"><i class='bx bx-edit fa-edit'></i></button>
                    </div>
                    <p class="sub-total">sub total: <span>$<?=$sub_total = ($fetch_cart['qty'] * $fetch_cart['price']) ?></span></p>
                    <button type="submit" name="delete_item" class="btn" onclick="return confirm('delete this item')">delete</button>
                </form>
                <?php 
                        $grand_total += $sub_total;
                                    }else{
                                        echo '<p></p><p class="empty">Product was not found.</p>';
                                    }
                                }
                            }
                        }
                        }else {
                        echo '<p></p><p class="empty">No products added yet.</p>';
                    }
                ?>
            </div>
            <?php 
                if ($grand_total != 0) {
            ?>
            <div class="cart-total">
                <p>Total amout payable : <span>$<?= $grand_total ?>/-</span></p>
                <div class="button">
                    <form method="post">
                        <button type="submit" name="empty_cart" class="btn" onclick="return confirm('are you sure to empty your cart')">empty cart</button>
                        <a href="checkout.php" class="btn">proceed to checkout </a>
                    </form>
                    
                </div>
            </div>
            <?php } ?>
            </section>
        <?php include 'components/footer.php';?> <!--add footer-->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?> <!--add alert-->
</body>
</html>
