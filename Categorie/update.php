<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require('../page/roles.php');
if (!isset($_SESSION['User'])) {
   header("Location:connexion.php");
}
if ($_SESSION['User']['profile'] != "BOUTIQUIER") {
   header("Location:connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$categorie = $transaction->getCategorieById($_GET['idcategorie']);

if (isset($_POST) && isset($_POST['click'])) {
   $nom = $_POST['nom'];
   $description = $_POST['description'];
   $result = $transaction->updateCategorie($categorie['id'], $nom, $description);
   header('location:read.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>modifier Categorie</title>
   <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
   <link rel="stylesheet" href="../assets/styles/form.css">
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
                        <a class="nav-link text-dark" href="read.php">
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
                     <a href="" class="nav-link text-dark">
                        Bonjour ! Boutiquier 👋
                     </a>
                  </li>
                  <li class="dropdown nav-item">
                     <a class=" dropdown-toggle nav-link text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        <i class="bi bi-bell-fill "></i>
                        <span class="number fs-6  bg-danger text-white rounded-circle p-1 fs-6">1</span>
                     </a>
                     <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Mon profile</a></li>
                        <li><a class="dropdown-item" href="../page/deconnection.php">se deconnecté</a></li>
                     </ul>
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
   <form action="update.php?idcategorie=<?= $categorie['id'] ?>" method="POST" enctype="multipart/form-data" class="row g-3 boutiquierform">
      <div class="col-md-6">
         <label for="Nom" class="form-label">Nom</label>
         <input name="nom" value="<?= $categorie['nom'] ?>" type="text" class="form-control" id="Nom" required>
      </div>
      <div class="col-md-6">
         <label for="exampleFormControlTextarea1" class="form-label">Description</label>
         <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required><?= $categorie['description'] ?></textarea>
      </div>
      <div class="col-12">
         <button name="click" type="submit" class="btn btn-primary">Ajouter</button>
         <a href="read.php" class="btn btn-danger">Annuler</a>
      </div>
   </form>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>