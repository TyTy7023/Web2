<?php 
    include 'components/connection.php';
    session_start();    
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id='';
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header('Location: login.php');
        exit;
    }

    // Xử lý thêm sản phẩm vào yêu thích
    if(isset($_POST['add_to_wishlist'])){
        $id = unique_id();
        $product_id = $_POST['product_id'];

        $varify_wishlist = $conn->prepare("SELECT * FROM wishlist WHERE product_id = ? AND user_id = ?");
        $varify_wishlist->execute([$product_id, $user_id]);

        $cart_num = $conn->prepare("SELECT * FROM cart WHERE product_id = ? AND user_id = ?");
        $cart_num->execute([$product_id, $user_id]);

        if($varify_wishlist -> rowCount() > 0){
            $warning_msg[] = "Product already exist to wishlist";
        }else if ($cart_num -> rowCount() > 0){
            $warning_msg[] = "Product already exist to cart";
        }else {
            $select_price = $conn->prepare("SELECT * FROM `product` WHERE id = ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (id, user_id, product_id, price) VALUES (?, ?, ?, ?)");
            $insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);
            $success_msg[] = "Product added to wishlist";
        }
    }

     // Xử lý thêm sản phẩm vào giỏ hàng
     if(isset($_POST['add_to_cart'])){
        $id = unique_id();
        $product_id = $_POST['product_id'];

        $qty = $_POST['qty'];
        $qty= filter_var($qty, FILTER_SANITIZE_STRING);

        $varify_cart = $conn->prepare("SELECT * FROM cart WHERE product_id = ? AND user_id = ?");
        $varify_cart->execute([$product_id, $user_id]);

        $max_cart_items = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        $max_cart_items->execute([$user_id]);

        if($varify_cart -> rowCount() > 0){
            $warning_msg[] = "Product already exist to cart";
        }else if ($max_cart_items-> rowCount() > 20){
            $warning_msg[] = "cart is full";
        }else {
            $select_price = $conn->prepare("SELECT * FROM `product` WHERE id = ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_cart = $conn->prepare("INSERT INTO `cart` (id, user_id, product_id, price, qty) VALUES (?, ?, ?, ?, ?)");
            $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'],$qty]);
            $success_msg[] = "Product added to cart";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Green Coffee - Product detail Page</title>
    <style>

    </style>
</head>

<body>
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Product detail</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home </a><span>/ Product detail
        </div>
        <section class="view_page">
            <?php
                if (isset($_GET['pid'])) {
                    $pid = $_GET['pid'];
                    $select_products = $conn->prepare("SELECT * FROM product WHERE id ='$pid' ");
                    $select_products->execute();
                    if ($select_products->rowCount()>0) {
                        while($fetch_products = $select_products->fetch(PDO :: FETCH_ASSOC)){
            ?> 
             <!-- Hiển thị thông tin sản phẩm  -->
            <form method="post">
                <img src="image/<?php echo $fetch_products['image']; ?>">
                <div class="detail">
                    <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <div class="product-detail">
                        <p><?php echo $fetch_products['product_detail']; ?></p>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <div class="button">
                        <button type="submit" name="add_to_wishlist" class="btn">Add to wishlist<i class='bx bxs-heart'></i></button>
                        <button type="submit" name="add_to_cart" class="btn">Add to cart<i class='bx bxs-cart'></i></button>
                    </div>
                </div>
            </form> 
            <?php
                        }
                    }
                }
            ?>
        </section>
        <?php include 'components/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>

</html>