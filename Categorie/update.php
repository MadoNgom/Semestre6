<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require('../page/roles.php');
if (!isset($_SESSION['User'])){
header("Location:connexion.php");
}
if ($_SESSION['User']['profile']!="BOUTIQUIER"){
 header("Location:connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$categorie = $transaction->getCategorieById($_GET['idcategorie']);

if(isset($_POST) && isset($_POST['click'])){
  $nom = $_POST['nom'];
  $description = $_POST['description'];
  $result = $transaction->updateCategorie($categorie['id'],$nom,$description);
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
  
<header class="bg-dark text-white shadow sticky-top py-2">
   <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center">
         <!-- FIRST ROW -->
         <div class=" d-none d-sm-none d-md-block">
            <div class="nav-brand d-flex justify-content-center lign-items-center">
               <h4 class="nav-brand mx-2">
                  Finshop
               </h4>
               <img src="assets/image/logo.png" alt="">
            </div>
         </div>
         <!-- SEARCH BAR -->
         <div class=" my-auto">
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
               <!--<li class="nav-item">
                  <a class="nav-link text-white" href="#">
                     <i class="bi bi-heart"></i> Favories
                  </a>-->
               </li>
               <?php if (isBoutiquier()) : ?>
               <li class="nav-item">
                     <a class="nav-link text-white" href="../produits/listproduit.php"><i class="bi bi-cart4"></i> Produits</a>
               </li> 
               <li class="nav-item">
                     <a class="nav-link text-white" href="read.php"><i class="bi bi-cart4"></i> Categories</a>
               </li> 
               <li class="nav-item">
                     <a class="nav-link text-white" href="../commande/commandeclient.php"><i class="bi bi-cart4"></i> Commande des clients</a>
               </li>
               <?php endif; ?>

               <?php if (isAdmin()) : ?>
               <li class="nav-item">
                  <a class="nav-link text-white" href="../users/listboutiquier.php">
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
</header>

<!--<nav class="navbar navbar-expand-lg bg-white ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../assets/image/logoo.png"class="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="../index.php"><i class="bi bi-house-door-fill"></i> Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="../panier/panier.php"><i class="bi bi-cart4"></i>Panier</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../panier/commande.php"><i class="bi bi-list-ul"></i>Commandes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="listproduit.php"><i class="bi bi-cart4"></i> Produit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="commandeclient.php"><i class="bi bi-cart-check-fill"></i> Commandes clients</a>
        </li>
        <li class="nav-item">
          < if (isset($_SESSION['User']) && isset($_SESSION['User']['profile']) && $_SESSION['User']['profile'] != 'admin') : ?>
            <a class="nav-link" href="../users/listboutiquier.php"><i class="bi bi-person-check-fill"></i> Utilisateurs</a>
          < endif; ?>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../page/deconnection.php"><i class="bi bi-box-arrow-right"></i> Se deconnecte</a>
        </li>
      </ul>
    </div>
  </div>
</nav>-->
<form action="update.php?idcategorie=<?=$categorie['id']?>" method="POST" enctype="multipart/form-data" class="row g-3 boutiquierform">
  <div class="col-md-6">
    <label for="Nom" class="form-label">Nom</label>
    <input name="nom" value="<?=$categorie['nom']?>" type="text" class="form-control" id="Nom" required>
  </div>
  <div class="col-md-6">
    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required><?=$categorie['description']?></textarea>
  </div>
  <div class="col-12">
    <button name="click" type="submit" class="btn btn-primary">Ajouter</button>
    <a href="read.php" class="btn btn-danger">Annuler</a>
  </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
