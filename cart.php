<?php
session_start();
require_once('include/connexion.php');
require_once('./file/header.php');
if(!isset($_SESSION['user_id'])){
    echo '<script>alert("يرجى تسجيل الدخول اولا لاضافة المنتج الى السلة");window.location.href="user/login.php";</script>';
    
}
$user_id = $_SESSION['user_id'];
if($user_id<=0){
    echo '<script>alert("مستخدم غير صحيح");window.location.href="user/login.php";</script>';
}

@$add=$_POST['add'];
if(isset($_POST['add'])){
    @$id_prd=$_POST['id_prd'];
    @$h_name=$_POST['h_name'];
    @$h_price=$_POST['h_price'];
    @$h_img=$_POST['h_img'];
    @$qte=$_POST['qte'];
    @$id_np=$_POST['id_np'];

    $req="select * from cart where name_card='$h_name' and user_id='$user_id'";
    $result=$con->query($req);
    if($result->rowCount()> 0){
        echo '<script>alert("لقد تمت اضافة المنتج مسبقا")</script>';

    }else{
        if($user_id){

        
        $req2= "insert into cart (id_np,name_card,price,img,qte,user_id) values('$id_np','$h_name','$h_price','$h_img','$qte','$user_id')";
        $result2=$con->query($req2);
        if($result2){
           echo '<script>alert("تمت اضافة المنتوج الى السلة بنجاح")</script>';
        }else{
            echo '<script>alert("لم يتم اضافة المنتج للسلة حدث خطأ")</script>';
        }

    }
}
}
@$delete_card=$_POST['delete_card'];
if(isset($_POST['delete_card'])){
    $id_to_delete = $_POST['id_card'];
    if($id_to_delete>0){
          $req= "delete from cart where id_card='$id_to_delete' and user_id='$user_id'";
          $result=$con->query($req);
          if($result){
            echo '<script>alert("card deleted with success")</script>';
          }else{
            echo '<script>alert("حدث خطأ اثناء الحدف")</script>';
          }
    }
}

@$edit_card=$_POST['edit_card'];
if(isset($_POST['edit_card'])){
      $id_to_edit = $_POST['id_card'];
      $new_qte=$_POST['qte'];
      @$user_id=$_POST['user_id'];
      if($id_to_edit> 0){
            $req= "update cart set qte='$new_qte' where id_card='$id_to_edit' and user_id='$user_id'";
            $result=$con->query($req);
            if($result){
                  echo '<script>alert("edit with success")</script>';
            }else{
                 echo '<script>alert("edit failaid error !!")</script>';
            }

      }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة الشراء</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        h3{
            font-family: Arial, sans-serif;
            color: black;

        }
        body{
            background-color: #fff;
            color: #333;
        }
        .cart_container{
            direction: rtl;
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: rgba(0, 0, 0, 0.2);

        }
        .cont_head{
            padding: 5px;
            width: 100%;
            height: 100px;
            background-color: rgb(168, 168, 236);

        }
        .cont_head img{
            width: 70px;
            height: 70px;
            float: left;
            border-radius: 20px;
        }
         .cont_head h1{
            float: left;
            margin: 20px;
         }
         .cart_table{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;

         }
         .cart_table th,.cart_table td{
             padding: 15px;
             text-align: center;
             border: 1px solid #ddd;
         }
         .cart_table th{
            background-color: #d3d8e4;
         }
        .cart_table td img{
            width: 50px;
            height: 50px;
        }
        .cart_table td input{
            width: 50px;
            padding: 5px;
            text-align: center;
        }
        .btn_cart{
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 10px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
        }
        .btn_cart:hover{
            background-color: green;
        }
        .cart_total h6{
            font-size: larger;
            direction: rtl;

        }
        .cart_total button{
            /* padding: 10px 40px; */
            transition: transform 0.3s ease;
        }
         .cart_total button:hover{
            transform: scale(1.04);
         }

    </style>
</head>
<body>
    <div class="cart_container">
        <div class="cont_head">
            <img src="image/cart2.jpg" alt="">
            <?php
              $req= "select user_name from users where id_user='$user_id'";
              $result=$con->query($req);
              if($result->rowCount()> 0){
              while($row=$result->fetch()){
            ?>
            <h1><?php echo "Welcome to cart : ".$row['user_name']; ?></h1> 
            <?php
              }
              }else{
                echo '<h1>لا توجد نتائج للمستخدم</h1>';
              }
            ?> 
        </div>
        <table class="cart_table">
            <tr>
                <th>صورة المنتج</th>
                <th>رقم المنتج</th>
                <th>اسم المنتج</th>
                <th>الكمية</th>
                <th>السعر</th>
                <th>الاجمالي</th>
                <th>حدف</th>
                <th>تعديل</th>
            </tr>
            <?php
              $req="select * from cart where user_id='$user_id'";
              $result=$con->query($req);
              $total=0;
              if($result->rowCount()> 0){
                while($row=$result->fetch()){
            ?>
            <tr>
                <td><img src="uploads/img/<?php echo $row['img']; ?>" alt=""></td>
                <td><h3><?php echo $row['id_np']; ?></h3></td>
                <td><h3><?php echo $row['name_card']; ?></h3></td>
                <td><input value="<?php echo $row['qte']; ?>"></td>
                <td><h3 style="direction: ltr;">  <?php echo $row['price']; ?> dh </h3></td>
                <td><h3 style="direction: ltr;">  <?php echo $row['qte']*$row['price']; ?> dh </h3></td>

                <!-- botton delete -->
                <td>
                    <form action="cart.php" method="post">
                        <input type="hidden" name="id_card" value="<?php echo $row['id_card']; ?>">
                    <button class="btn_cart" type="submit" name="delete_card">حدف &nbsp;<i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>

                <!-- button edit -->
                <td>
                    <form action="cart.php" method="post">
                        <input type="hidden" name="id_card" value="<?php echo $row['id_card']; ?>">
                        <input type="number" name="qte" value="<?php echo $row['qte']; ?>">
                    <button class="btn_cart" type="submit" name="edit_card">تعديل &nbsp; <i class="fa-solid fa-pen-to-square"></i></button>
                    </form>
                </td>
            </tr>
            
            <?php
            $total+=$row['qte']*$row['price'];
                }
                }
            ?>
        </table>
        <div class="cart_total">
            <h6> <span id="total">المجموع</span>&nbsp; <span style="visibility:hidden;">dh</span><?php echo $total; ?> <span>dh</span></h6>
            <button type="submit" name="" class="btn_cart"><a href="checkout.php"><h2 style="color: white;">اتمام الطلب</h2></a></button>
        </div>

    </div>
</body>
</html>



<?php
require_once('./file/footer.php');
?>