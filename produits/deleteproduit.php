<?php
session_start();
if (!isset($_SESSION['User'])){
header("Location:../page/connexion.php");
}
if ($_SESSION['User']['profile']!="BOUTIQUIER"){
 header("Location:../page/connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$produit = $transaction->deleteProductById($_GET['idproduit']);
header('location:listproduit.php');
?>