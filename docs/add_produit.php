<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Add Produits</title>
</head>
<body>
    <?php 
    include 'include/nav.php';
    ?>
<div class="container">
    <h4 class="my-3">Add Product</h4>
    <?php
    if(isset($_POST["add_Produit"])) {
        if(empty($_POST["libelle"]) || empty($_POST["prix"]) || empty($_POST["discount"]) || empty($_POST["categorie"])) {
            ?>
            <div class="alert alert-danger" role="alert">Please fill all libelle, prix, discount, and categorie fields.</div>
            <?php
        } else {
            $libelle = $_POST["libelle"];
            $discount = $_POST["discount"];
            $prix = $_POST["prix"];
            $categorie = $_POST["categorie"];
            
            include 'include/conectionsql.php';                
                $requit2 = "INSERT INTO produit (libelle, prix, discount, id_categorie) VALUES ('$libelle', '$prix', '$discount', '$categorie')";
                if(mysqli_query($connection, $requit2)) {
                    ?>
                    <div class="alert alert-primary" role="alert">Product added successfully.</div>
                    <?php
                    header('Location: Produits.php');
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">Error adding product: <?php echo mysqli_error($connection); ?></div>
                    <?php
                }
            
        }
    }
    ?>

   
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label class="form-label">Libelle</label>
        <input type="text" class="form-control" name="libelle">

        <label class="form-label">Prix</label>
        <input type="number" step="0.1" class="form-control" name="prix" min=0 >

        <label class="form-label">Discount</label>
        <input type="text" class="form-control my-3" name="discount" pattern="[0-9]+" title="Please enter a numeric value" value="00">


        
        
        <?php
  
            $requit1='SELECT * FROM categorie';
            include 'include/conectionsql.php';
            $result_categories = mysqli_query($connection, $requit1);
            
        ?>

        <select name="categorie" class="form-control">
            <option>
                Choisir une categories
            </option>

            <?php
             if($row = mysqli_fetch_assoc($result_categories)) {
                
            foreach($result_categories as $catego){
                echo "<option value='".$catego["id"]."'>".$catego["libelle"]."</option>";
            }
        }
        else{
            echo "<p>h</p>";
        }
            ?>
        </select>

        <input type="submit" value="Add Product" class="btn btn-primary btn-lg my-3" name="add_Produit">
    </form>
</div>
</body>
</html>
