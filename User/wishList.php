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
    // Xử lý thêm sản phẩm vào giỏ hàng
    if(isset($_POST['add_to_cart'])){
        $id = unique_id();
        $product_id = $_POST['product_id'];

        $qty = 1;
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);

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
    // delete item from wishlist
    if(isset($_POST['delete_item'])){
        $wishlist_id = $_POST['wishlist_id'];
        $wishlist_id = filter_var($wishlist_id, FILTER_SANITIZE_STRING);

        $varify_wishlist = $conn->prepare("SELECT * FROM wishlist WHERE id = ?");
        $varify_wishlist->execute([$wishlist_id]);
        
        if($varify_wishlist->rowCount() > 0){
            $delete_wishlist = $conn->prepare("DELETE FROM wishlist WHERE id = ?");
            $delete_wishlist->execute([$wishlist_id]);
            $message_msg[] = "Product removed from wishlist";
        }else{
            $message_msg[] = "Wishlist item already deleted";
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
            <?php
                $select_products = $conn->prepare("SELECT * FROM wishlist WHERE user_id=? " );
                $select_products->execute([$user_id]);
                $total_products = $select_products->rowCount();
            // phân trang sản phẩm trong wishlist
                $products_per_page = 6; // Số sản phẩm trên mỗi trang
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Xác định trang hiện tại
                $start = ($current_page - 1) * $products_per_page; // Tính offset
     
                // Hiển thị danh sách sản phẩm
                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                        // Xử lý hiển thị sản phẩm trong wishlist
                        $grand_total = 0;
                        $select_wishlist = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ?LIMIT $start, $products_per_page");
                        $select_wishlist->execute([$user_id]);
                        
                        if ($select_wishlist->rowCount()>0) {
                            while($fetch_wishlist = $select_wishlist->fetch(PDO :: FETCH_ASSOC)){
                                $select_products = $conn->prepare("SELECT * FROM product WHERE id = ?");
                                $select_products->execute([$fetch_wishlist['product_id']]);
                                if ($select_products->rowCount()>0) {
                                    $fetch_products = $select_products->fetch(PDO :: FETCH_ASSOC);
                                    // $grand_total += $fetch_products['price'];   
            ?>
            <form method="post" action="" class="box">
                <input type="hidden" name="wishlist_id" value="<?=$fetch_wishlist['id']; ?>">
                <img src="image/<?=$fetch_products['image']; ?>" class="img">
                <div class="button">
                    <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                    <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
                    <button type="submit" name="delete_item" onclick="return confirm('delete this item')"><i class="bx bx-x"></i></button>
                </div>
                <h3 class="name"><?=$fetch_products['name']; ?></h3>
                <input type="hidden" name="product_id" value="<?=$fetch_products['id']; ?>">
                <div class="flex">
                    <p class="price">price $<?=$fetch_products['price']; ?>/-</p>
                </div>
                <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
            </form>
            <?php 
                    $grand_total += $fetch_wishlist['price'];
                                }
                            }
                        }
                    }
                    }else {
                    echo '<p></p><p class="empty">No products added yet.</p>';
                }
            ?>
            </section>
            <div class="pagination">
                <?php  
                    
                    // Tính tổng số trang dựa trên điều kiện tìm kiếm
                    // $total_products_sql = "SELECT COUNT(*) AS total_products FROM wishlist WHERE 1=1";
                    // $total_products_result = $conn->query($total_products_sql);
                    // $total_products_row = $total_products_result->fetch(PDO::FETCH_ASSOC);
                    // $total_products = $total_products_row['total_products'];
                    $total_pages = ceil($total_products / $products_per_page);
                    // // Hiển thị liên kết phân trang
                    echo '<div class="pagination">';
                    for ($i = 1; $i <= $total_pages; $i++)  {
                        echo "<a href='?page=$i'>$i</a> ";
                    }
                    echo '</div>';

                    
                ?>
            </div>
        <?php include 'components/footer.php';?> <!--add footer-->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?> <!--add alert-->
</body>
</html>
