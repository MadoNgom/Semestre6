<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require('../page/roles.php');
if (!isset($_SESSION['User'])) {
   header("Location:../page/connexion.php");
   exit();
}
if ($_SESSION['User']['profile'] != "BOUTIQUIER") {
   header("Location:../page/connexion.php");
   exit();
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$msg = "";

function telechargeImage($imageInfos)
{
   $nomImage = $imageInfos['name'];
   $imagePath = $imageInfos['tmp_name'];
   if (move_uploaded_file($imagePath, "../assets/image/" . $nomImage)) {
      return $nomImage;
   }
   return "";
}

if (isset($_POST['click'])) {
   $nom = $_POST['nom'];
   $description = $_POST['description'];
   $prixU = $_POST['prixU'];
   $image = telechargeImage($_FILES['image']);
   $id_boutiquier = $_SESSION['User']['id'];
   $id_categorie = $_POST['id_categorie'];

   if ($image == "") {
      $msg = "Erreur lors du téléchargement de l'image.";
   } else {
      $result = $transaction->createproduct($nom, $description, $prixU, $image, $id_boutiquier, $id_categorie);
      if ($result == 1) {
         header("Location:listproduit.php");
         exit();
      } else {
         $msg = $result;
      }
   }
}
