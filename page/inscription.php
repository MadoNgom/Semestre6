<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require('../page/roles.php');
require('../DBTransaction.php');

$msg = "";
$transaction = new DBTransaction();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['click'])) {

   $nomComplet = trim($_POST['nomComplet']);
   $email = trim($_POST['email']);
   $pwd = trim($_POST['pwd']);
   $adress = trim($_POST['address']);

   // Validation des données
   if (empty($nomComplet) || empty($email) || empty($pwd) || empty($adress)) {
      $msg = "Tous les champs sont obligatoires";
   } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $msg = "Adresse email invalide";
   } else {
      var_dump($nomComplet, $email, $pwd, $adress); // Ajoutez ceci pour voir les valeurs avant d'appeler la fonction
      $result = $transaction->inscription($nomComplet, $email, $pwd, $adress, "CLIENT");
      if ($result == 0) {
         $msg = "Données invalides";
      } else {
         header('Location:connexion.php');
         exit();
      }
   }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inscription</title>
   <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
   <link rel="stylesheet" href="../assets/styles/form.css">
   <link rel="stylesheet" href="../assets/styles/inscription.css">
</head>

<body>
   <!-- Header start -->
   <header class="bg-light text-dark shadow sticky-top py-2">
      <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center">
            <!-- FIRST ROW -->
            <div class="d-none d-sm-none d-md-block">
               <a href="../index.php" class="nav-brand text-dark d-flex justify-content-center lign-items-center">
                  <h4 class="nav-brand mx-2 ">Finshop</h4>
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
                     <a href="../panier/panier.php" class="nav-link text-dark">
                        <div class="cart">
                           Panier
                           <i class="bi bi-cart-fill"></i>
                           <span class="number bg-danger p-1 text-white rounded-circle fs-6">1</span>
                        </div>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="../panier/commande.php" class="nav-link text-dark">
                        <div class="cart">
                           Commande
                        </div>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="btn btn-dark text-white" href="connexion.php">
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
   <section class="banner">
      <div class="container d-flex justify-content-center align-items-center">
         <!-- Formulaire inscription -->
         <form action="inscription.php" method="POST" class="form shadow mt-4 bg-white">
            <div class="text-center p-6">
               <h3 class="mx-2">Inscription</h3>
            </div>
            <div class="form-group my-4">
               <label for="nomComplet">Nom Complet</label> <br />
               <input type="text" name="nomComplet" class="form-control p-2" placeholder="Nom complet" />
            </div>
            <div class="form-group my-4">
               <label for="address">Address</label> <br />
               <input type="text" name="address" class="form-control p-2" placeholder="Votre Addresse" />
            </div>
            <div class="form-group my-4">
               <label for="email">Votre Email</label> <br />
               <input type="email" name="email" class="form-control p-2" placeholder="Entrez votre email" />
            </div>
            <div class="form-group my-3">
               <label for="pwd">Votre mot de passe</label>
               <input type="password" name="pwd" class="form-control p-2" placeholder="Entrez votre mot de passe" />
            </div>
            <div class="fs-6 text-left">
               <a href="#">Mot de passe oublié?</a>
            </div>
            <div class="form-group fs-6 text-black-50">
               <input type="checkbox" name="checkbox" id="" /> Se souvenir de moi
               <button type="submit" class="btn text-white p-2 w-100 btn-dark rounded-2 mt-3" name="click">
                  S'inscrire
               </button>
            </div>
            <p class="text-black-50 text-center mt-1">Ou</p>
            <div class="d-flex justify-content-center align-items-center">
               <img src="../../../assets/images/google.png" alt="" width="30px" />
               <img src="../../../assets/images/face.png" alt="" width="30px" class="mx-3" />
            </div>
            <p class="mt-2 text-black-50 fs-6">
               Vous avez déjà un compte? <a href="connexion.php">Connectez-vous</a>
            </p>
         </form>

      </div>
   </section>
</body>

</html>