<?php
include("../include/connexion.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // حذف السجل من قاعدة البيانات
    $req = $con->prepare("DELETE FROM produit WHERE id_prd = :id");
    $result = $req->execute([':id' => $id]);

    if($result){
        header("Location: produit.php"); // العودة لصفحة المنتجات
    } else {
        echo "فشل في عملية الحذف";
    }
}
?>