<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require('../page/roles.php');
// $_SESSION['user']=user connecter toujour
if (!isset($_SESSION['User'])) {
   header("Location:../page/connexion.php");
}
if ($_SESSION['User']['profile'] != "BOUTIQUIER") {
   header("Location:../page/connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$id_boutiquier = $_SESSION['User']['id'];
$produits = $transaction->getProductByIdBoutiquier($id_boutiquier);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Listes des produits</title>
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
               <div class="nav-brand d-flex justify-content-center lign-items-center">
                  <h4 class="nav-brand mx-2">Fineshop</h4>
               </div>
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
                        <a class="nav-link text-dark" href="listproduit.php">
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
                        <a class="nav-link text-dark" href="users/listboutiquier.php">Gestions Users</a>
                     </li>
                  <?php endif; ?>
                  <li class="nav-item">
                     <a href="../panier/panier.php" class="nav-link text-dark">
                        <div class="cart">
                           Panier
                           <i class="bi bi-cart-fill"></i>
                           <span class="number bg-danger text-white rounded-circle fs-6">1</span>
                        </div>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="../panier/commande.php" class="nav-link text-dark">
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




   <a href="ajoutproduit.php" class="btn btn-dark mb-3 test-class">Add New</a>

   <section>
      <div class="container-fluid">
         <div class="row">
            <?php foreach ($produits as $key => $produit) : ?>
               <div class="col-md-4 p-4">
                  <div class="d-flex justify-content-center align-items-center">
                     <div>
                        <img src="../assets/image/<?= $produit['image'] ?>" height="150px" class="text-center" alt="">
                        <h4 class="title">
                           <?= $produit['nom'] ?>
                        </h4>
                        <div class="rating text-warning">
                           <i class="bi bi-star-fill"></i>
                           <i class="bi bi-star-fill"></i>
                           <i class="bi bi-star-fill"></i>
                           <i class="bi bi-star-fill"></i>
                           <i class="bi bi-star-half"></i>
                        </div>
                        <div class="d-flex my-3">
                           <a href="#"><i class="bi bi-heart text-black fs-5"></i></a>
                           <div class="mx-3">
                              <span class="text-warning"><?= $produit['prixU'] ?></span> <br>
                           </div>
                          
                        </div>
                        <a class="btn btn-outline-success" href="editproduit.php?idproduit=<?= $produit['id'] ?>"><i class="bi bi-pencil-square"></i></a>
                        <a class="btn btn-outline-danger" href="deleteproduit.php?idproduit=<?=$produit['id']?>"><i class="bi bi-trash"></i></a>
                     </div>
                  </div>
               </div>
            <?php endforeach; ?>
         </div>
      </div>
   </section>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>