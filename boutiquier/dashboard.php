<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard Boutiquier</title>
   <!-- BOOSTRAP Icons link -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <!-- BOOSTRAP CDN LINK -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <!-- Style Link -->
   <link rel="stylesheet" href="../assets/styles/dashboard.css">
</head>

<body>
   <!-- admin.component.html -->
   <div class="admin-container">
      <aside class="aside bg-dark text-light">
         <div class="d-flex align-items-center px-4">
            <h4 class="mx-2">Finshop</h4>
            <img src="../../../../assets/images/shopping-bag.png" width="40px" />
         </div>
         <hr />
         <ul class="nav-ul">
            <li class="nav-item active">
               <span><i class="bi bi-columns-gap"></i></span>
               <a href="" class="nav-link"> Dashboard</a>
            </li>

            <li class="nav-item">
               <span> <i class="bi bi-boxes"></i></span>
               <div class="dropdown">
                  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Produits
                  </a>

                  <ul class="dropdown-menu">
                     <li>
                        <a class="dropdown-item" href="./ajout-produit.php">Ajouter Produits</a>
                     </li>
                     <li>
                        <a class="dropdown-item" href="">Tout les catégories</a>
                     </li>
                  </ul>
               </div>
            </li>
            <li class="nav-item">
               <span><i class="bi bi-bag-check-fill"></i></span>
               <a href="" class="nav-link">Categories</a>
            </li>
            <li class="nav-item active">
               <span><i class="bi bi-bag-check-fill"></i></span>
               <a href="" class="nav-link">
                  Commande Clients</a>
            </li>
            <li class="nav-item">
               <span><i class="bi bi-person-fill-gear"></i></span>
               <a href="" class="nav-link">Mes Ventes</a>
            </li>

            <li class="nav-item logout">
               <a href="" class="nav-link"><i class="bi bi-box-arrow-right text-white fs-5"></i> Déconnection</a>
            </li>
         </ul>
      </aside>
      <header class="header"></header>
      <div class="content">
         <div class="container-fluid">
            <div class="grid mt-4">
               <div class="card py-3 px-2">
                  <div class="card-body">
                     <div class="d-flex justify-content-between align-items-center">
                        <div>
                           <span class="h5 text-black-50 fs-5">Nombre de vente</span>
                           <h2>350.857</h2>
                        </div>
                        <div class="icons">
                           <i class="bi bi-bag-check-fill"></i>
                        </div>
                     </div>
                     <div>
                        <span class="text-success">348%</span>
                        <span class="mx-3 text-black-50">ce mois ci </span>
                     </div>
                  </div>
               </div>
               <div class="card py-3 px-2">
                  <div class="card-body">
                     <div class="d-flex justify-content-between align-items-center">
                        <div>
                           <span class="h5 text-black-50 fs-5">Nombre de vente</span>
                           <h2>350.857</h2>
                        </div>
                        <div class="icons">
                           <i class="bi bi-bag-check-fill"></i>
                        </div>
                     </div>
                     <div>
                        <span class="text-success">348%</span>
                        <span class="mx-3 text-black-50">ce mois ci </span>
                     </div>
                  </div>
               </div>
               <div class="card py-3 px-2">
                  <div class="card-body">
                     <div class="d-flex justify-content-between align-items-center">
                        <div>
                           <span class="h5 text-black-50 fs-5">Nombre de vente</span>
                           <h2>350.857</h2>
                        </div>
                        <div class="icons">
                           <i class="bi bi-bag-check-fill"></i>
                        </div>
                     </div>
                     <div>
                        <span class="text-success">348%</span>
                        <span class="mx-3 text-black-50">ce mois ci </span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <section class="bg-white">
            <div class="container">
               <div class="table-title p-2 bg-white">
                  <h5>Commande clients</h5>
                  <hr />
               </div>
               <div class="table-body">
                  <table class="table-striped">
                     <!-- TABLE HEADER -->
                     <thead>
                        <tr>
                           <th>Id</th>
                           <th>Client</th>
                           <th>Addresse</th>
                           <th>Date Commande</th>
                           <th>Montant</th>
                           <th>Etat</th>
                        </tr>
                     </thead>
                     <!-- TABLE BODY -->
                     <tbody>
                        <tr>
                           <td>1</td>
                           <td>

                              Aminata Fall
                           </td>
                           <td>Dakar/Parcelles</td>
                           <td>
                              <p>12 / Juilet / 2024</p>
                           </td>
                           <td>54.500 Fcfa</td>
                           <div class="d-flex">
                              <td class="text-success">Valider</td>
                              <td class="text-danger">Rejeter</td>
                           </div>
                        </tr>
                        <tr>
                           <td>2</td>
                           <td>

                              Aminata Fall
                           </td>
                           <td>Dakar/Parcelles</td>
                           <td>
                              <p>12 / Juilet / 2024</p>
                           </td>
                           <td>54.500 Fcfa</td>
                           <div class="d-flex">
                              <td class="text-success">Valider</td>
                              <td class="text-danger">Rejeter</td>
                           </div>
                        </tr>
                        <tr>
                           <td>2</td>
                           <td>

                              Aminata Fall
                           </td>
                           <td>Dakar/Parcelles</td>
                           <td>
                              <p>12 / Juilet / 2024</p>
                           </td>
                           <td>54.500 Fcfa</td>
                           <div class="d-flex">
                              <td class="text-success">Valider</td>
                              <td class="text-danger">Rejeter</td>
                           </div>
                        </tr>

                     </tbody>
                  </table>
               </div>
            </div>
         </section>
      </div>
   </div>
   <!-- jS LINK -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>