<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require('../page/roles.php');
// $_SESSION['user']=user connecter toujour
if (!isset($_SESSION) && !isset($_SESSION['User'])) {
   header("Location:../page/connexion.php");
}
if ($_SESSION['User']['profile'] != "ADMIN") {
   header("Location:../page/connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$users = $transaction->getAlluser();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Liste Boutiquier</title>
   <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
   <link rel="stylesheet" href="../assets/styles/list.css">
   <link rel="stylesheet" href="../assets/styles/user.css">
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
                  <h4 class="nav-brand mx-2">Finshop</h4>
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
                  <li class="nav-item">
                     <a class="nav-link text-dark" href="">Commandes</a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link text-dark" href="">
                        Produits</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link text-dark" href="../Categorie/read.php">
                        Categories</a>
                  </li>
                  <li class="nav-item">
                     <a href="" class="nav-link text-dark">
                        <div class="cart">
                           Panier
                           <i class="bi bi-cart-fill"></i>
                           <span class="number bg-danger text-white rounded-circle fs-6">1</span>
                        </div>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="btn btn-dark text-white" routerLink="components/connexion">
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
   <!-- 
   <header class="bg-dark text-white shadow sticky-top py-2">
      <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center">
            
   <div class=" d-none d-sm-none d-md-block">
      <div class="nav-brand d-flex justify-content-center lign-items-center">
         <h4 class="nav-brand mx-2">
            Finshop
         </h4>
         <img src="assets/image/logo.png" alt="">
      </div>
   </div>
   SEARCH BAR -->
   <!-- <div class=" my-auto">
      <form action="" role="Search">
         <div class="form-group d-flex my-2">
            <input type="search" placeholder="Rechercher un produit" class="form-control">
            <button type="submit" class="btn bg-danger text-white mx-1">
               <i class="bi bi-search"></i>
            </button>
         </div>
      </form>
   </div>
   <div class=" my-auto">
      <ul class="nav  justify-content-end">
         <li class="nav-item">
            <a href="../panier/panier.php" class="nav-link text-white">
               <i class="bi bi-cart4"></i> Panier
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link text-white" href="../panier/commande.php"><i class="bi bi-basket2-fill"></i> Commandes</a>
         </li>

         </li>
         <?php if (isBoutiquier()) : ?>
            <li class="nav-item">
               <a class="nav-link text-white" href="produits/listproduit.php"><i class="bi bi-cart4"></i> Produits</a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-white" href="Categorie/read.php"><i class="bi bi-cart4"></i> Categories</a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-white" href="commande/commandeclient.php"><i class="bi bi-cart4"></i> Commande des clients</a>
            </li>
         <?php endif; ?>

         <?php if (isAdmin()) : ?>
            <li class="nav-item">
               <a class="nav-link text-white" href="listboutiquier.php">
                  <i class="bi bi-heart"></i> gestion utilisateurs
               </a>
            </li>
         <?php endif; ?>
         <li class="nav-item">
            <a class="btn btn-danger" href="../page/connexion.php">
               <i class="bi bi-person-fill"></i> connexion
            </a>
         </li>
         <a class="navbar-brand  nav-link text-white d-block d-sm-block d-md-none d-lg-none" href="#">
            Finshop
         </a>
      </ul>
   </div>
   </div>
   <nav class="navbar navbar-expand-lg">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
               <a class="nav-link text-white" href="../index.php">Home</a>
            </li>
            <li class="nav-item ">
               <a class="nav-link text-white" href="#">All Categories</a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-white" href="../page/categorieByHomme.php"> Hommes</a>
            </li>

            <li class="nav-item">
               <a class="nav-link text-white" href="../page/categorieByFemme.php">Femmes</a>
            </li>
         </ul>
      </div>
   </nav>
   </div>
   </header>  -->

   <!-- <div class="container">
      <a href="ajoutboutiquier.php" class="btn btn-dark mb-3 test-class">Add New</a>

      <table action="listboutiquier.php" method="POST" class="table1">
         <thead>
            <tr>
               <th>NomComplet</th>
               <th>Email</th>
               <th>Profile</th>
               <th>Action</th>

            </tr>
         </thead>
         <tbody>
            <?php
            foreach ($users as $key => $user) { ?>
               <tr>
                  <td><?= $user['nomComplet'] ?></td>
                  <td><?= $user['email'] ?></td>
                  <td><?= $user['profile'] ?></td>
                  <td class="text-success"><a href="editUser.php?idUser=<?= $user['id'] ?>"><i class="bi bi-pencil-square"></i></a></td>
                  <td class="text-danger"><a href="deleteuser.php?iduser=<?= $user['id'] ?>"><i class="bi bi-trash"></i></a></td>
               </tr>
            <?php } ?>
         </tbody>
      </table><br><br>

   </div> -->

   <!-- TABLE ADMINISTRATEUR -->
   <div class="container my-3">
      <h5>Gestions Utilisateurs</h5>
      <div class=" my-4">
         <a href="ajoutboutiquier.php" class="btn btn-success">Add User</a>
      </div>

      <table class="table table-striped table-centered mb-0">
         <thead class="bg-dark">
            <tr>
               <th>Nom Complet</th>
               <th>Email</th>
               <th>Address</th>
               <th>Profile</th>
               <th>Date de creation du compte</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php
            foreach ($users as $key => $user) { ?>
               <tr>
                  <td><?= $user['nomComplet'] ?></td>
                  <td><?= $user['email'] ?></td>
                  <td><?= $user['adresse'] ?></td>
                  <td><?= $user['profile'] ?></td>
                  <td><?= $user['date'] ?></td>
                  <td>
                     <a href="editUser.php?idUser=<?= $user['id'] ?>" class="text-success mx-2 fs-5 text-decoration-none"><i class="bi bi-pencil-square"></i></a>
                     <a href="deleteuser.php?iduser=<?= $user['id'] ?>" class="text-danger text-decoration-none"><i class="bi bi-trash"></i></a>
                  </td>
               </tr>
            <?php } ?>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>