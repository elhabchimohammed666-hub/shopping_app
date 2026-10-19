<?php
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
    <title>monstre e-commerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <header>
        <!-- logo -->
        <div class="logo">
            <h1>Shopping</h1>
            <img src="./image/logo.avif" alt="">
        </div>
        <!-- search barre  -->

        <div class="search">
            <div class="search_bar">
                <form action="search.php" method="get">
                    <input type="text"class="search_input" name="search" placeholder="search your article ">
                    <button class="button_search" name="btn_search">Search</button>
                </form>
            </div>
        </div>

    </header>
    
     <nav>
        <!-- social media -->
        <div class="social">
            <ul>
                <li><a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQb-NGEQDekk2BwsllLjk4tcIM_BPIzXECdsg&s" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Cristiano_Ronaldo_Portugal.jpg/250px-Cristiano_Ronaldo_Portugal.jpg" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
                <li><a href="https://media.gqmagazine.fr/photos/696f5345464fffad8053c2e8/1:1/w_1600%2Cc_limit/GettyImages-2218707886.jpg" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="https://preview.redd.it/cristiano-ronaldo-the-greatest-gal%C3%A1ctico-of-all-time-v0-9vsug5zr8gwe1.jpg?width=640&crop=smart&auto=webp&s=9b9a5ba0b157ad11af2e01290bb8f6cca3d7fa6a" target="_blank"><i class="fa-brands fa-github"></i></a></li>
            </ul>
        </div>

        <!-- menu (section) -->
        <div class="section">
             <ul>
            <li><a href="index.php">الرئيسية</a></li>
            
                <?php
                $req="select * from section ";
                $result=$con->query($req);
                while($row=$result->fetch()){
                 ?> 
              <li><a href="section.php?section=<?php echo $row['name_sct']; ?>">
                <?php echo $row['name_sct']; ?></a> </a></li>
            <?php
             }
             ?>
         </ul>
        </div>

     </nav>
     
     <div class="last_post">
        <h4 style="margin-right: -19rem;">مضاف حديثا</h4>
        <ul>
         <?php
        $result = $con->prepare('select * from produit order by id_prd DESC limit 3');
        $result->execute();
        while ($row = $result->fetch()) {
        ?>
            <li><a href="details.php?id_prd=<?php echo $row['id_prd']; ?>"><span class="span_img">
                <img src="uploads/img/<?php echo $row['produit_img']; ?>" alt="">
        </span></a></li>
        <?php
        }
        ?>
             
        </ul>
        <!-- cart -->
         <div class="cart">
            <ul> 
                <li><a href="user/logout.php"><i class="fa-solid fa-user"></i></a></li>
                 
                <?php
                   $req= "select * from cart where user_id='$user_id'";
                   $result=$con->query($req);
                   if($result){
                       $row_count = $result->rowCount();
                   }else{
                    $row_count = 0;
                   }
                ?>

                <li class="cart-icon"><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a><span class="cart-count"><?php echo $row_count; ?></span>
                </li>


            </ul>
         </div>
     </div>

 

 
    
</body>
</html>