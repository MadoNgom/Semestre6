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
   <style>
      .cart-content {
         background-color: #f0f0f0ee;
         padding: 0.5rem;
         border-radius: 5px;
      }

      .resumer {
         box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
      }
   </style>
</head>

<body>
   <?php
   include('../page/header.php')
   ?>
   <div class="container mt-4">
      <h2>Panier (8)</h2>
      <section class="row d-flex">
         <div class="col-md-8">
            <!-- card-content -->
            <div class="cart-content mb-3">
               <div class="d-flex justify-content-between align-items-center">
                  <div class="left-content d-flex align-items-center">
                     <!-- IMage de Produit -->
                     <img src="../../../assets/images/img1.png" alt="" height="100px" />
                     <div class="mx-3">
                        <!-- NOM DU PRODUIT -->
                        <h5 class="product-name">Nike Air Force 1 '07</h5>
                        <!-- NOM VENDEUR -->
                        <p>Vendeur : bellaBoutique</p>
                        <!-- EN ETAT -->
                        <p class="fs-6 text-success">En Stock</p>
                     </div>
                  </div>
                  <div class="right-content">
                     <!-- PRIX UNITAIRE -->
                     <h5>25.500</h5>
                     <del>40.000</del>
                  </div>
               </div>
               <div class="d-flex justify-content-between align-items-center">
                  <!-- BUTTON SUPPRIMER DU PANIER -->
                  <button class="btn btn-outline-danger">
                     <i class="bi bi-trash"></i> supprimer
                  </button>
                  <div>
                     <div class="d-flex fs-4">
                        <!-- BOUTTON DIMINUER QUANTITé -->
                        <button class="btn btn-danger" onclick="decreaseValue()">
                           <i class="bi bi-dash fw-bold" style="cursor: pointer"></i>
                        </button>
                        <input type="number" name="quantity" value="0" class="form-control mx-2 w-25 text-center" id="quantityInput">

                        <!-- BOUTTON AUGMENTER -->
                        <button class="btn btn-dark" onclick="increaseValue()">
                           <i class="bi bi-plus fw-bold" style="cursor: pointer"></i>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4 resumer">
            <h6>Résumer Panier</h6>
            <hr />
            <div class="d-flex justify-content-between align-items-center">
               <span>Total Panier :</span>
               <h4>54.500 fr</h4>
            </div>
            <p class="text-black-50 my-2">Frais de livraison non inclus à ce stade</p>
            <button class="btn btn-danger w-100 d-block my-3">
               Commander <span>(54.500 fr)</span>
            </button>
            <div>
               <h6>Les retours sont faciles</h6>
               <p class="fs-6 text-black-50">Retours gratuits sous 7 jour</p>
            </div>
         </div>
      </section>
   </div>
   <script>
      function increaseValue() {
         var input = document.getElementById('quantityInput');
         var value = parseInt(input.value, 10);
         value = isNaN(value) ? 0 : value;
         value++;
         input.value = value;
      }

      function decreaseValue() {
         var input = document.getElementById('quantityInput');
         var value = parseInt(input.value, 10);
         value = isNaN(value) ? 0 : value;
         value--;
         if (value < 0) value = 0;
         input.value = value;
      }
   </script>


   <!-- HEADER END -->
   <!-- jS LINK -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>