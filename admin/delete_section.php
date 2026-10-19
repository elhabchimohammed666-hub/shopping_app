<?php
session_start();
require_once('../include/connexion.php');

// التأكد من أن المستخدم مسجل دخوله
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

// التأكد من إرسال المعرف (ID) عبر الرابط
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // استخدام Prepared Statement للحذف بأمان
        $stmt = $con->prepare("DELETE FROM section WHERE id_sct = :id");
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            // إعادة التوجيه للوحة التحكم بعد الحذف بنجاح
            header("Location: adminpannel.php?msg=deleted");
            exit();
        } else {
            echo "حدث خطأ أثناء محاولة الحذف.";
        }
    } catch (PDOException $e) {
        echo "خطأ في قاعدة البيانات: " . $e->getMessage();
    }
} else {
    header("Location: adminpannel.php");
    exit();
}
?>