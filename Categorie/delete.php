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
$produit = $transaction->deleteCategorieById($_GET['idcategorie']);
header('location:read.php');
?>