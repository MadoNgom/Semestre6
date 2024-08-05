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
// Pour ajout categories
$msg = "";
if (isset($_POST['click'])) {
   $nom = $_POST['nom'];
   $description = $_POST['description'];
   $id_boutiquier = $_SESSION['User']['id'];
   $result = $transaction->createCategorie($nom, $description, $id_boutiquier);
   if ($result == 1) {
      header("Location:read.php");
      exit();
   } else {
      $msg = $result;
   }
}
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
                        <a class="nav-link text-dark" href="../produits/listproduit.php">
                           Mes Produits</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-dark" href="Categorie/read.php">
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
                        Bonjour ! Admin 👋
                     </a>
                  </li>
                  <li class="dropdown nav-item">
                     <a class=" dropdown-toggle nav-link text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        <i class="bi bi-bell-fill "></i>
                        <span class="number fs-6  bg-danger text-white rounded-circle p-1 fs-6">1</span>
                     </a>
                     <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Mon profile</a></li>
                        <li><a class="dropdown-item" href="#">se deconnecté</a></li>
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
   <!-- Button trigger modal -->
   <div class="container p-4">
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
         Add New
      </button>
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter Categories</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">

                  <form action="create.php" method="POST" enctype="multipart/form-data" class="row g-3 boutiquierform">
                     <div class="col-md-6">
                        <label for="Nom" class="form-label">Nom</label>
                        <input name="nom" type="text" class="form-control" id="Nom" required>
                     </div>
                     <div class="col-md-6">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                     </div>
                     <div class="modal-footer">
                        <button name="click" type="submit" class="btn btn-primary">Ajouter</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                     </div>
                     <?php if ($msg) : ?>
                        <div class="alert alert-danger" role="alert">
                           <?php echo $msg; ?>
                        </div>
                     <?php endif; ?>

                  </form>
               </div>

            </div>
         </div>
      </div>
   </div>
   <div class="container p-4">
      <!-- Listes Categories -->
      <div class="row">
         <div class="col-md-8">
            <h5 class="mb-2">listes Categories</h5>
            <table class="table table-centered mb-0">
               <thead class="table-dark table-striped">
                  <tr>
                     <th>Nom</th>
                     <th>Description</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  foreach ($categories as $key => $categorie) { ?>
                     <tr>
                        <td><?= $categorie['id'] ?></td>
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