<?php 
    include '../components/connection.php';

    session_start();
    if(isset($_POST['login'])){

        

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_admin = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
        $select_admin->execute([$email, $pass]);

        if ($select_admin->rowCount() > 0) {
            $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
            $_SESSION['admin_id'] = $fetch_admin_id['id'];
            header('location:dashboard.php');
        }else{
            $warning_msg[] = 'incorrect username or password';
        }
       
        
    }
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="admin_style.css?v=<?php echo time(); ?>">
    <title>green coffee admin panel - register page</title>
</head>
<body>

<div class="main-container">
        <section class="form-container">
            <div class="title">
                <img src="../img/download.png">
                <h1>LOGIN now</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus
                    veniam
                    tenetur
                </p>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                            
                            
                            <div class="input-field">
                                    <label for="">user email <sup>*</sup></label>
                                    <input type="email" name="email" maxlength="20" require placeholder ="Enter your email" oninput="this.value.replace(/\s/g,'')">
                            </div>

                            <div class="input-field">
                                    <label for="">user password <sup>*</sup></label>
                                    <input type="password" name="password" maxlength="20" require placeholder ="Enter your password" oninput="this.value.replace(/\s/g,'')">
                            </div>
                            <button type="submit" name="login" class="btn">login now</button>
                            <p>do not have an account ? <a href="register.php">register now</a></p>
                        </form>
        </section>
    </div>
        
        <!-- sweetalert cdn link -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <!-- custom js link -->
        <script type="text/javascript" src="script.js"></script>
    
        <!-- alert -->
        <?php include '../components/alert.php'; ?>
    </body>
</html>