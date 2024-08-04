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
$msg = "";
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
   <link rel="stylesheet" href="../style.css">
</head>

<body>
   <!-- Header start -->
   <header class="bg-light text-dark shadow sticky-top py-2">
      <div class="container">
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
   <main>
      <section>
         <div class="container py-4">
            <div class="py-4">
               <!-- Button trigger modal -->
               <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Nouveau Utilisateur
               </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <!-- FORMULAIRE D'AJOUT UTILISATEUR -->
                        <form action="ajoutboutiquier.php" method="POST" class="row g-3 boutiquierform">
                           <?= $msg ?>
                           <div class="col-md-6">
                              <label for="nomComplet" class="form-label">NomComplet</label>
                              <input name="nomComplet" type="texte" class="form-control" id="NomComplet" required>
                           </div>
                           <div class="col-md-6">
                              <label for="address" class="form-label">Address</label>
                              <input name="address" type="texte" class="form-control" id="address" required>
                           </div>
                           <div class="col-md-6">
                              <label for="Email" class="form-label">Email</label>
                              <input name="email" type="email" class="form-control" id="email" required>
                           </div>
                           <div class="col-md-6">
                              <label for="password" class="form-label">Password</label>
                              <input name="pwd" type="password" class="form-control" id="password" required>
                           </div>
                           <div class="col-md-4">
                              <label for="inputState" class="form-label">Profil</label>
                              <select name="profile" id="inputState" class="form-select">
                                 <option selected>Choisissez un profil</option>
                                 <option value=ADMIN>ADMIN</option>
                                 <option value=BOUTIQUIER>BOUTIQUIER</option>
                                 <option value=CLIENT>CLIENT</option>
                              </select>
                           </div>
                           <div class="col-12">
                              <button name="click" type="submit" class="btn btn-primary">ajouter</button>
                              <a href="listboutiquier.php" class="btn btn-danger">Annuler</a>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- USER Table -->
            <div class="table-body">
               <table class="table-stripped">
                  <thead class="bg-warning text-black-50 rounded-2 p-4 shadow-sm text-black-50">
                     <tr>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Profile</th>
                        <th>Date</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <!-- TABLE BODY -->
                  <tbody>
                     <?php
                     foreach ($users as $key => $user) { ?>
                        <tr>
                           <td><?= $user['nomComplet'] ?></td>
                           <td><?= $user['email'] ?></td>
                           <td><?= $user['address'] ?></td>
                           <td><?= $user['profile'] ?></td>
                           <td><?= $user['dateCreation'] ?></td>
                           <td>
                              
                           <td>
                              <a href="editUser.php?idUser=<?= $user['id'] ?>" class="text-success mx-2 fs-5 text-decoration-none"><i class="bi bi-pencil-square"></i></a>
                              <a href="deleteuser.php?iduser=<?= $user['id'] ?>" class="text-danger text-decoration-none"><i class="bi bi-trash"></i></a>
                           </td>
            </td>
            </tr>
         <?php } ?>
         
         </tbody>
         </table>

         </div>
         </div>
      </section>
   </main>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>