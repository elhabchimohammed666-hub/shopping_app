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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاقسام</title>
</head>
<body>
    <main style="justify-content: center;">
        <?php
           $name_sct=$_GET['section'];
            $result = $con->prepare("select * from produit where product_sect='$name_sct'");
            $result->execute();
            if($result->rowCount()> 0){
            while ($row = $result->fetch()) {
        ?>
          <div class="product">
            <!-- image -->
            <div class="product_img"><a href="details.php?id_prd=<?php echo $row['id_prd']; ?>">
                <img src="uploads/img/<?php echo $row['produit_img']; ?>" alt="">
                <span class="introuvable"><?php echo $row['introvable']; ?></span>
                </a>
            </div>
            <!-- section -->
            <div class="procuct_section">
                <a href="details.php?id_prd=<?php echo $row['id_prd']; ?>"><?php echo $row['product_sect']; ?></a>
            </div>
            <!-- name -->
            <div class="product_name">
                <a href="details.php?id_prd=<?php echo $row['id_prd']; ?>"><?php echo $row['product_name']; ?></a>
            </div>
            <!-- price -->
             <div class="procuct_price">
                <a href="details.php?id_prd=<?php echo $row['id_prd']; ?>">prix : &nbsp;<?php echo $row['product_price']; ?> &nbsp; dh</a>
             </div>
             <!-- description -->
              <div class="product_description">
                <a href="details.php?id_prd=<?php echo $row['id_prd']; ?>"><?php echo $row['description']; ?> &nbsp;<i class="fa-solid fa-eye"></i></a>
              </div>
              <!-- quantite -->

               <div class="qte_input">
                <form method="post" action="cart.php?action=<?php echo$row['id_prd']; ?>">
                <button class="qte_count_mins">-</button>
                <input type="number" id="qte" name="qte" value="1" min="0" max="7">
                 <input type="hidden" name="id_np" value="<?php echo $row['id_prd']; ?>">
                  <input type="hidden" name="h_name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="h_price" value="<?php echo $row['product_price']; ?>">
                <input type="hidden" name="h_img" value="<?php echo $row['produit_img']; ?>">

                <button class="qte_count_add">+</button>
               </div><br>
               <!-- subbmit -->
               <div class="submit">
                  <a href=""><button class="add_to_cart" type="submit" name="add" value="add_cart"><i class="fa-solid fa-cart-plus">&nbsp;&nbsp;</i>اضف الى السلة</button></a>
               </div>
              </form>
        </div>
        
        <?php
        }
        }else{
           
            echo "<p style='text-align:center; width:100%;height:60%;
               background-color:orange; color:white; papping:10px; font-size:40px;border:1px solid red; border-radius:7px;
               '>هدا القسم غير متوفر حاليا</p>";
                   }
        ?>
    </main>
</body>
</html>

<?php
require_once('./file/footer.php');
?>

