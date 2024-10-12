<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require('../page/roles.php');
require('../DBTransaction.php');
$transaction = new DBTransaction();
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['click'])) {
   $email = trim($_POST['email']);
   $pwd = trim($_POST['pwd']);

   if (empty($email) || empty($pwd)) {
      $msg = "Tous les champs sont obligatoires";
   } else {
      $result = $transaction->connexion($email, $pwd);
      if ($result != null) {
         $_SESSION['User'] = $result;
         $_SESSION['nomComplet'] = $result['nomComplet']; // Assurez-vous que $result contient 'nomComplet'
         header("Location: ../index.php");
         exit();
      } else {
         $msg = "Votre email ou mot de passe est invalide";
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
   <title>Connexion</title>
   <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
   <link rel="stylesheet" href="../assets/styles/inscription.css">
</head>

<body>
   <!-- Header start -->
   <header class="bg-light text-dark shadow sticky-top py-2">
      <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center">
            <!-- FIRST ROW -->
            <div class="d-none d-sm-none d-md-block">
               <a href="../index.php" class="nav-brand text-decoration-none d-flex justify-content-center lign-items-center">
                  <h4 class="mx-2 text-dark">Finshop</h4>
                  <img src="../assets/image/shopping-bag.png" class="w-25" alt="" />
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
                           <span class="number p-1 bg-danger text-white rounded-circle fs-6">1</span>
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

   <!-- Formulaire de connexion -->
   <section class="banner">
      <div class="container d-flex justify-content-center align-items-center">
         <form action="connexion.php" method="POST" class="form shadow mt-4 bg-white">
            <?php if ($msg != "") { ?>
               <div class="alert alert-danger" role="alert">
                  <?= htmlspecialchars($msg) ?>
               </div>
            <?php } ?>
            <div class="text-center p-6">
               <h3 class="mx-2">Connexion</h3>
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
                  Se connecter
               </button>
            </div>
            <p class="text-black-50 text-center mt-1">Ou</p>
            <div class="d-flex justify-content-center align-items-center">
               <img src="../../../assets/images/face.png" alt="" width="30px" />
               <img src="../../../assets/images/google.png" alt="" width="30px" class="mx-3" />
            </div>
            <p class="mt-2 text-black-50 fs-6">
               Vous n'avez pas de compte? <a href="inscription.php">Inscrivez-vous</a>
            </p>
         </form>
      </div>
   </section>
</body>

</html>