<?php
session_start();
include("../include/connexion.php");
if(isset($_SESSION["user_id"])){
  session_unset();
  session_destroy();
  echo '<script>alert("تم نسجيل الخروج");window.location.href="login.php";</script>';
}else{
    echo '<script>alert("لم تقم بتسجيل الدخول بعد");window.location.href="login.php";</script>';
}

?>