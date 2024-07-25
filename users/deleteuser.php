<?php
session_start();
if (!isset($_SESSION) && !isset($_SESSION['user'])){
header("Location:../page/connexion.php");
}
if ($_SESSION['User']['profile']!="ADMIN"){
 header("Location:../page/connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$user = $transaction->deleteUserById($_GET['iduser']);
header('location:listboutiquier.php');
?>