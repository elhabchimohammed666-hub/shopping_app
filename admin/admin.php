<?php
include("../include/connexion.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container{
           width: 400px;
           margin: 80px auto;
           padding: 30px;
           background-color: #fff;
           box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1{
            text-align: center;
            margin-bottom: 20px;

        }
        form{
            display: flex;
            flex-direction: column;
            align-items: center;

        }
        label{
            display: block;
            margin-bottom:5px ;

        }
        input{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 15px;

        }
        button{
            padding: 10px 20px;
            background-color: blue;
            color: white;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <main>
        <?php
           @$admin_mail=$_POST["email"];
           @$admin_password=$_POST["password"];
           @$admin_add=$_POST["add"];
           if(isset($admin_add)){
                if(empty($admin_mail) || empty($admin_password)){
                     echo '<script>alert("if faut remplire les deux champs")</script>';
                }else{
                   $stmt = $con->prepare("SELECT * FROM admin WHERE email = :email AND password = :pass");
                $stmt->execute([
                    'email' => $admin_mail,
                    'pass'  => $admin_password
                ]);
                $user = $stmt->fetch();
                
                if ($user) {
                    $_SESSION['email']=$admin_mail;
                    echo '<script>alert("welcomme admin")</script>';
                    header("REFRESH:0.5;URL=adminpannel.php");
                    exit;
                } else {
                    echo '<script>alert("info incorrect!!")</script>';
                     header("REFRESH:0.5;URL=../index.php");
                }
                }
           }
           
        ?>
        <div class="container">
            <h1>تسجيل الدخول</h1>
            <form action="admin.php" method="post">
                <label for="em">البريد الالكتروني</label>
                <input type="email" name="email" id="em"><br>
                <label for="pass">كلمة السر</label>
                <input type="text" name="password" id="pass"><br>
                <button type="submit" name="add">تسجيل الدخول</button>

            </form>
        </div>
    </main>
</body>
</html>