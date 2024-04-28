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
    // adding product to cart
    if(isset($_POST['add_to_cart'])){
    $id = unique_id();
    $product_id = $_POST['product_id'];
    //execute a SQL query to insert into wishlist table
    $qty = $_POST['qty'];
    $qty= filter_var($qty, FILTER_SANITIZE_STRING);

    $varify_cart = $conn->prepare("SELECT * FROM 'cart' WHERE user_id = ? AND product_id = ?");
    $varify_cart->execute([$user_id, $product_id]);

    $max_cart_items = $conn->prepare("SELECT * FROM 'cart' WHERE user_id = ?");
    $max_cart_items->execute([$user_id]);

    if($varify_cart->rowCount() > 0)
        $message = "Product already in wishlist";
    else if($max_cart_items->rowCount() > 20)
        $message = "The cart is full";
    else{
        // LIMIT 1 : ensures that only one row is returned
        $select_price = $conn->prepare("SELECT * FROM 'product' WHERE product_id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_cart = $conn->prepare("INSERT INTO 'cart' (id, user_id, product_id, price, qty) VALUES (?, ?, ?, ?, ?)");
        $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
        $message = "Product cart to wishlist";
        }
    }
    // delete item from wishlist
    if(isset($_POST['delete_item'])){
        $wishlist_id = $_POST['wishlist_id'];
        $wishlist_id = filter_var($wishlist_id, FILTER_SANITIZE_STRING);

        $varify_wishlist = $conn->prepare("SELECT * FROM 'wishlist' WHERE id = ?");
        $varify_wishlist->execute([$wishlist_id, $user_id]);
        
        if($varify_wishlist->rowCount() > 0){
            $delete_wishlist = $conn->prepare("DELETE FROM 'wishlist' WHERE id = ?");
            $delete_wishlist->execute([$wishlist_id, $user_id]);
            $message = "Product removed from wishlist";
        }else{
            $message = "Wishlist item already deleted";
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
    <title>Green Coffee - WishList page</title>
</head>
<body> 
    <?php include 'components/header.php'; ?> <!--add header-->
    <div class="main">
        <div class="banner">
            <h1>My WishList</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home</a><span> / Wish List </span>
        </div>
        <section class= "products">
            <h1 class="title">product added in WishList</h1>
            <div class="box-container">
               
        </section>
        <?php include 'components/footer.php';?> <!--add footer-->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?> <!--add alert-->
</body>
</html>
