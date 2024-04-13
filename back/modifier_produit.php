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
    include '../include/nav.php';
    

    ?>
<div class="container">
    <h4 class="my-3">Modify Product</h4>
    <?php
        


        include '../include/conectionsql.php';                
        $id=$_GET["id"]; // Get product ID from URL
        $requit = "SELECT * FROM produit WHERE id = $id";
        $result1 = mysqli_query($connection, $requit);
        $product = mysqli_fetch_assoc($result1); 
        $id_cat=$product["id_categorie"];
       
        $requit2 = "SELECT id ,libelle FROM categorie WHERE id ='$id_cat'";
        $result2 = mysqli_query($connection, $requit2);
        $libelle_cat = mysqli_fetch_assoc($result2); 
    ?>

    <?php

        if(isset($_POST["update"])){
            var_dump($product["id"]);
            $libelle = $_POST["libelle"];
            $discount = $_POST["discount"];
            $prix = $_POST["prix"];
            $categorie = $_POST["categorie"]; 
            $id=  $_POST["id"];
            $icone=$_POST["icone"];
            $disription=$_POST["disription"];

        /* if(isset($_FILES['icone'])) {
            $image = $_FILES['icone']['name'];
            
            $upload_dir = '../upload/pro/';
             
            $name_file = uniqid(). $image;
            
    
            if(move_uploaded_file($_FILES["icone"]["tmp_name"],'../upload/pro/'.$name_file)) {
                echo 'File uploaded successfully.';
            } else {
                echo 'Error uploading file.';
            }
        } */
        $name_file='';
        if(!empty($_FILES['icone']['name'])){
            $image = $_FILES['icone']['name'];
            
            $upload_dir = '../upload/pro/';
             
            $name_file = uniqid(). $image;
            
    
            if(move_uploaded_file($_FILES["icone"]["tmp_name"],'../upload/pro/'.$name_file)) {
                echo 'File uploaded successfully.';
            } else {
                echo 'Error uploading file.';
            }
        }
        $description = $_POST["description"];
        if(!empty($name_file)){
            $requit3 = "UPDATE produit SET libelle='$libelle', prix='$prix', discount='$discount',id_categorie='$categorie', icone='$name_file' ,disription='$description' WHERE id='$id'";
        }
        else{

            $requit3 = "UPDATE produit SET libelle='$libelle', prix='$prix', discount='$discount',id_categorie='$categorie',disription='$description' WHERE id='$id'";

        }
            

                if(mysqli_query($connection, $requit3)) {
                    ?>
                    <div class="alert alert-primary" role="alert">Product Modify successfully.</div>
                    <?php
                    header('Location: Produits.php');
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">Error Modifing product: <?php echo mysqli_error($connection); ?></div>
                    <?php
                }
        }
    ?>
    
   
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label  class="form-label">id</label>
        <input hidden readonly type="text" class="form-control" name="id"
        value="<?php echo $product["id"];?>">

        <label class="form-label">Libelle</label>
        <input type="text" class="form-control" name="libelle"
        value="<?php echo $product["libelle"];?>">

        <label class="form-label">Prix</label>
        <input type="number" step="0.1" class="form-control" name="prix" min=0 
        value="<?php echo $product["prix"];?>">

       

        <label class="form-label">Discount</label>
        <input type="text" class="form-control my-3" name="discount" pattern="[0-9]+" title="Please enter a numeric value" value="<?php echo $product["discount"];?>"  >
        
        <label class="form-label my-3">Description</label>
    <textarea name="description" class="form-control"><?php echo $product["disription"] ?></textarea>

    <label class="form-label">Image</label>
<input type="file" class="form-control" name="icone">
<?php if (!empty($product["icone"])): ?>
    <p>Fichier actuellement téléchargé : <?php echo $product["icone"]; ?></p>
<?php endif; ?>


        <?php
  
            $requit1='SELECT * FROM categorie';
            $result_categories = mysqli_query($connection, $requit1);
            
        ?>

<select name="categorie" class="form-control my-3">
    <?php
    // Loop through all categories
    while($catego = mysqli_fetch_assoc($result_categories)) {
        // Check if the current category matches the product's category
        $selected = ($catego["id"] == $product["id_categorie"]) ? "selected" : "";
        // Output option tag with selected attribute if matched
        echo "<option value='".$catego["id"]."' $selected>".$catego["libelle"]."</option>";
    }
    ?>
</select>

        <input type="submit" value="Update Product" class="btn btn-primary btn-lg my-3" name="update">
    </form>
</div>
</body>
</html>
