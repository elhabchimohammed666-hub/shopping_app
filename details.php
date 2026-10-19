<?php
require_once('include/connexion.php');
require_once('./file/header.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل المنتج</title>
    <style>
        main{
            display: flex;
            flex-wrap: wrap;
        }
        .container{
            width: 90%;
            height: auto;
            margin: 20px auto;
            border-radius: 8px;
        }
        .product_img{
            float: left;
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .product_img img{
            width: 400px;
            height: 400px;
            margin-left: 170px;
            margin-top: 60px;
            margin-bottom: 20px;
            border: 3px solid black;
            padding: 2rem;
            box-shadow: 5px 5px 5px gray;
        }
        .product_info{
            float: right;
            width: 400px;
            height: 400px;
            text-align: center;
            font-size: 20px;
            margin-right: 50px;
            padding: 10px 10px;
            margin-top: 30px;
        }
        .product_title{
            margin: 10px 0;
        }
        .product_price{
            color: blue;
            margin: 10px 0;
        }
        .product_description{
            font-size: 16px;
            line-height: 1.5;
        }
        .add_cart{
            width: 150px;
            height: 35px;
            margin-left: 30px;
            padding: 10px 10px;
            background-color: #fff;
            border-radius: 5px;
        }
        .add_cart:hover{
            background-color: #e67e22;
        }
        .recently_add{
            float: right;
            width: 30%;
            margin-top: 30px;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 1.0);
        }
        .add_img img{
            float: right;
            margin: 10px;
            width: 70px;
            height: 70px;
            margin-right: 5px;
            border-radius: 10px;
        }
        .comment_info{
            float: left;
            width: 50%;
            height: auto;
            margin: 20px 10px;
            box-shadow:0 2px 2px rgba(0, 0, 0, 1.0) ;
        }
        .comment_info h5{
            font-size: 20px;
            margin-top: 20px;
            text-align: center;
            color: black;

        }
        .comment_info textarea{
            text-align: center;
            width: 80%;
            margin-top: 20px;
            margin-left: 50px;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            height: 50px;
        }
        .add_comment{
            width: 100px;
            height: 35px;
            margin-left: 40px;
            padding: 10px 10px;
            background-color: #fff;
            border-radius: 5px;
        }
        .add_comment:hover{
            background-color: #e67e22;
        }
        .comments{
            margin-top: 10;
        }
        .comment{
            color: black;
            font-size: larger;
            margin: 5px 5px;
            text-align: center;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 5px;
            overflow: hidden;
            text-overflow: ellipsis;
            
        }
        .username{
            padding: 4px 5px;
            text-align: right;
            font-size: 20px;
            
        }
        .username span{
            
            color: blue;
        }
    </style>
</head>
<body>
    <main>
          <?php
             $id_prd=$_GET['id_prd'];
             if(isset($_GET['id_prd'])){
                $req="select * from produit where id_prd='$id_prd'";
                $result=$con->query($req);
                while ($row = $result->fetch()) {  
             
          ?>

        <div class="container">
            <div class="product_img">
                <img src="uploads/img/<?php echo $row['produit_img']; ?>" alt="">
            </div>
            <!-- informations -->
             <div class="product_info">
                <h1 class="product_title"><?php echo $row['product_name']; ?></h1>
                <h2 class="product_price"><?php echo $row['product_price']; ?> &nbsp; dh السعر</h2>
                <h3><?php echo $row['product_size']; ?> &nbsp; : المقاسات المتوفرة</h3>
                <h4 class="product_description">تفاصيل المنتج</h4>
                <p><?php echo $row['description']; ?></p>
                  <div class="qte_input">
                <button class="qte_count_mins">-</button>
                <input type="number" id="qte" name="" value="1" min="0" max="7">
                <button class="qte_count_add">+</button>
               </div><br>
               <!-- submit to card -->
                <div class="submit">
                    <a href=""><button class="add_cart" type="submit" name="">
                         ارسال
                    </button></a>
                </div>
             </div>
        </div>
        <?php
         }
         }
        ?>

    </main>
    <hr>
    <!-- recently product -->
     <div class="container">
        <div class="recently_add">
            <h4>منتجات حديثة</h4>
            <?php
               $req= "select * from produit where id_prd !='$id_prd' order by rand() limit 3";
               $result=$con->query($req);
               while ($row = $result->fetch()) {
            ?>
            <div class="add_img">
                <a href="details.php?id_prd=<?php echo $row['id_prd']; ?>">
                <img src="uploads/img/<?php echo $row['produit_img']; ?>" alt="">
                  
                </a>
            </div>
          <?php
               }
          ?>

            
        </div>
        <!-- تقييمات -->
      

         <div class="comment_info">
                        <?php
           @$comment = trim($_POST['comment']);
           @$add_comment=$_POST['add_comment'];
           if(isset($_POST['add_comment'])){
             if(empty($comment)){
                 echo '<script>alert("الرجاء كتابة تعليق لان الحقل فارغ")</script>';
             }else{
                $req = "INSERT INTO comment (comment,id_prd) VALUES ('$comment','$id_prd')";
                $result=$con->query($req);
                echo "<script>window.location.href='details.php?id_prd=$id_prd';</script>";
                 exit();
                
             }
           }
           $req2= "select * from comment where id_prd='$id_prd' limit 5";
           $result=$con->query($req2);
        ?>
            <h5>هل تود تقييم هدا المنتج</h5>
            <form action="" method="post">
                <textarea required name="comment" id="" placeholder="قيم هدا المنتج من فضلك" ></textarea>
                <button class="add_comment" type="submit" name="add_comment">ارسال</button>
                <h5>تقييمات العملاء</h5>
                 <?php
                 if($result->rowCount() > 0){
                 while ($row = $result->fetch()) {
                 ?>
                <div class="comments">
                    <div class="username">&nbsp;<span><?php echo $row['username'] ?></span>&nbsp;:&nbsp; تقييم بواسطة  </div>
                </div>
                <div class="comments">
                    <div class="comment"><?php echo $row['comment'] ?></div>
                </div>
                <?php
                 }
                 }
                ?>
            </form>
         </div>
     </div>
</body>
</html>

<?php
require_once('./file/footer.php');
?>