<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require('../page/roles.php');
// $_SESSION['user']=user connecter toujour
if (!isset($_SESSION['User'])) {
   header("Location:../page/connexion.php");
}
if ($_SESSION['User']['profile'] != "ADMIN") {
   header("Location:../page/connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$msg = "";
if (isset($_POST) && isset($_POST['click'])) {
   $nomComplet = $_POST['nomComplet'];
   $address = $_POST['address'];
   $email = $_POST['email'];
   $pwd = $_POST['pwd'];
   $profile = $_POST['profile'];
   $result = $transaction->inscription($nomComplet, $address, $email, $pwd, $profile);

   if ($result == 0) {
      $msg = "Donnees invalide";
   } else {
      $msg = "Creer avec Success";
      header("location: listboutiquier.php");
   }
}
?>
