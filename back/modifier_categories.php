
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Add Categroies</title>
</head>
<body>
    <?php 
    include'../include/nav.php';
    $id=$_GET["id"];
    ?>
<div class="container">
    <h4 class="my-3">  Modify Categorie </h4>
    <?php

        $requit="SELECT * FROM categorie WHERE id=$id";
        include '../include/conectionsql.php';
        $result=mysqli_query($connection , $requit);
        $categorie = mysqli_fetch_assoc($result);
    ?>
    <?php
        if(isset($_POST["modify_Categories"])){
            $id=$_POST["id"];
            $libelle=$_POST["libelle"];
            $description=$_POST["Description"];
            $icone=$_POST["icone"];
            $requit2="UPDATE  categorie SET libelle='$libelle' ,description='$description' , icone='$icone'  WHERE id=$id";
            if(mysqli_query($connection, $requit2)) {
                ?>
                <div class="alert alert-primary" role="alert">Product Modify successfully.</div>
                <?php
                header('Location: Categories.php');
            } else {
                ?>
                <div class="alert alert-danger" role="alert">Error Modifing product: <?php echo mysqli_error($connection); ?></div>
                <?php
            }
            
        }
    ?>
    <form action="" method="post">
       <label class="form-label">Id</label>
        <input type="number" hidden readonly class="form-control" name="id" value="<?php echo $categorie["id"] ?>" >
        <label class="form-label">Libelle</label>
        <input type="text"  class="form-control" name="libelle" value="<?php echo $categorie["libelle"] ?>">

        <label class="form-label my-3">Description</label>
        <textarea name="Description"  class="form-control" ><?php echo $categorie["description"] ?></textarea>

        <label class="form-label">Icone</label>
        <input type="text"  class="form-control" name="icone" value="<?php echo $categorie["icone"] ?>">

        <input type="submit" value="Modify Categories" class="btn btn-primary btn-lg my-3" name="modify_Categories">
    </form>
</div>
    
    
</body>
</html>