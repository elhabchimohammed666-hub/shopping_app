<?php
session_start();
include("../include/connexion.php");
if(isset($_SESSION["user_id"])){

   echo '<script>alert("انت مسجل في المتجر بالفعل");window.location.href="../index.php";</script>';
}
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        @$user_name = $_POST['user_name'];
        @$user_password = $_POST['user_password'];

        $req="select * from users where user_name='$user_name' and user_password='$user_password'";
        $result=$con->query($req);
        if($result->rowCount()> 0){
            $user_data=$result->fetch();
            $_SESSION["user_id"]=$user_data["id_user"];
             echo '<script>alert("تم تسجيل الدخول بنجاح ");window.location.href="../index.php";</script>';

        }else{
             echo '<script>alert("اسم المستخدم او كلمة المرور غير صحيحة");</script>';
        }
    }





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="user_container">
        <h2>تسجيل الدخول</h2>
        <form action="login.php" method="post">
             <div class="input_signup">
                <input type="text" name="user_name" placeholder="ادخل اسم المستخدم" required>
             </div>
             <div class="input_signup">
                <input type="password" name="user_password" placeholder="ادخل الرمز السري" required>
             </div>
             <button type="submit" class="btn">تسجيل الدخول</button>
        </form>
        <div class="footer">
            <p> ليس لديك حساب <a href="signup.php">تسجيل مستخدم جديد</a></p>
        </div>
    </div>
</body>
</html>