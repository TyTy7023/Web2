<?php
    // session_start();
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

        $varify_cart = $conn->prepare("SELECT * FROM 'cart' WHERE id = ?");
        $varify_cart->execute([$cart_id]);
        
        if($varify_cart->rowCount() > 0){
            $delete_cart = $conn->prepare("DELETE FROM 'cart' WHERE id = ?");
            $delete_cart->execute([$cart_id]);
            $message = "Product removed from cart";
        }else{
            $message = "cart item already deleted";
        }
    }
    //empty cart
    if(isset($_POST['delete_item'])){
        $varify_empty_item = $conn->prepare("SELECT * FROM 'cart' WHERE user_id = ?");
        $varify_empty_item->execute([$user_id]);
        
        if($varify_empty_item->rowCount() > 0){
            $delete_cart = $conn->prepare("DELETE FROM 'cart' WHERE user_id = ?");
            $delete_cart->execute([ $user_id]);
            $message = "Empty successfully";
        }else{
            $message = "cart item already deleted";
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
    <title>Green Coffee - cart page</title>
</head>
<body> 
    <?php include 'components/header.php'; ?> <!--add header-->
    <div class="main">
        <div class="banner">
            <h1>My cart</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home</a><span> / Cart </span>
        </div>
        <section class= "products">
            <h1 class="title">product added in Cart</h1>
            <div class="box-container">
                
        </section>
        <?php include 'components/footer.php';?> <!--add footer-->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?> <!--add alert-->
</body>
</html>
