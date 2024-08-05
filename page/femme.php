<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require('../page/roles.php');
require('../DBTransaction.php');

$transaction = new DBTransaction();
$produitsHomme = $transaction->getALLproductByFemme();

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
                                <a class="nav-link text-dark" href="../produits/listproduit.php">Mes Produits</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="../Categorie/read.php">Categories</a>
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
                            <a href="panier/panier.php" class="nav-link text-dark">
                                <div class="cart">
                                    Panier
                                    <i class="bi bi-cart-fill"></i>
                                    <span class="number bg-danger p-1 text-white rounded-circle fs-6">1</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="panier/commande.php" class="nav-link text-dark">
                                <div class="cart">
                                    Mes commandes
                                    <i class="bi bi-bag-check-fill"></i>
                                </div>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['User']['nomComplet'])) : ?>
                            <li class="dropdown nav-item">
                                <a class="dropdown-toggle nav-link text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Bienvenu ! <?php echo htmlspecialchars($_SESSION['User']['nomComplet']); ?> 👋
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Mon profil</a></li>
                                    <li><a class="dropdown-item" href="deconnection.php">Se déconnecter</a></li>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="btn btn-dark text-white" href="connexion.php">
                                    <i class="bi bi-person-fill"></i> Connexion
                                </a>
                            </li>
                        <?php endif; ?>
                        <a class="navbar-brand nav-link text-dark d-block d-sm-block d-md-none d-lg-none" href="#">Finshop</a>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER END -->
    <section class="hero2">
        <div class="hero-text2">
            <h4 class="mb-3">Le Bonheur à Fineshop avec nos accessoires</h4>
            <p class="fs-6 text-black-50">
                Fineshop vous offre un excellent rapport qualité-prix tout en vous garantissant un style inimitable
            </p>
            <button class="btn btn-warning text-white">Achetez maintenant</button>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <h5 class=" text-center pt-4 mb-2">Nos Accessoires pour femme saura satisfaire toutes vos envies</h5>
            <div class="line bg-warning"></div>
            <div class="row">
                <?php foreach ($produitsHomme as $produit) : ?>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-center align-items-center">
                            <div>
                                <img src="../assets/image/<?= htmlspecialchars($produit['image']) ?>" height="150px" alt="">
                                <h4 class="title">
                                    <?= htmlspecialchars($produit['nom']) ?>
                                </h4>
                                <div class="rating text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <div class="d-flex my-3">
                                    <a href="#"><i class="bi bi-heart text-black fs-5"></i></a>
                                    <div class="mx-3">
                                        <span class="text-warning"><?= htmlspecialchars($produit['prixU']) ?></span> <br>
                                    </div>
                                    <a href="#"><i class="bi bi-cart4 text-black fs-5"></i></a>
                                </div>
                                <a class="btn btn-danger" href="../panier/ajoutPanier.php?idProduit=<?= $produit['id'] ?>">Ajouter au Panier</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>