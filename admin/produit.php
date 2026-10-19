<?php
include("../include/connexion.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة المنتجات</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .sidebar_container table .update{
    color: white;
    font-size: 18px;
    background-color: blue;
    padding: 8px 18px;
    border-radius: 8px;
    border: none;
    margin-right: 5px;
}
img{
  width:40px;
  height:40px;
}
 .sidebar_container table .update:hover{
    background-color: green;
 }
    </style>
</head>
<body>
       <div class="sidebar_container">
            <table dir="rtl">
        <tr>
          <th>رقم المنتج</th>
          <th>عنوان  المنتج</th>
          <th>صورة  المنتج</th>
          <th>سعر التسلسلي</th>
          <th>نوع المنتج</th>
          <th> التفاصيل</th>
          <th>حجم المنتج</th>
          <th>توفر المنتج</th>
          <th>حدف منتج</th>
          <th> تعديل منتج</th>
        </tr>
        <?php
        $req="select * from produit";
        $result=$con->query($req);
        while($row=$result->fetch()){
        ?> 
        <tr>
          <td><?php echo $row['id_prd']; ?></td>
          <td><?php echo $row['product_name']; ?></td>
          <td><?php 
                        // عرض الصورة مباشرة من المجلد باستخدام الاسم المخزن
                        $image_name = $row['produit_img']; 
                        echo '<img  src="../uploads/img/'.$image_name.'" class="product_img_display" alt="منتج">';
                    ?></td>
          <td><?php echo $row['product_price']; ?></td>
          <td><?php echo $row['product_sect']; ?></td>
          <td><?php echo $row['description']; ?></td>
          <td><?php echo $row['product_size']; ?></td>
          <td><?php echo $row['introvable']; ?></td>
          
 
         <td>
        <a href="delete_product.php?id=<?php echo $row['id_prd']; ?>" onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
            <button type="button" class="delete" style="background-color:red; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">حذف</button>
        </a>
    </td>

    <td>
        <a href="edit_product.php?id=<?php echo $row['id_prd']; ?>">
            <button type="button" class="update">تعديل</button>
        </a>
    </td>
        </tr>
        <?php
        }
        ?>
      </table>
       </div>
</body>
</html>