<!-- <?php 
    include 'components/connection.php';
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
    else{
        $user_id='';
    }
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $email= filter_var($email, FILTER_SANITIZE_STRING);
        $pass = $_POST['pass'];
        $pass= filter_var($pass, FILTER_SANITIZE_STRING);
        $select_user = $conn->prepare("SELECT * FROM 'users' WHERE email = ? AND pass = ?");
        $select_user -> execute([$email,$pass]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);
        if ($select_user->rowCount() > 0) {
            $_SESSTON[ 'user_id'] = $rnow['id'];
            $_SESSTON[ 'user_name'] = $now[ 'name' ];
            $_SESSTON[ 'user_email'] = $row[ 'email' ];
            header('1ocation: home.php' ) ;
            }
            else{
            $message[] = 'incorrect username or password' ;
            }
    }
?>  -->
<style type="text/css">
        <?php  include 'style.css'; ?>
</style>
<!DOCTYPE htmL>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.9">
    <title>green tea - register now</title>
</head>
<body>
    <div class="main-container">
        <section class="form-container">
            <div class="title">
                <img src="img/download.png">
                <h1>register now</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto dolorum deserunt minus
                veniam
                    tenetur
                </p>
            </div>
            <form action="" method="post">
                <div class="input-field">
                    <p>your email <sup>*</sup></p>
                    <input type="email" name="email" required placeholder="enter your name" maxlength="50"
                    oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="input-field">
                    <p>your password <sup>*</sup></p>
                    <input type="password" name="cpass" required placeholder="enter your name" maxlength="50"
                    oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <input type="submit" name="submit" value="register now" class="btn">
                <p>do not have an account?</p> <a href="register.php">resigter now</a>
            </form>
        </section>
    </div>
        <script src="components/sweetalert.js"></script>
        <script scr="script.js"></script>
        <?php include 'components/alert.php'; ?>
</body>  
</html>