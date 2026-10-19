<?php
session_start();
include("../include/connexion.php");
if(isset($_SESSION["user_id"])){

   echo '<script>alert("انت مسجل في المتجر بالفعل");window.location.href="../index.php";</script>';
}
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        @$user_name = $_POST['user_name'];
        @$user_email = $_POST['user_email'];
        @$user_password = $_POST['user_password'];

        $req="select * from users where user_name='$user_name' and user_password='$user_password'";
        $result=$con->query($req);
        if($result->rowCount()> 0){
            echo '<script>alert("انت مسجل مسبقا في المتجر قم بتسجيل الدخول مباشرة")</script>';
        }else{
            $req= "insert into users (user_name,user_email,user_password) values('$user_name','$user_email','$user_password')";
            $result=$con->query($req);
            echo '<script>alert("تم تسجيلك في الموقع بنجاح قم بتسجيل الدخول مباشرة")</script>';
           
        }

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل مستخدم</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="user_container">
        <h2>تسجيل مستخدم</h2>
        <form action="signup.php" method="post">
             <div class="input_signup">
                <input type="text" name="user_name" placeholder="ادخل اسم المستخدم" required>
             </div>
             <div class="input_signup">
                <input type="email" name="user_email" placeholder="ادخل البريد الالكتروني" required>
             </div>
             <div class="input_signup">
                <input type="password" name="user_password" placeholder="ادخل الرمز السري" required>
             </div>
             <button type="submit" class="btn">تسجيل الان</button>
        </form>
        <div class="footer">
            <p>لديك حساب بالفعل <a href="login.php">دخول</a></p>
        </div>
    </div>
</body>
</html>