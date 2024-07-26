<?php
require('../page/roles.php');
require('../DBTransaction.php');

$transaction = new DBTransaction();
$fixedUserId = 1; // ID utilisateur fixe à des fins de démonstration

$panier = $transaction->getClientPanier($fixedUserId);
if ($panier === null) {
  $transaction->createPanier(0, $fixedUserId);
  $panier = $transaction->getClientPanier($fixedUserId);
}

if ($panier && is_array($panier)) {
    $produitsPanier = $transaction->getProduitPanier($panier['id']);
} else {
    $produitsPanier = [];
}

if (isset($_GET['action'])) {
  $result = $transaction->createCommande(date('Y/m/d'), $panier['montantTOT'], "EN COURS", $fixedUserId);
  if ($result == 1) {
    $commandes = $transaction->getCommandeClient($fixedUserId);
    foreach ($produitsPanier as $key => $value) {
      $transaction->createProduitCommande($commandes[0]['id'], $value['id_produit'], $value['nbr'], $value['montantTOT']);
    }
    $transaction->resetPanier($panier['id']);
    $transaction->updatePanier($panier['id'], 0);
    header('Location: commande.php');
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantites'])) {
  $quantites = $_POST['quantites'];
  foreach ($quantites as $idProduit => $quantite) {
    $produit = $transaction->getPanierById($idProduit);
    $montantTOT = $produit['prixU'] * $quantite;
    $transaction->updateNbrPanier($idProduit, $quantite, $montantTOT);
  }
  header('Location: panier.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Finshop Store</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <style>
      .cart-content {
         background-color: #f0f0f0ee;
         padding: 0.5rem;
         border-radius: 5px;
      }
      .resumer {
         box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
      }
   </style>
</head>

<body>
   <?php include('../page/header.php'); ?>
   <div class="container mt-4">
      <h2>Panier (<?= count($produitsPanier) ?>)</h2>
      <section class="row d-flex">
         <div class="col-md-8">
            <form method="post">
            <?php
            $valeurT = 0;
            if (is_array($produitsPanier) && count($produitsPanier) > 0) {
                foreach ($produitsPanier as $key => $produitPanier) {
                    $nombre = $produitPanier['nbr'];
                    $pU = $produitPanier['prixU'];
                    $pT = $nombre * $pU;
            ?>
            <div class="cart-content mb-3">
               <div class="d-flex justify-content-between align-items-center">
                  <div class="left-content d-flex align-items-center">
                     <img src="../assets/image/<?= $produitPanier['image'] ?>" alt="" height="100px" />
                     <div class="mx-3">
                        <h5 class="product-name"><?= $produitPanier['nom'] ?></h5>
                        <p>Vendeur : bellaBoutique</p>
                        <p class="fs-6 text-success">En Stock</p>
                     </div>
                  </div>
                  <div class="right-content">
                     <h5 id="prixU-<?= $produitPanier['id'] ?>"><?= $produitPanier['prixU'] ?></h5>
                     <del>40.000</del>
                  </div>
               </div>
               <div class="d-flex justify-content-between align-items-center">
                  <button class="btn btn-outline-danger">
                     <a href="deletepanier.php?idproduit=<?= $produitPanier['id'] ?>"> <i class="bi bi-trash"></i> supprimer</a>
                  </button>
                  <div>
                     <div class="d-flex fs-4">
                        <button type="button" class="btn btn-danger" onclick="updateQuantity(<?= $produitPanier['id'] ?>, -1)">
                           <i class="bi bi-dash fw-bold" style="cursor: pointer"></i>
                        </button>
                        <input type="number" name="quantites[<?= $produitPanier['id'] ?>]" value="<?= $produitPanier['nbr'] ?>" class="form-control mx-2 w-25 text-center" id="quantityInput<?= $produitPanier['id'] ?>" readonly>
                        <button type="button" class="btn btn-dark" onclick="updateQuantity(<?= $produitPanier['id'] ?>, 1)">
                           <i class="bi bi-plus fw-bold" style="cursor: pointer"></i>
                        </button>
                     </div>
                  </div>
               </div>
               <div class="d-flex justify-content-between align-items-center mt-2">
                  <span>Total: </span>
                  <span id="total-<?= $produitPanier['id'] ?>"><?= $pT ?> fr</span>
               </div>
            </div>
            <?php
                    $valeurT += $pT;
                }
            }
            ?>
            </form>
         </div>
         <div class="col-md-4 resumer">
            <h6>Résumé Panier</h6>
            <hr />
            <div class="d-flex justify-content-between align-items-center">
               <span>Total Panier :</span>
               <h4 id="valeurT"><?= $valeurT ?> fr</h4>
            </div>
            <p class="text-black-50 my-2">Frais de livraison non inclus à ce stade</p>
            <button class="btn btn-danger w-100 d-block my-3">
               Commander <span id="commanderTotal">(<?= $valeurT ?> fr)</span>
            </button>
            <div>
               <h6>Les retours sont faciles</h6>
               <p class="fs-6 text-black-50">Retours gratuits sous 7 jours</p>
            </div>
         </div>
      </section>
   </div>
   <script>
   function updateQuantity(id, delta) {
      var input = document.getElementById('quantityInput' + id);
      var value = parseInt(input.value, 10);
      var prixU = parseInt(document.getElementById('prixU-' + id).innerText);
      value = isNaN(value) ? 0 : value;
      value += delta;
      if (value < 1) value = 1; // quantité minimum de 1
      input.value = value;

      // Mettre à jour le total du produit
      var total = value * prixU;
      document.getElementById('total-' + id).innerText = total + ' fr';

      // Mettre à jour le total du panier
      updatePanierTotal();
   }

   function updatePanierTotal() {
      var totalElements = document.querySelectorAll('[id^="total-"]');
      var totalPanier = 0;
      totalElements.forEach(function(element) {
         var total = parseInt(element.innerText);
         totalPanier += total;
      });
      document.getElementById('valeurT').innerText = totalPanier + ' fr';
      document.getElementById('commanderTotal').innerText = '(' + totalPanier + ' fr)';
   }
   </script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>