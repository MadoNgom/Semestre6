<?php
// Suppression de la gestion des sessions comme demandé
require('../DBTransaction.php');
//conection
$transaction = new DBTransaction();

$idProduit = $_GET['idProduit']; // La clé que nous avions précisée dans index

$produit = $transaction->getProductById($idProduit);

if ($produit == null) {
    die("Ce produit n'est pas disponible");
}
$prixU = $produit['prixU']; // Permet de récupérer le prix unitaire après la vérification

$fixedUserId = 1; // ID utilisateur fixe pour des fins de démonstration
$id_client = $fixedUserId; // Utilisation de l'ID utilisateur fixe

// Dans le $panier on retrouve les informations du client
$panier = $transaction->getClientPanier($id_client);
if ($panier == null) { // Si le client n'a pas de panier, on le crée
    $result = $transaction->createPanier(0, $id_client);
    $panier = $transaction->getClientPanier($id_client);
}

// Si le panier existe déjà
$id_panier = $panier['id'];
$result = $transaction->createProduitPanier($id_panier, $idProduit, 1, $prixU);
if ($result == 1) {
    $montantTOT = $panier['montantTOT'] + $prixU;
    $result = $transaction->updatePanier($id_panier, $montantTOT);
    header('Location: panier.php');
}
