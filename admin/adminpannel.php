<?php
session_start();
include("../include/connexion.php");

// 1. التحقق من الجلسة قبل أي مخرجات HTML
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit(); // إيقاف تنفيذ السكربت بعد التوجيه
}

// 2. معالجة إضافة قسم جديد
if (isset($_POST["add_sec"])) {
    $name_sec = trim($_POST["name_sct"]); // إزالة المسافات الزائدة

    if (empty($name_sec)) {
        echo '<script>alert("الرجاء إدخال اسم القسم!");</script>';
    } else {
        // استخدام Prepared Statement لحماية قاعدة البيانات
        $stmt = $con->prepare("INSERT INTO section (name_sct) VALUES (:name)");
        $stmt->bindParam(':name', $name_sec);
        
        if ($stmt->execute()) {
            echo '<script>alert("تم إضافة القسم بنجاح!");</script>';
        } else {
            echo '<script>alert("حدث خطأ أثناء الإضافة.");</script>';
        }
    }
}

?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="style.css">
  </head>
  <body>
  
  <!-- sidebar  -->
   <div class="sidebar_container">
    <div class="sidebar">
      <h1>لوحة تحكم الادارة</h1>
      <ul>
        <li><a href="../index.php" target="_blank">الصفحة الرئيسية <i class="fa-solid fa-house"></i></a></li>
        <li><a href="produit.php" target="_blank">صفحة المنتجات <i class="fa-solid fa-laptop"></i></a></li>
        <li><a href="addProduit.php" target="_blank">اضافة منتج <i class="fa-solid fa-folder-plus"></i></a></li>
        <li><a href="#" target="_blank">معلومات الاعضاء <i class="fa-solid fa-users"></i></a></li>
        <li><a href="#" target="_blank">طلبات الزبائن <i class="fa-solid fa-folder-open"></i></a></li>
        <li><a href="logout.php" target="_blank">تسجيل الخروج <i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
      </ul>
    </div>
    <!-- section start -->
     <div class="content_section">
      <form action="adminpannel.php" method="post">
          <label for="sec">اضافة قسم جديد</label>
          <input type="text" id="sec" name="name_sct"><br>
          <button class="add" name="add_sec" type="submit">اضافة قسم</button>
      </form>
      <br>
      <table dir="rtl">
        <tr>
          <th>الرقم التسلسلي</th>
          <th>اسم القسم</th>
          <th>حدف قسم</th>
        </tr>
        <tbody>
                <?php
                // جلب البيانات من قاعدة البيانات لعرضها في الجدول
                $query = $con->query("SELECT * FROM section");
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['id_sct']}</td>
                            <td>{$row['name_sct']}</td>
                            <td>
                                <a href='delete_section.php?id={$row['id_sct']}' onclick='return confirm(\"هل أنت متأكد؟\")'>
                                    <button class='delete'>حذف</button>
                                </a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
      </table>
     </div>


   </div>


  </body>
  </html>