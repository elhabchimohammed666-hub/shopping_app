<?php
include("../include/connexion.php");

$error_msg = "";
$success_msg = "";

if (isset($_POST["produit_add"])) {
    // جلب البيانات مع تنظيفها باستخدام trim
    $product_name  = trim($_POST["product_name"] ?? '');
    $product_price = $_POST["product_price"] ?? '';
    $product_sect  = $_POST["product_sect"] ?? '';
    $description   = $_POST["description"] ?? '';
    $product_size  = $_POST["product_size"] ?? '';
    $introvable    = $_POST["introvable"] ?? '';

    // جلب معلومات الصورة
    $image_name = $_FILES["produit_img"]["name"] ?? '';
    $imgtmp     = $_FILES["produit_img"]["tmp_name"] ?? '';

    // التحقق من الحقول المطلوبة
    if (empty($product_name) || empty($product_price) || empty($product_sect) || empty($image_name)) {
        $error_msg = "جميع الحقول المميزة بـ (*) مطلوبة!";
    } else {
        try {
            // إنشاء اسم فريد للصورة ورفعها
            $produit_img = rand(0, 5000) . "_" . $image_name;
            move_uploaded_file($imgtmp, "../uploads/img/" . $produit_img);

            // استخدام Prepared Statement للإضافة
            $stmt = $con->prepare("INSERT INTO produit (product_name, produit_img, product_price, product_sect, description, product_size, introvable) 
                                   VALUES (:name, :img, :price, :sect, :desc, :size, :intro)");
            
            $result = $stmt->execute([
                ':name'  => $product_name,
                ':img'   => $produit_img,
                ':price' => $product_price,
                ':sect'  => $product_sect,
                ':desc'  => $description,
                ':size'  => $product_size,
                ':intro' => $introvable
            ]);

            if ($result) {
                $success_msg = "تمت إضافة المنتج بنجاح!";
            }
        } catch (PDOException $e) {
            // التحقق من كود الخطأ 23000 (Duplicate Entry)
            if ($e->getCode() == 23000) {
                $error_msg = "عذراً، هذا الاسم موجود مسبقاً! يرجى اختيار اسم مختلف للمنتج.";
            } else {
                $error_msg = "حدث خطأ غير متوقع: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة منتج جديد</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .form_product { width: 50%; background: white; padding: 30px; border-radius: 12px; margin: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        h1 { color: #333; margin-bottom: 20px; }
        label { font-weight: bold; display: block; margin-bottom: 8px; text-align: right; }
        input, select, button { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        button { background-color: #007bff; color: white; font-size: 18px; cursor: pointer; border: none; transition: 0.3s; }
        button:hover { background-color: #28a745; }
        
        /* تنسيق الرسائل */
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: bold; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>

<div class="form_product">
    <h1>إضافة منتج جديد</h1>

    <!-- عرض رسالة الخطأ أو النجاح داخل الصفحة بدلاً من Alert المزعج -->
    <?php if ($error_msg): ?>
        <div class="alert alert-error">⚠️ <?php echo $error_msg; ?></div>
    <?php endif; ?>

    <?php if ($success_msg): ?>
        <div class="alert alert-success">✅ <?php echo $success_msg; ?></div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
        
        <label>اسم المنتج *</label>
        <input type="text" name="product_name" required value="<?php echo isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : ''; ?>">

        <label>صورة المنتج *</label>
        <input type="file" name="produit_img" required>

        <label>السعر *</label>
        <input type="number" name="product_price" required value="<?php echo $_POST['product_price'] ?? ''; ?>">

        <label>الأحجام</label>
        <input type="text" name="product_size" placeholder="S, M, L" value="<?php echo $_POST['product_size'] ?? ''; ?>">

        <label>حالة التوفر</label>
        <input type="text" name="introvable" placeholder="متوفر" value="<?php echo $_POST['introvable'] ?? ''; ?>">

        <label>وصف المنتج</label>
        <input type="text" name="description" value="<?php echo $_POST['description'] ?? ''; ?>">

        <label>قسم المنتج *</label>
        <select name="product_sect" required>
            <option value="">-- اختر القسم --</option>
            <?php
            $get_sections = $con->query("SELECT * FROM section");
            while($sec = $get_sections->fetch()) {
                echo "<option value='{$sec['name_sct']}'>{$sec['name_sct']}</option>";
            }
            ?>
        </select>

        <button type="submit" name="produit_add">إضافة المنتج الآن</button>
    </form>
</div>

</body>
</html>