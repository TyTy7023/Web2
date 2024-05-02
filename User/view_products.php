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

    // Khởi tạo câu truy vấn dựa trên loại sản phẩm được chọn
    $category = isset($_GET['category']) ? $_GET['category'] : '';

    if (!empty($category)) {
        $select_products = $conn->prepare("SELECT * FROM `product` WHERE category = ?");
        $select_products->execute([$category]);
    } else {
        // Nếu không có loại sản phẩm được chọn, truy vấn tất cả sản phẩm
        $select_products = $conn->prepare("SELECT * FROM `product`");
        $select_products->execute();
    }

    // Xử lý thêm sản phẩm vào yeu thich
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
    <title>Green Coffee - Shop Page</title>
    <style>

    </style>
</head>

<body>
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Green Tea Shop</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home </a><span>/ Our Shop
            </span><?php if (!empty($category)) echo '<span>/ ' . ucfirst($category) . '</span>';?>
            <div class="search-form">
                <form action="search.php" method="GET">
                    <select name="category_search">
                        <option value="">All</option>
                        <option value="coffee">Coffee</option>
                        <option value="tea">Tea</option>
                    </select>
                    <input type="number" name="min_price" placeholder="Min Price">
                    <input type="number" name="max_price" placeholder="Max Price">
                    <input type="text" name="query" placeholder="Search products...">
                    <button type="submit"><i class="bx bx-search"></i></button>
                </form>
            </div>
        </div>
        <section class="products">
            <div class="box-container">
                
                <?php
                $products_per_page = 8; // Số sản phẩm trên mỗi trang
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Xác định trang hiện tại
                $offset = ($current_page - 1) * $products_per_page; // Tính offset

                $start = ($current_page-1)*$products_per_page ;
                $end = $start+ $products_per_page;
                //echo $start.'-'.$end;

                if ($category === 'all') {
                    // Nếu người dùng chọn "all", truy vấn tất cả sản phẩm
                    $select_products = $conn->prepare("SELECT * FROM `product` LIMIT $start,$products_per_page ");
                    $select_products->execute();
                } else if (!empty($category)) {
                    // Nếu có một category được chọn, truy vấn sản phẩm trong category đó
                    $select_products = $conn->prepare("SELECT * FROM `product` WHERE category = ? LIMIT $start,$products_per_page ");
                    $select_products->execute([$category]);
                } else {
                    // Nếu không có category được chọn, truy vấn tất cả sản phẩm
                    $select_products = $conn->prepare("SELECT * FROM `product` LIMIT $start,$products_per_page ");
                    $select_products->execute();
                }

                

                // Hiển thị danh sách sản phẩm
                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                <form action="" method="post" class="box">
                    <img src="image/<?= $fetch_products['image']; ?>" class="img">
                    <div class="button">
                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                        <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                        <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
                    </div>
                    <h3 class="name"><?= $fetch_products['name']; ?></h3>
                    <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                    <div class="flex">
                        <p class="price">Price $<?= $fetch_products['price']; ?>/-</p>
                        <input type="number" name="qty" required min="1" value="1" max="99" class="qty">
                    </div>
                    <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
                </form>
                <?php
                    }
                } else {
                    echo '<p></p><p class="empty">No products added yet.</p>';
                }
                ?>
            </div>
        </section>
        <div class="pagination">
            <?php
                // Tính tổng số trang dựa trên điều kiện tìm kiếm
                if (isset($_GET['category'])) {
                    $category_search = $_GET['category'];
                } else {
                    $category_search = '';
                }
                $total_products_sql = "SELECT COUNT(*) AS total_products FROM `product` WHERE 1=1";

                if (!empty($category_search)) {
                    $total_products_sql .= " AND category = '$category_search'";
                }
                if (!empty($min_price)) {
                    $total_products_sql .= " AND price >= $min_price";
                }
                if (!empty($max_price)) {
                    $total_products_sql .= " AND price <= $max_price";
                }
                if (!empty($query)) {
                    $total_products_sql .= " AND (name LIKE '%$query%' OR description LIKE '%$query%')";
                }
                // echo $total_products_sql." ";
                $total_products_result = $conn->query($total_products_sql);
                $total_products_row = $total_products_result->fetch(PDO::FETCH_ASSOC);
                $total_products = $total_products_row['total_products'];
                $total_pages = ceil($total_products / $products_per_page);

                // // Hiển thị liên kết phân trang
                echo '<div class="pagination">';
                for ($i = 1; $i <= $total_pages; $i++)  {
                    echo "<a href='?page=$i&category=$category'>$i</a> ";
                }
                echo '</div>';
            ?>
        </div>
        <?php include 'components/footer.php'; ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>

</html>