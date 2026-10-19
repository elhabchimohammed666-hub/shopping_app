<?php
session_start();
require_once('include/connexion.php');
if(!isset($_SESSION['user_id'])){
    echo '<script>alert("يرجى تسجيل الدخول اولا لاضافة المنتج الى السلة");window.location.href="user/login.php";</script>';
    
}
$user_id = $_SESSION['user_id'];
if($user_id<=0){
    echo '<script>alert("مستخدم غير صحيح");window.location.href="user/login.php";</script>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة اتمام الطلب</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f6f8;
            margin: 0;
            padding: 20px;
        }
        h1{
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }
        .container{
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px rgba(0, 0, 0, 0.1);

        }
        .display_order{
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 15px;
            background-color: #ffeedd;
            border-radius: 8px;
            justify-content: center;

        }
        .product_box{
            flex: 0 1 100px;
            background-color: #fff;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0,0.08);
            transition: all 0.3s ease;
        }
        .product_box:hover{
            transform: translateY(-5px);
            box-shadow: 0 8px 20àx rgba(0, 0, 0, 0.15);
        }
        .product_box img{
            width: 60px;
            height: 60px;
            border-radius: 5px;
        }
        .product_box p{
            font-size: 12px;
            margin: 2px;
            color: black;
            font-weight: bold;
        }
        .product_box i{
            color: #007bff;
            font-weight: bold;
        }
        .total_container{
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin: 15px 0;
            color: #333;
        }
        h5{
            text-align: center;
            font-size: 20px;
        } 
        .input_group{
            margin-bottom: 15px;
        }
        input{
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        label{
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        button{
            width: 100%;
            padding: 12px;
            background-color: blue;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover{
            background-color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <section class="checkout_form">
           <h1>شكرا لتسوقك من متجرنا لقد طلبت المنتجات التالية</h1>
           <form action="" method="post">
               <div class="display_order">

                <div class="product_box">
                    <img src="uploads/img/1666_watch5.webp" alt="">
                    <p><i class="fa-solid fa-cubes"></i>الكمية:20</p>
                    <p><i class="fa-solid fa-dollar-sign"></i>السعر:200</p>
                </div>

                <div class="product_box">
                    <img src="uploads/img/1666_watch5.webp" style="width: 50px; height: auto;" alt="">
                    <p><i class="fa-solid fa-cubes"></i>الكمية:20</p>
                    <p><i class="fa-solid fa-dollar-sign"></i>السعر:200</p>
                </div>

               </div>
               <div class="total_container">
                <i class="fa fa-dollar-sign"></i>0 :المجموع الكلي 
               </div>
               <h5>قم بتعبئة بياناتك بشكل صحيح ليصل طلبك في اسرع وقت </h5>

               <div class="input_group">
                <label for="">الاسم الكامل</label>
                <input type="text" required name="" placeholder="ادخ اسمك الكامل">
               </div>

               <div class="input_group">
                <label for="">البريد الالكتروني</label>
                <input type="email" required name="" placeholder="ادخل بريدك الالكتروني">
               </div>

               <div class="input_group">
                <label for="">رقم الهاتف</label>
                <input type="text" required name="" placeholder="ادخل رقم هاتفك">
               </div>

               <div class="input_group">
                <label for="">العنوان</label>
                <input type="text" required name="" placeholder="ادخل عنوانك التفصيلي">
               </div>

               <div class="input_group">
                <label for="">البلد</label>
                <input type="text" required name="" placeholder="ادخل بلدك او محافضتك">
               </div>

               <button type="submit">تأكيد الطلب الان</button>
           </form>
        </section>
    </div>
</body>
</html>