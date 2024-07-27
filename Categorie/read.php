<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require('../page/roles.php');
//$_SESSION['user']=user connecter toujour
if (!isset($_SESSION['User'])) {
   header("Location:connexion.php");
}
if ($_SESSION['User']['profile'] != "BOUTIQUIER") {
   header("Location:../page/connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$id_boutiquier = $_SESSION['User']['id'];
$categories = $transaction->getCategorieByIdBoutiquier($id_boutiquier);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Listes des Categories</title>
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
                        <a class="nav-link text-dark" href="produits/listproduit.php">
                           Mes Produits</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark" href="Categorie/read.php">
                           Categories</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark" href="commande/commandeclient.php">Commande clients</a>
                     </li>
                  <?php endif; ?>
                  <?php if (isAdmin()) : ?>
                     <li class="nav-item">
                        <a class="nav-link text-dark" href="users/listboutiquier.php">Gestions Users</a>
                     </li>
                  <?php endif; ?>
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
                     <a class="btn btn-dark text-white" href="./page/connexion.php">
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
   <div class="container p-4">
      <a href="create.php" class="btn btn-success mb-3 ">Add New</a>
      <div class="row">
         <div class="col-md-4">
            <h5>Categories</h5>
            <h6>Nom</h6>
            <div class="input-group">
               <br />
               <br />
               <input type="text" name="text" class="form-control" placeholder="Nom de la Categorie" />
            </div>
            <h6>Description</h6>
            <div class="input-group">
               <br />
               <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary mt-2 d-block">Ajouter categories</button>
         </div>
         <div class="col-md-7">
            <h5 class="mb-2">listes Categories</h5>
            <table class="table table-centered mb-0">
               <thead class="table-dark table-striped">
                  <tr>
                     <th>Id</th>
                     <th>Nom</th>
                     <th>Description</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  foreach ($categories as $key => $categorie) { ?>
                     <tr>
                        <td>1</td>
                        <td><?= $categorie['nom'] ?></td>
                        <td class="w-50">
                           <p>
                              <?= $categorie['description'] ?>
                           </p>
                        </td>
                        <td>
                           <a href="update.php?idcategorie=<?= $categorie['id'] ?>" class="text-success fs-5"><i class="bi bi-pencil-square"></i></a>
                           <a href="delete.php?idcategorie=<?= $categorie['id'] ?>" class="text-danger fs-5"><i class="bi bi-trash"></i></a>
                        </td>

                     </tr>
                  <?php } ?>

               </tbody>
            </table>
         </div>
      </div>
   </div>


   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>