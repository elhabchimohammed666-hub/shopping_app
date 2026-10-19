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

// 1. تنظيف قيمة البحث وإزاله المسافات الزائدة
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// 2. تحديد نوع الاستعلام بناءً على الحالة
if (isset($_GET['btn_search']) && !empty($search)) {
    // حالة البحث الفعلي
    $query = "SELECT * FROM produit WHERE description LIKE ? OR product_name LIKE ? OR id_prd LIKE ? OR product_sect LIKE ?";
    $result = $con->prepare($query);
    $searchTerm = "%$search%";
    $result->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
} else {
    // حالة الحقل فارغ أو الدخول لأول مرة -> جلب كل شيء
    $query = "SELECT * FROM produit";
    $result = $con->prepare($query);
    $result->execute();
}

// 3. عرض النتائج
?>
<div class="product-container" style="display: flex; flex-wrap: wrap; justify-content: center;">
<?php
if ($result->rowCount() > 0) {
    while ($row = $result->fetch()) {
?>
    <div class="product">
        <div class="product_img"><a href="details.php?id_prd=<?php echo $row['id_prd']; ?>">
            <img src="uploads/img/<?php echo $row['produit_img']; ?>" alt="">
            <span class="introuvable"><?php echo $row['introvable']; ?></span>
            </a>
        </div>
        <div class="procuct_section">
            <a href="details.php?id_prd=<?php echo $row['id_prd']; ?>"><?php echo $row['product_sect']; ?></a>
        </div>
        <div class="product_name">
            <a href="details.php?id_prd=<?php echo $row['id_prd']; ?>"><?php echo $row['product_name']; ?></a>
        </div>
        <div class="procuct_price"><a href="details.php?id_prd=<?php echo $row['id_prd']; ?>">
            <span>prix : &nbsp;<?php echo $row['product_price']; ?> &nbsp; dh</span></a>
        </div>
        <div class="product_description">
            <a href="details.php?id_prd=<?php echo $row['id_prd']; ?>"><?php echo $row['description']; ?> &nbsp;<i class="fa-solid fa-eye"></i></a>
        </div>
        <div class="qte_input">
            <form method="post" action="cart.php?action=<?php echo$row['id_prd']; ?>">
            <button class="qte_count_mins">-</button>
            <input type="number" class="qte_val" name="qte" value="1" min="1" max="7">

            <input type="hidden" name="id_np" value="<?php echo $row['id_prd']; ?>">
            <input type="hidden" name="h_name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="h_price" value="<?php echo $row['product_price']; ?>">
                <input type="hidden" name="h_img" value="<?php echo $row['produit_img']; ?>">


            <button class="qte_count_add">+</button>
        </div><br>
         <div class="submit">
                  <a href=""><button class="add_to_cart" type="submit" name="add" value="add_cart"><i class="fa-solid fa-cart-plus">&nbsp;&nbsp;</i>اضف الى السلة</button></a>
               </div>
        </form>
    </div>
<?php
    }
} else {
    echo "<p style='text-align:center; width:100%;height:60%;
    background-color:orange; color:white; papping:10px; font-size:40px;border:1px solid red; border-radius:7px;
    '>لا توجد منتجات لعرضها.</p>";
}
?>
</div>
<?php require_once('./file/footer.php'); ?>