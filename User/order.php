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
    <title>Green Coffee - orders page</title>
</head>
<body> 
    <?php include 'components/header.php'; ?> <!--add header-->
    <div class="main">
        <div class="banner">
            <h1>My ORDERS</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home</a><span> / Orders </span>
        </div>
        <section class= "products">
            
        </section>
        <?php include 'components/footer.php';?> <!--add footer-->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php';?> <!--add alert-->
</body>
</html>
