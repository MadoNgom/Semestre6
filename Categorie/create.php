<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require('../page/roles.php');
if (!isset($_SESSION['User'])) {
   header("Location:connexion.php");
   exit();
}
if ($_SESSION['User']['profile'] != "BOUTIQUIER") {
   header("Location:connexion.php");
   exit();
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$msg = "";
if (isset($_POST['click'])) {
   $nom = $_POST['nom'];
   $description = $_POST['description'];
   $id_boutiquier = $_SESSION['User']['id'];
   $result = $transaction->createCategorie($nom, $description, $id_boutiquier);
   if ($result == 1) {
      header("Location:read.php");
      exit();
   } else {
      $msg = $result;
   }
}
?>