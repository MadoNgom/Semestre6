<?php
// Suppression de la gestion des sessions comme demandé
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require('../page/roles.php');
require('../DBTransaction.php');
$transaction = new DBTransaction();
$fixedUserId = 1; // ID utilisateur fixe à des fins de démonstration
$commandes = $transaction->getCommandeClient($fixedUserId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/styles/list.css">
    <link rel="stylesheet" href="../assets/styles/nave.css">
</head>
<body>
   
 <!-- Header start -->
 <header class="bg-light text-dark shadow sticky-top py-2">
      <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center">
            <!-- FIRST ROW -->
            <div class="d-none d-sm-none d-md-block">
                    <a href="../index.php" class="nav-brand d-flex justify-content-center lign-items-center">
                        <h4 class="nav-brand mx-2">Finshop</h4>
                        <img src="../assets/image/bg/shopping-bag.png" class="w-25" alt="" />
                    </a>
                </div>
            <!-- SEARCH BAR -->
            <div class="my-auto">
               <form action="" role="Search">
                  <div class="form-group d-flex my-2">
                     <input type="search" placeholder="Rechercher un produit" class="form-control" />
                     <button type="submit" class="btn bg-warning text-white mx-1">
                        <i class="bi bi-search"></i>
                     </button>
                  </div>
               </form>
            </div>
            <div class="my-auto">
               <ul class="nav justify-content-end">
                  <?php if (isBoutiquier()) : ?>
                     <li class="nav-item">
                        <a class="nav-link text-dark" href="../produits/listproduit.php">
                           Mes Produits</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark" href="../Categorie/read.php">
                           Categories</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark" href="../commande/commandeclient.php">Commande clients</a>
                     </li>
                  <?php endif; ?>
                  <?php if (isAdmin()) : ?>
                     <li class="nav-item">
                        <a class="nav-link text-dark" href="../users/listboutiquier.php">Gestions Users</a>
                     </li>
                  <?php endif; ?>
                  <li class="nav-item">
                     <a href="panier.php" class="nav-link text-dark">
                        <div class="cart">
                           Panier
                           <i class="bi bi-cart-fill"></i>
                           <span class="number bg-danger text-white rounded-circle fs-6">1</span>
                        </div>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="commande.php" class="nav-link text-dark">
                        <div class="cart">
                           Commande
                           <i class="bi bi-cart-fill"></i>
                           <span class="number bg-danger text-white rounded-circle fs-6">1</span>
                        </div>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="btn btn-dark text-white" href="../page/connexion.php">
                        <i class="bi bi-person-fill"></i> connexion
                     </a>
                  </li>
                  <a class="navbar-brand nav-link text-dark d-block d-sm-block d-md-none d-lg-none" href="#">
                     Finshop
                  </a>
               </ul>
            </div>
         </div>
      </div>
   </header>
   <!-- HEADER END -->

<div class="container-fluid">
  <table action="commande.php" method="POST" class="table commandelist">
    <thead class="table-dark">
      <tr>
        <th>Date</th>
        <th>Montant Total</th>
        <th>État</th>
        <th>Détail</th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach ($commandes as $key => $commande) { ?>
        <tr>
          <td><?= $commande['date'] ?></td>
          <td><?= $commande['montantTOT'] ?> CFA</td>
          <td><?= $commande['etat'] ?></td>
          <td><a href="../commande/detailCommande.php?idcommande=<?= $commande['id'] ?>"><i class="bi bi-eye-fill"></i></a></td>
        </tr>
    <?php } ?>
    </tbody>
  </table>
</div><br><br>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
