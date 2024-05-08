<?php 
    include '../components/connection.php';

    session_start();
    
    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)){
        header('location: login.php');
    }

    // Sửa thông tin người dùng
    if(isset($_POST['edit_user'])){
        $user_id = $_POST['user_id'];
        // Chuyển hướng đến trang fix_info.php để chỉnh sửa thông tin của người dùng với ID tương ứng
        header("Location: fix_info.php?user_id=$user_id");
        exit();
    }

    // Xóa người dùng
    if(isset($_POST['delete_user'])){
        $user_id = $_POST['user_id'];
        // Xóa người dùng từ cơ sở dữ liệu
        $delete_user = $conn->prepare("DELETE FROM users WHERE id = :id");
        $delete_user->bindParam(':id', $user_id);
        $delete_user->execute();
        // Thực hiện chuyển hướng hoặc hiển thị thông báo
        if($delete_user){
            header('location: user_account.php');
        } else {
            echo "<script>alert('Failed to delete user');</script>";
        }
    }

    // Khóa hoặc mở người dùng
    if(isset($_GET['toggle_user'])){
        $user_id = $_GET['toggle_user'];
        $user_status = $_GET['status'];
        // Cập nhật trạng thái người dùng trong cơ sở dữ liệu
        $toggle_user = $conn->prepare("UPDATE users SET status = :status WHERE id = :id");
        $toggle_user->bindParam(':status', $user_status);
        $toggle_user->bindParam(':id', $user_id);
        $toggle_user->execute();
        // Thực hiện chuyển hướng hoặc hiển thị thông báo
        if($toggle_user){
            if($user_status == 'blocked') {
                echo "<script>alert('User has been blocked');</script>";
            } else {
                echo "<script>alert('User has been unblocked');</script>";
            }
            header('location: user_account.php');
        } else {
            echo "<script>alert('Failed to toggle user status');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Coffee Admin Panel - Users Page</title>
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script type="text/javascript" src="./script.js"></script>

    <!-- CSS link -->
    <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include'../components/admin_header.php';?>
    <div class="main">
        <div class="banner">
            <h1>Manager Users</h1>
        </div>
        <div class="title2">
            <a href="dashboard.php">Dashboard</a><span> / Manager Users</span>
        </div>
        
        <!-- Danh sách người dùng đã đăng ký -->
        <section class="accounts">
            <h1 class="heading">Registered Users</h1>
        <!-- Biểu mẫu thêm người dùng mới -->
        <section>
            <button onclick="location.href='register_user.php'" type="button" class="btn" style="height:3rem;">Add User</button>
        </section>
            <div class="box-container">
                <?php
                    $select_users = $conn->prepare("SELECT * FROM users");
                    $select_users->execute();

                    if($select_users->rowCount() > 0){
                        while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
                            $user_id = $fetch_users['id'];
                            $user_status = $fetch_users['status'];
                ?>
                <div class="box">
                    <!-- Hiển thị thông tin người dùng -->
                    <p>User ID: <span><?= $fetch_users['id']; ?></span></p>
                    <p>User Name: <span><?= $fetch_users['name']; ?></span></p>
                    <p>User Email: <span><?= $fetch_users['email']; ?></span></p>
                    <!-- Biểu mẫu sửa thông tin người dùng -->
                    <form method="POST" action="">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        <button type="submit" name="edit_user">Edit</button>
                    </form>
                    <!-- Nút khoá hoặc mở người dùng -->
                    <form method="GET" action="">
                        <input type="hidden" name="toggle_user" value="<?= $user_id ?>">
                        <input type="hidden" name="status" value="<?= $user_status == 'active' ? 'blocked' : 'active' ?>">
                        <button type="submit"><?= $user_status == 'active' ? 'Block' : 'Unblock' ?></button>
                    </form>
                    <!-- Nút xóa người dùng -->
                    
                </div>
                <?php
                        }
                    } else {
                        echo '<div class="empty"><p>No user registered yet!</p></div>';
                    }
                ?>
            </div>
        </section>
    </div>
</body>
</html>
