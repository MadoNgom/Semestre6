<?php
// ca permet de se connecte a notre base de donne
class DBTransaction{
    public $database;
    public function __construct(){
        //$this represente la class
       if($this->database==null){
           //le protocole c mysql au lieu de https
           $urlDB ="mysql:host=localhost;dbname=FineShop";
           $username="root";
           $password="";
           $this->database = new PDO($urlDB,$username,$password);
           // changer la mode d'envoyer des donnees par defaut c sous forme de tableau associatif
           // elle joue le meme role que json decode 
           $this->database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

       }
    }
    public function searchproduct($keywords){
        try {
            $result = $this->database->query("SELECT *FROM `Produits` WHERE nom LIKE '%$keywords%' ");
            return $result->fetchAll();
        } catch (\PDOException $th) {
            return null;
        }
        
    }
    
    public function createProduitPanier($id_panier,$id_produit,$nbr,$montantTOT){
        try {
            $result = $this->database->query("INSERT INTO `ProduitPanier`
             VALUE(null,'$id_panier', '$id_produit', '$nbr', '$montantTOT' )");
             $result->fetch();
          return 1;
        } catch (\PDOException $th) {
           return 0;
        }
 }
        
        
        public function createProduitCommande($id_commande,$id_produit,$nbr,$montantTOT){
            try {
                $result = $this->database->query("INSERT INTO `ProduitCommande`
                 VALUE(null,'$id_commande', '$id_produit', '$nbr', '$montantTOT' )");
                 $result->fetch();
              return 1;
            } catch (\PDOException $th) {
               return 0;
            }
     }
        
        public function createPanier($montantTOT,$id_client){
            try {
                $result = $this->database->query("INSERT INTO `Panier` VALUE(null,'$montantTOT','$id_client')");
                $result->fetch();
               return 1;
            } catch (\PDOException $th) {
                return 0;
            }
    }
        
        public function createCommande($date,$montantTOT,$etat,$id_client){
            try {
                $result = $this->database->query("INSERT INTO `Commande` VALUE(null,'$date','$montantTOT','$etat','$id_client')");
                $result->fetch();
               return 1;
            } catch (\PDOException $th) {
                return 0;
            }
    }

    public function createproduct($nom, $description, $prixU, $image, $id_boutiquier, $id_categorie) {
        try {
            $query = $this->database->prepare("INSERT INTO Produit (nom, description, prixU, image, id_boutiquier, id_categorie) VALUES (?, ?, ?, ?, ?, ?)");
            $query->execute([$nom, $description, $prixU, $image, $id_boutiquier, $id_categorie]);
            return 1;
        } catch (PDOException $e) {
            return "Erreur d'insertion : " . $e->getMessage();
        }
    }

    public function inscription($nomComplet, $address, $email, $pwd, $profile) {
        try {
            $stmt = $this->database->prepare("INSERT INTO `User` (`nomComplet`, `address`, `email`, `pwd`, `profile`) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nomComplet, $address, $email, $pwd, $profile]);
            return 1; // succès
        } catch (\PDOException $th) {
            // Vous pouvez également enregistrer l'erreur pour le débogage
            return 0; // échec
        }
    }
    


public function connexion($email,$pwd){
    try{
        $result = $this->database->query("SELECT * FROM `User` where email='$email' AND pwd='$pwd'");
        //fetch renvoit un seul valeur et fetchAll renvoit plusieurs valeurs
        return $result->fetch();
    } catch(\PDOException $th) {
        return 0;
    } 
}

  function getALLproduct(){
    $result = $this->database->query("SELECT * FROM Produit ");
    return $result->fetchAll();
 }

 public function getALLproductByHomme($category = 'Chaussure Hommes') {
    $stmt = $this->database->prepare(
        "SELECT Produit.* FROM Produit 
         JOIN Categorie ON Produit.id_categorie = Categorie.id 
         WHERE Categorie.nom = :category"
    );
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getALLproducts($category = 'Tous Les Produits') {
    $stmt = $this->database->prepare(
        "SELECT Produit.* FROM Produit 
         JOIN Categorie ON Produit.id_categorie = Categorie.id 
         WHERE Categorie.nom = :category"
    );
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getALLproductByFemme($category = 'Accessoires Femmes') {
    $stmt = $this->database->prepare(
        "SELECT Produit.* FROM Produit 
         JOIN Categorie ON Produit.id_categorie = Categorie.id 
         WHERE Categorie.nom = :category"
    );
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getALLproductBienEtre($category = 'Beauté et bien être') {
    $stmt = $this->database->prepare(
        "SELECT Produit.* FROM Produit 
         JOIN Categorie ON Produit.id_categorie = Categorie.id 
         WHERE Categorie.nom = :category"
    );
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


   public function readProductByid($id){
       try{
        $result = $this->database->query("SELECT * FROM Produit where id=  $id");
        return $result->fetchAll();
       } catch(\PDOException $th) {
        return 0;
    } 
 }

 public function getProductByIdBoutiquier($id_boutiquier)
 {
     $query = $this->database->prepare("
         SELECT p.*, c.nom AS nom_categorie 
         FROM Produit p
         JOIN Categorie c ON p.id_categorie = c.id
         WHERE p.id_boutiquier = :id_boutiquier
     ");
     $query->bindParam(':id_boutiquier', $id_boutiquier);
     $query->execute();
     return $query->fetchAll(PDO::FETCH_ASSOC);
 }
 public function getCategorieByIdBoutiquier($id_boutiquier){
    $result = $this->database->query("SELECT * FROM `Categorie`WHERE id_boutiquier='$id_boutiquier'");
    return $result->fetchAll();
}


public function getAlluser(){
    try {
        $result = $this->database->query("SELECT * FROM `User`");
    return $result->fetchAll();
    } catch (\PDOException $th) {
        return null;
    }
}

public function getClientPanier($id_client){
    try {
        $result = $this->database->query("SELECT * FROM `Panier` WHERE id_client='$id_client'");
        return $result->fetch();
    } catch (\PDOException $th) {
        return null;
    }
}


public function getCommandeClient($id_client){
    try {
        $result = $this->database->query("SELECT * FROM `Commande` WHERE id_client='$id_client' ORDER BY 'desc'");
        return $result->fetchAll();
    } catch (\PDOException $th) {
        return null;
    }
}

public function getProduitPanier($id_panier){
    try {
        $result = $this->database->query("SELECT * FROM `Produit` JOIN `ProduitPanier`  ON ProduitPanier.id_produit=Produit.id WHERE id_panier=$id_panier");
        return $result->fetchAll();
        // ca permet de ne op selectionner tout 
        //nom, Produit.id as id_produit, ProduitPanier.id as id_panier, 
    } catch (\PDOException  $th) {
      return null;
    }
    
}

public function getProduitCommande($id_commande){
    try {
        $result = $this->database->query("SELECT * FROM `ProduitCommande` JOIN  `Produit` ON ProduitCommande.id_produit=Produit.id WHERE id_commande='$id_commande'");
        return $result->fetchAll();
    } catch (\PDOException  $th) {
      return null;
    }
    
}

public function  getAllCategories(){
    try {
        $result = $this->database->query("SELECT * FROM `Categorie`");
        return $result->fetchAll();
    } catch (\PDOException $th) {
        return null;
    }
}
 
public function createCategorie($nom,$description,$id_boutiquier){
    try {
        $result = $this->database->query("INSERT INTO `Categorie` VALUE(null,'$nom','$description','$id_boutiquier')");
       return 1;
    } catch (\PDOException $th) {
        return 0;
    }
}

public function getAllCommande(){
    try {
        $result = $this->database->query("SELECT * FROM `Commande` ORDER BY 'desc'");
        return $result->fetchAll();
    } catch (\PDOException $th) {
        return null;
    }
}

public function getuserById($id){
        $result = $this->database->query("SELECT * FROM `User`WHERE id='$id'");
        return $result->fetch();
}

public function getPanierById($id){
        $result = $this->database->query("SELECT * FROM `ProduitPanier` WHERE id='$id'");
        return $result->fetch();
}


public function getProductById($id_produit) {
    $stmt = $this->database->prepare("SELECT * FROM `Produit` WHERE id = :id");
    $stmt->execute(['id' => $id_produit]);
    return $stmt->fetch();
}


public function getCategorieById($id_categorie){

    $result = $this->database->query("SELECT * FROM `Categorie`WHERE id='$id_categorie'");
    return $result->fetch();
}


public function rejetCommande($id_commande){
    try {
        $result = $this->database->query("UPDATE `Commande` SET etat='REJETER' WHERE id='$id_commande'");
        return $result->fetch();
    } catch (\PDOException $th) {
        return null;
    }  
}

public function validerCommande($id_commande){
    try {
        $result = $this->database->query("UPDATE `Commande` SET etat='VALIDER' WHERE id='$id_commande'");
        $result->fetch();
       return 1;
    } catch (\PDOException $th) {
        return 0;
    }
}


public function updateUser($id, $nomComplet, $email, $pwd, $profile){
    try {
        $stmt = $this->database->prepare("UPDATE `User` SET nomComplet=:nomComplet, email=:email, pwd=:pwd, profile=:profile WHERE id=:id");
        $stmt->bindParam(':nomComplet', $nomComplet);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->bindParam(':profile', $profile);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return 1;
    } catch (PDOException $th) {
        // Log de l'exception : error_log($th->getMessage());
        return 0;
    }
}


public function updateProfilUser($id,$profile){
    try {
    $result =$this->database->query("UPDATE `User` SET profile='$profile'WHERE id='$id'");
    $result->fetch();
   return 1;
    } catch (PDOException $th) {
        return 0;
    }
}

public function updateCategorie($id, $nom, $description){
    try {
        $stmt = $this->database->prepare("UPDATE `Categorie` SET nom=:nom, description=:description WHERE id=:id");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return 1;
    } catch (PDOException $th) {
        // Log de l'exception : error_log($th->getMessage());
        return 0;
    }
}


public function updateprofil($id,$nomComplet,$email,$pwd){
    try {
    $result =$this->database->query("UPDATE `User` SET nomComplet='$nomComplet',email='$email' WHERE id='$id'");
   return 1;
    } catch (PDOException $th) {
        return 0;
    }
}

public function updatePanier($id_panier,$montantTOT){
    try {
        $result = $this->database->query("UPDATE `Panier` SET montantTOT='$montantTOT' WHERE id='$id_panier'");
        $result->fetch();
       return 1;
    } catch (\PDOException$th) {
        return 0;
    }
 }



public function updateNbrPanier($idProduit, $nbr, $montantTOT) {
    try {
        $stmt = $this->database->prepare("UPDATE `ProduitPanier` SET nbr = :nbr, montantTOT = :montantTOT WHERE id = :idProduit");
        $stmt->bindParam(':nbr', $nbr, PDO::PARAM_INT);
        $stmt->bindParam(':montantTOT', $montantTOT, PDO::PARAM_STR);
        $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
        $stmt->execute();

        // Vérifiez si la mise à jour a réussi
        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            error_log("Aucune ligne mise à jour pour le produit ID: $idProduit");
            return 0;
        }
    } catch (PDOException $e) {
        error_log("Erreur dans updateNbrPanier: " . $e->getMessage());
        return 0;
    }
}


public function updateNbrproduitPanier($id,$nbr,$montantTOT){
    try {
    $result =$this->database->query("UPDATE `ProduitPanier` SET nbr='$nbr',montantTOT='$montantTOT' WHERE id='$id'");
    $result->fetch();
   return 1;
    } catch (PDOException $th) {
        return 0;
    }
}

public function updateproduit($id, $nom, $description,$prixU){
    $result =$this->database->query("UPDATE `Produit` SET nom='$nom',description='$description',prixU='$prixU' WHERE id='$id'");
}

public function deletPanierById($id){
    try {
            $result = $this->database->query("DELETE FROM `ProduitPanier`WHERE id='$id'");
    } catch (\PDOException $th) {
        return null;
    }
}

public function deletCategorieById($id){
    try {
            $result = $this->database->query("DELETE FROM `Categorie`WHERE id='$id'");
    } catch (\PDOException $th) {
        return null;
    }
}

public function deletProductPanier($id){
    try {
        $result = $this->database->query("DELETE  FROM `ProduitPanier` WHERE id='$id'");
    } catch (\PDOException $th) {
        return null;
    }  
}

// ca permet de supprimer panier deja valider
public function resetPanier($id_panier){
    $result = $this->database->query("DELETE FROM `ProduitPanier` WHERE id_panier='$id_panier'");
    return $result->fetch();
}

public function deleteUserById($id_user) {
    try {
        $stmt = $this->database->prepare("DELETE FROM `User` WHERE id = :id");
        $stmt->bindParam(':id', $id_user, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $th) {
        echo 'Erreur: ' . $th->getMessage();
    }
}

public function deleteProductById($id_produit) {
    try {
        $stmt = $this->database->prepare("DELETE FROM `Produit` WHERE id = :id");
        $stmt->bindParam(':id', $id_produit, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $th) {
        echo 'Erreur: ' . $th->getMessage();
    }
}


public function deleteCategorieById($id_categorie) {
    try {
        $stmt = $this->database->prepare("DELETE FROM `Categorie` WHERE id = :id");
        $stmt->bindParam(':id', $id_categorie, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $th) {
        echo 'Erreur: ' . $th->getMessage();
        return null;
    }
}



public function updateProduitPanier($idPanier, $idProduit, $quantite) {
    // Met à jour la quantité du produit dans le panier
    $query = "UPDATE ProduitPanier SET nbr = ? WHERE id_panier = ? AND id_produit = ?";
    $stmt = $this->database->prepare($query);
    $stmt->execute([$quantite, $idPanier, $idProduit]);
}

public function deleteProduitPanier($idPanier, $idProduit) {
    // Supprime le produit du panier
    $query = "DELETE FROM ProduitPanier WHERE id_panier = ? AND id_produit = ?";
    $stmt = $this->database->prepare($query);
    $stmt->execute([$idPanier, $idProduit]);
}


}
?>


