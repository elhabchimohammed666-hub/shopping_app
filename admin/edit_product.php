<?php
include("../include/connexion.php");

// التأكد من وجود ID في الرابط
if (!isset($_GET['id'])) {
    header("Location: produit.php");
    exit();
}

$id = $_GET['id'];

// 1. جلب البيانات القديمة
$stmt = $con->prepare("SELECT * FROM produit WHERE id_prd = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch();

if (!$row) {
    echo "المنتج غير موجود!";
    exit();
}

// 2. معالجة طلب التحديث
if (isset($_POST['update_btn'])) {
    $name    = $_POST['p_name'];
    $price   = $_POST['p_price'];
    $sect    = $_POST['name_sect'];
    $desc    = $_POST['p_desc'];
    $size    = $_POST['p_size'];
    $inv     = $_POST['p_inv'];

    // --- كود معالجة الصورة المضاف ---
    $image_name = $row['produit_img']; // افتراضياً نستخدم الصورة القديمة
    if (!empty($_FILES['p_img']['name'])) {
        $image_name = rand(0, 5000) . "_" . $_FILES['p_img']['name'];
        move_uploaded_file($_FILES['p_img']['tmp_name'], "../uploads/img/" . $image_name);
    }
    // ---------------------------------

    // استعلام التحديث (تم إضافة حقل الصورة هنا)
    $sql = "UPDATE produit SET 
            product_name  = :name, 
            produit_img   = :img, 
            product_price = :price, 
            product_sect  = :sect, 
            description   = :desc, 
            product_size  = :size, 
            introvable    = :inv 
            WHERE id_prd  = :id";

    $update = $con->prepare($sql);
    $result = $update->execute([
        ':name'  => $name,
        ':img'   => $image_name, // المتغير الذي يحمل الاسم الجديد أو القديم
        ':price' => $price,
        ':sect'  => $sect,
        ':desc'  => $desc,
        ':size'  => $size,
        ':inv'   => $inv,
        ':id'    => $id
    ]);

    if ($result) {
        header("Location: produit.php?status=updated");
        exit();
    } else {
        echo "حدث خطأ أثناء التحديث!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل منتج</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .edit-container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px; font-size: 16px; }
        button:hover { background-color: #218838; }
        .back-link { display: block; text-align: center; margin-top: 15px; text-decoration: none; color: #007bff; }
        .current-img { width: 60px; height: 60px; object-fit: cover; margin-top: 5px; border-radius: 4px; border: 1px solid #ddd; }
    </style>
</head>
<body>

<div class="edit-container">
    <h2>تعديل المنتج: <?php echo $row['product_name']; ?></h2>
    
    <form method="post" enctype="multipart/form-data">
        <label>اسم المنتج</label>
        <input type="text" name="p_name" value="<?php echo $row['product_name']; ?>" required>

        <label>صورة المنتج الحالية</label>
        <img src="../uploads/img/<?php echo $row['produit_img']; ?>" class="current-img">
        <input type="file" name="p_img">
        <small>اتركه فارغاً إذا كنت لا تريد تغيير الصورة</small>

        <label>السعر</label>
        <input type="text" name="p_price" value="<?php echo $row['product_price']; ?>" required>

        <label>نوع المنتج (القسم)</label>
        <select name="name_sect" required>
                    <option value="">-- اختر القسم --</option>
                    <?php
                    // نصيحة: يفضل جلب الأقسام ديناميكياً من قاعدة البيانات
                    $get_sections = $con->query("SELECT * FROM section");
                    while($sec = $get_sections->fetch()) {
                        echo "<option value='{$sec['name_sct']}'>{$sec['name_sct']}</option>";
                    }
                    ?>
                </select>

        <label>حجم المنتج</label>
        <input type="text" name="p_size" value="<?php echo $row['product_size']; ?>">

        <label>توفر المنتج</label>
        <input type="text" name="p_inv" value="<?php echo $row['introvable']; ?>">

        <label>تفاصيل المنتج</label>
        <textarea name="p_desc" rows="4"><?php echo $row['description']; ?></textarea>

        <button type="submit" name="update_btn">حفظ كافة التغييرات</button>
    </form>

    <a href="produit.php" class="back-link">إلغاء والعودة للقائمة</a>
</div>

</body>
</html>