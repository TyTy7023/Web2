<header class="header">
    <script>
        const header = document.querySelector('header');
        var navbar = document.querySelector('.navbar');
        var userBox = document.querySelector('.user-box');

        function fixedNavbar() {
            header.classList.toggle('scroll', window.pageYOffset > 0)
        }
        fixedNavbar();
        window.addEventListener('scroll', fixedNavbar);
    </script>
    
    <div class="flex">
        <a href="home.php" class="logo"><img src="img/logo.jpg" alt=""></a>
        <nav class="navbar">
            <a href="home.php">home</a>
            <div class="dropdown-toggle">
                <a href="view_products.php">products</a>
                <div class="dropdown-menu">
                    <a href="view_products.php?category=coffee">Coffee</a>
                    <a href="view_products.php?category=tea">Tea</a>
                </div>
            </div>
            <a href="order.php">orders</a>
            <a href="about.php">about us</a>
            <a href="contact.php">contact us</a>
        </nav>

        <div class="icons">
            <i class="bx bxs-user" id="user-btn"></i>
            <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_items = $count_wishlist_items->rowCount();
            ?>
            <a href="wishlist.php" class="cart-btn"><i class="bx bx-heart"></i><sup><?= $total_wishlist_items ?></sup></a>
            <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();  
            ?>
            <a href="cart.php" class="cart-btn"><i class="bx bx-cart-download"></i><sup><?= $total_cart_items ?></sup></a>
            <i class="bx bx-list-plus" id="menu-btn" style="font-size: 2rem;"></i>
        </div>

        <div class="user-box">
            <p>user name : <span><?php if(isset($_SESSION['user_name'])) echo $_SESSION['user_name']; ?></span></p>
            <p>Email : <span><?php if(isset($_SESSION['user_email'])) echo $_SESSION['user_email']; ?></span></p>
            <a href="login.php" class="btn">login</a>
            <a href="register.php" class="btn">register</a>
            <form method="post">
                <?php if(isset($_SESSION['user_name'])){?><button type="submit" name="logout" class="logout-btn">log out</button><?php } ?>
            </form>
        </div>
    </div>
    <script>
        var navbar = document.querySelector('.navbar');
        var userBox = document.querySelector('.user-box');

        /*-----------------menu and user button------------------*/
        let menu = document.querySelector('#menu-btn');
        let userBtn = document.querySelector('#user-btn');

        menu.addEventListener('click', function() {
            let nav = document.querySelector('.navbar');
            nav.classList.toggle("active");
        })
        userBtn.addEventListener('click', function() {
            let userBox = document.querySelector('.user-box');
            userBox.classList.toggle("active");
        })
    </script>
    <script src="./script.js"></script>
</header>
