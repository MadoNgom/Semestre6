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
$msg = "";
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
   <link rel="stylesheet" href="../style.css">
</head>

<body>
   <!-- Header start -->
   <header class="bg-light text-dark shadow sticky-top py-2">
      <div class="container-fluid">
         <div class="d-flex justify-content-between align-items-center">
            <!-- FIRST ROW -->
            <div class="d-none d-sm-none d-md-block">
               <div class="nav-brand d-flex justify-content-center lign-items-center" routerLink="/">
                  <h4 class="nav-brand mx-2">Fineshop</h4>
                  <img src="../assets/image/bg/shopping-bag.png" class="w-25" alt="" />
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
                  <?php endif; ?>
                  <?php if (isAdmin()) : ?>
                     <li class="nav-item">
                        <a class="nav-link text-dark" href="users/listboutiquier.php">Gestions Users</a>
                     </li>
                  <?php endif; ?>
                  <a class="navbar-brand nav-link text-dark d-block d-sm-block d-md-none d-lg-none" href="#">
                     Fineshop
                  </a>
               </ul>
            </div>
         </div>
      </div>
   </header>
   <!-- HEADER END -->
   <section>
      <div class="container p-4">
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add New
         </button>
         <!-- Modal POUR AJOUTER UN PRODUIT -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un produit</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <form action="ajoutproduit.php" method="POST" enctype="multipart/form-data" class="row g-3 boutiquierform">
                        <div class="col-md-6">
                           <label for="Nom" class="form-label">Nom</label>
                           <input name="nom" type="text" class="form-control" id="Nom" required>
                        </div>
                        <div class="col-md-6">
                           <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                           <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                           <label for="prixU" class="form-label">Prix Unitaire</label>
                           <input name="prixU" type="number" class="form-control" id="prixU" step="0.01" required>
                        </div>
                        <div class="mb-3">
                           <label for="formFile" class="form-label">Image du produit</label>
                           <input name="image" class="form-control" type="file" id="formFile" required>
                        </div>
                        <div class="col-md-6">
                           <select name="id_categorie" class="form-select" aria-label="Default select example" required>
                              <?php
                              $connexion = new PDO('mysql:host=localhost;dbname=fineShop;', 'root', '');
                              $query = $connexion->prepare("SELECT id, nom FROM Categorie");
                              $query->execute();
                              while ($ctgorie = $query->fetch(PDO::FETCH_ASSOC)) {
                                 echo "<option value='{$ctgorie['id']}'>{$ctgorie['nom']}</option>";
                              }
                              ?>
                           </select>
                        </div>
                        <div class="col-12">
                           <button name="click" type="submit" class="btn btn-primary">Ajouter</button>
                           <a href="listproduit.php" class="btn btn-danger">Annuler</a>
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
         <div class="container-fluid">
            <div class="row">
               <!-- Rigth content -->
               <div class="col-md-4">
                  <ul class="nav-ul my-4 py-4 px-3">
                     <h4>Categories</h4>
                     <li class="nav-item"><a href="" class="nav-link">Beauté et bien etre </a></li>
                     <li class="nav-item"><a href="" class="nav-link"> Accessoire Femme </a></li>
                     <li class="nav-item"> <a href="" class="nav-link">chaussures Hommes</a></li>
                  </ul>
               </div>
               <div class="table-body">
               <table class="table-stripped">
                  <thead class="bg-warning text-black-50 rounded-2 p-4 shadow-sm text-black-50">
                     <tr>
                     <th>Image</th>
                     <th>Nom</th>
                     <th>Description</th>
                     <th>Nom_categorie</th>
                     <th>PrixU</th>
                     <th>Action</th>
                     </tr>
                  </thead>
                  <!-- TABLE BODY -->
                  <tbody>
                     <?php
                     foreach ($produits as $key => $produit) { ?>
                        <tr>
                        <td class="img"> <img src="../assets/image/<?= $produit['image']?>"class="card-img-top" alt="..."></td>
                           <td><?= $produit['nom'] ?></td>
                           <td><?= $produit['description'] ?></td>
                           <td><?= $produit['nom_categorie'] ?></td>
                           <td><?= $produit['prixU'] ?></td>
                           <td>
                           <a class="btn btn-outline-success" href="editproduit.php?idproduit=<?= $produit['id'] ?>"><i class="bi bi-pencil-square"></i></a>
                           <a class="btn btn-outline-danger" href="deleteproduit.php?idproduit=<?= $produit['id'] ?>"><i class="bi bi-trash"></i></a>
                           </td>
                        </tr>
                     <?php } ?>

                  </tbody>
               </table>
            </div>

            </div>
         </div>

      </div>
   </section>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>