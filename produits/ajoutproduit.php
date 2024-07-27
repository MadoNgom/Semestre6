<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require('../page/roles.php');
if (!isset($_SESSION['User'])) {
   header("Location:../page/connexion.php");
   exit();
}
if ($_SESSION['User']['profile'] != "BOUTIQUIER") {
   header("Location:../page/connexion.php");
   exit();
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$msg = "";

function telechargeImage($imageInfos)
{
   $nomImage = $imageInfos['name'];
   $imagePath = $imageInfos['tmp_name'];
   if (move_uploaded_file($imagePath, "../assets/image/" . $nomImage)) {
      return $nomImage;
   }
   return "";
}

if (isset($_POST['click'])) {
   $nom = $_POST['nom'];
   $description = $_POST['description'];
   $prixU = $_POST['prixU'];
   $image = telechargeImage($_FILES['image']);
   $id_boutiquier = $_SESSION['User']['id'];
   $id_categorie = $_POST['id_categorie'];

   if ($image == "") {
      $msg = "Erreur lors du téléchargement de l'image.";
   } else {
      $result = $transaction->createproduct($nom, $description, $prixU, $image, $id_boutiquier, $id_categorie);
      if ($result == 1) {
         header("Location:listproduit.php");
         exit();
      } else {
         $msg = $result;
      }
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ajouter les produits</title>
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
                        <a class="nav-link text-dark" href="../commande/commandeclient.php">Commande clients</a>
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


   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>