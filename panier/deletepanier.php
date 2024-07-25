<?php
// CA permet de securiser
session_start();
// $_SESSION['user']=user connecter toujour
if (!isset($_SESSION['User'])){
header("Location:../page/connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$result = $transaction->deletProductPanier($_GET['idproduit']);
header('Location:panier.php');

?>