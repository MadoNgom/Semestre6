<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
require('../page/roles.php');
// $_SESSION['user']=user connecter toujour
if (!isset($_SESSION['User'])) {
   header("Location:../page/connexion.php");
}
if ($_SESSION['User']['profile'] != "ADMIN") {
   header("Location:../page/connexion.php");
}
require('../DBTransaction.php');
$transaction = new DBTransaction();
$msg = "";
if (isset($_POST) && isset($_POST['click'])) {
   $nomComplet = $_POST['nomComplet'];
   $address = $_POST['address'];
   $email = $_POST['email'];
   $pwd = $_POST['pwd'];
   $profile = $_POST['profile'];
   $result = $transaction->inscription($nomComplet, $address, $email, $pwd, $profile);

   if ($result == 0) {
      $msg = "Donnees invalide";
   } else {
      $msg = "Creer avec Success";
      header("location: listboutiquier.php");
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ajout Boutiquier</title>
   <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
   <link rel="stylesheet" href="../assets/styles/form.css">
   <link rel="stylesheet" href="../assets/styles/nave.css">
</head>

<body>
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

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>