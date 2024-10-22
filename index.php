<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require('page/roles.php');
require('DBTransaction.php');
$transaction = new DBTransaction();
$produits = $transaction->getAllProduct();
$Allproduits = $transaction->getALLproducts();
$produitsBienEtre = $transaction->getALLproductBienEtre();
$produitsFemme = $transaction->getALLproductByFemme();
$produitsHomme = $transaction->getALLproductByHomme();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finshop Store</title>
    <!-- BOOSTRAP Icons link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- BOOSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <header class="bg-light text-dark shadow sticky-top py-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <!-- FIRST ROW -->
                <div class="d-none d-sm-none d-md-block">
                    <a href="index.php" class="nav-brand d-flex justify-content-center lign-items-center">
                        <h4 class="nav-brand mx-2 text-dark">Finshop</h4>
                        <img src="assets/image/bg/shopping-bag.png" class="w-25" alt="" />
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
                                <a class="nav-link text-dark" href="produits/listproduit.php">Mes Produits</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="Categorie/read.php">Categories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="commande/commandeclient.php">Commande clients</a>
                            </li>
                        <?php endif; ?>
                        <?php if (isAdmin()) : ?>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="users/listboutiquier.php">Gestions Users</a>
                            </li>
                        <?php endif; ?>
                        <?php if (!isBoutiquier() && !isAdmin()) : ?>
                            <li class="nav-item">
                                <a href="panier/panier.php" class="nav-link text-dark">
                                    <div class="cart">
                                        Panier
                                        <i class="bi bi-cart-fill"></i>
                                        <span class="number bg-danger text-white rounded-circle fs-6">1</span>
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
                        <?php endif; ?>
                        <?php if (isset($_SESSION['User']['nomComplet'])) : ?>
                            <li class="dropdown nav-item">
                                <a class="dropdown-toggle nav-link text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Bienvenu ! <?php echo htmlspecialchars($_SESSION['User']['nomComplet']); ?> 👋
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Mon profil</a></li>
                                    <li><a class="dropdown-item" href="page/deconnection.php">Se déconnecter</a></li>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="btn btn-dark" href="./page/connexion.php">
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

    <section>
        <!-- caroussel slider -->
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active c-item">
                    <img src="./assets/image/bg/carousse1.jpg" class="d-block w-100 c-img" alt="...">
                    <div class="carousel-caption custom-caption d-none d-md-block">
                        <h3>Nouveautés</h3>
                        <p>Découvrez notre nouvelle collection de vêtements tendance.</p>

                        <p>
                            Nos articles les plus vendus à prix réduits. Ne manquez pas ces
                            incontournables !
                        </p>
                        <button class="btn btn-warning">Découvrir maintenant</button>
                    </div>
                </div>
                <div class="carousel-item c-item">
                    <img src="./assets/image/bg/shop3.jpg" class="d-block w-100 c-img" alt="...">
                    <div class="carousel-caption custom-caption d-none d-md-block">
                        <h3>Nouveautés</h3>
                        <p>Découvrez notre nouvelle collection d'accessoires tendance pour femme.</p>

                        <p>
                            Nos accessoires les plus vendus à prix réduits. Ne manquez pas ces
                            incontournables pour compléter votre look !
                        </p>
                        <button class="btn btn-warning">Découvrir maintenant</button>
                    </div>
                </div>
                <div class="carousel-item c-item">
                    <img src="./assets/image/bg/shop3.jpg" class="d-block w-100 c-img" alt="...">
                    <div class="carousel-caption custom-caption d-none d-md-block">
                        <h3>Nouveautés</h3>
                        <p>Découvrez notre nouvelle collection d'accessoires tendance pour femme.</p>

                        <p>
                            Nos accessoires les plus vendus à prix réduits. Ne manquez pas ces
                            incontournables pour compléter votre look !
                        </p>
                        <button class="btn btn-warning">Découvrir maintenant</button>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- END  -->
    </section>
    <!-- SECTION Pour les produits -->
    <section>
        <div class="container">
            <h3 class="text-center py-2">Votre satisfaction est tout ce qui compte</h3>
            <div class="d-flex">
                <div class="mx-4 px-1">
                    <ul class="aside px-3 shadow">
                        <h6>Categories</h6>
                        <li class="nav-item nav-link-wrap">
                            <a href="#1" class="nav-link">Tout les Produits</a>
                        </li>
                        <li class="nav-item nav-link-wrap">
                            <a href="#2" class="nav-link">Accessoires Femmes</a>
                        </li>
                        <li class="nav-item nav-link-wrap">
                            <a href="#3" class="nav-link">Chaussures Hommes</a>
                        </li>
                    </ul>
                </div>
                <div class="container">
                    <section id="1">
                        <!-- pARCOURIR LES Produits  -->
                        <div class="liste-produts product">
                            <?php foreach ($Allproduits as $key => $produit) : ?>
                                <!-- Afficher le produit-->
                                <div class="box py-2 py-4">
                                    <!-- <span>40%</span> -->
                                    <div class="card-img">
                                        <img src="assets/image/<?= $produit['image'] ?>" height="150px" alt="">
                                    </div>

                                    <div class="card-body mb-2">
                                        <h6><?= $produit['nom'] ?></h6>
                                        <h5><?= $produit['prixU'] ?></h5>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <del class="text-danger"><?= $produit['prixU'] ?></del>
                                            <a href="panier/ajoutPanier.php?idProduit=<?= $produit['id'] ?>"><i class="bi bi-cart-fill fs-4 text-warning"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                    <section id="2">
                        <!-- Categories Beauté -->
                        <div class="bg-warning mt-2 p-2 d-flex justify-content-between align-items-center">
                            <h5>Meilleures offres Beauté</h5>
                            <a href="./page/femme.php" class="text-dark"> voir Plus <i class="bi bi-chevron-right"></i></a>
                        </div>
                        <!-- Parcourir Produits beauté -->
                        <div class="liste-produts product">
                            <!-- Afficher les produitq -->
                            <?php foreach ($produitsBienEtre as $key => $produit) : ?>
                                <div class="box box-2 py-2 px-2 rounded-2 mt-1">
                                    <span class="percent"> -40%</span>
                                    <div class="card-img">
                                        <!-- l'image du produit -->
                                        <img src="assets/image/<?= $produit['image'] ?>" width="150px" height="100px" alt="" />
                                    </div>
                                    <div class="card-body mb-2">
                                        <!-- nom du produit -->
                                        <p><?= $produit['nom'] ?></p>
                                        <!-- Prix du produit -->
                                        <h5><?= $produit['prixU'] ?></h5>
                                        <!-- reduction prix -->
                                        <del class="text-danger"><?= $produit['prixU'] ?></del>
                                        <a href="panier/ajoutPanier.php?idProduit=<?= $produit['id'] ?>"><i class="bi bi-cart-fill fs-4 text-warning"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                    <section id="3">
                        <!-- Categories Femmes -->

                        <div class="bg-warning mt-2 p-2 d-flex justify-content-between align-items-center">
                            <h5>Meilleures offres Femmes</h5>
                            <h6>voir Plus <i class="bi bi-chevron-right"></i></h6>
                        </div>

                        <!-- Parcourir Produits beauté -->
                        <div class="liste-produts product">
                            <!-- Afficher les produitq -->
                            <?php foreach ($produitsFemme as $key => $produit) : ?>
                                <div class="box box-2 py-2 px-2 rounded-2 mt-1">
                                    <span class="percent"> -40%</span>
                                    <div class="card-img">
                                        <!-- l'image du produit -->
                                        <img src="assets/image/<?= $produit['image'] ?>" width="150px" height="100px" alt="" />
                                    </div>
                                    <div class="card-body mb-2">
                                        <!-- nom du produit -->
                                        <p><?= $produit['nom'] ?></p>
                                        <!-- Prix du produit -->
                                        <h5><?= $produit['prixU'] ?></h5>
                                        <!-- reduction prix -->
                                        <del class="text-danger"><?= $produit['prixU'] ?></del>
                                        <a href="panier/ajoutPanier.php?idProduit=<?= $produit['id'] ?>"><i class="bi bi-cart-fill fs-4 text-warning"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                    <section id="4">
                        <!-- Categories Beauté -->
                        <div class="bg-warning mt-2 p-2 d-flex justify-content-between align-items-center">
                            <h5>Meilleures offre de chaussures pour Hommes</h5>
                            <h6>voir Plus <i class="bi bi-chevron-right"></i></h6>
                        </div>

                        <!-- Parcourir Produits beauté -->
                        <div class="liste-produts product">
                            <!-- Afficher les produitq -->
                            <?php foreach ($produitsHomme as $key => $produit) : ?>
                                <div class="box box-2 py-2 px-2 rounded-2 mt-1">
                                    <span class="percent"> -40%</span>
                                    <div class="card-img">
                                        <!-- l'image du produit -->
                                        <img src="assets/image/<?= $produit['image'] ?>" width="150px" height="100px" alt="" />
                                    </div>
                                    <div class="card-body mb-2">
                                        <!-- nom du produit -->
                                        <p><?= $produit['nom'] ?></p>
                                        <!-- Prix du produit -->
                                        <h5><?= $produit['prixU'] ?></h5>
                                        <!-- reduction prix -->
                                        <del class="text-danger"><?= $produit['prixU'] ?></del>
                                        <a href="panier/ajoutPanier.php?idProduit=<?= $produit['id'] ?>"><i class="bi bi-cart-fill fs-4 text-warning"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                </div>
            </div>
    </section>
    <!-- Categories chaussures -->
    <section>
        <div class="container">
            <h4 class="text-center py-1">Nos collections de chaussures Nike</h4>
            <div class="grid">
                <img src="./assets/image/img5.png" alt="" />
                <img src="./assets/image/img1.png" alt="" />
                <img src="./assets/image/img1.png" alt="" />
                <img src="./assets/image/img3.png" alt="" />
                <img src="./assets/image/img4.png" alt="" />
                <img src="./assets/image/img0.png" alt="" />
                <img src="./assets/image/img8.png" alt="" />
            </div>
        </div>
        <!-- Nouvelles arrivages de chaussures  -->
    </section>
    <footer class="container-fluid text-white text-center text-lg-start bg-dark">
        <!-- Grid container -->
        <div class="container p-4">
            <!--Grid row-->
            <div class="row mt-4">
                <!--Grid column-->
                <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4 fs-6">A propos <img src="assets/image/shopping-bag.png" width="30" alt=""></a></h5>
                    <p class="fs-6 text-light">
                        Bienvenue sur FineShop, votre destination ultime pour trouver les dernières tendances en matière de chaussures de qualité.<br>
                    </p>
                    <div class="mt-4">
                        <!-- Facebook -->
                        <img src="assets/image/face.png" width="30px" alt="">
                        <img src="assets/image/google.png" width="30px" alt="">
                        <img src="assets/image/linkdin.png" width="30px" alt="">
                    </div>
                </div>
                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0 ">
                    <h5 class="text-uppercase mb-4 pb-1 fs-6">Rechercher nous</h5>

                    <div class="form-outline form-white mb-4 d-flex">
                        <input type="text" id="formControlLg" class="form-control form-control-lg" placeholder="recherche" />
                        <button type="submit" class="btn btn-warning d-block mx-2">Search</button>
                    </div>
                </div>
                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4 fs-6">Heure d'ouverture</h5>
                    <table class="table text-center text-white rounded-5 shadow-5">
                        <tbody class="fw-normal">
                            <tr>
                                <td>Lundi - Jeudi:</td>
                                <td>8am - 9pm</td>
                            </tr>
                            <tr>
                                <td>Ven - Dima:</td>
                                <td>8am - 1am</td>
                            </tr>
                            <tr>
                                <td>Sunday:</td>
                                <td>9am - 10pm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--Grid column-->
            </div>
        </div>
        <!-- Copyright -->
        <div class="text-center mb-0 fs-6 py-3" style="background-color: rgba(0, 0, 0, 0.2); color:grey;">
            © 2024 Copyright:
            <a class="text-white fs-6" href="https://finshop.com/">Finshop.com
        </div>
        <!-- Copyright -->
    </footer>
    <!-- jS LINK -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>