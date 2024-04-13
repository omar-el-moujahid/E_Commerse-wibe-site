
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
    ?>
<div class="container">
    <h4 class="my-3">  Add Categories </h4>
    <?php
     if(isset($_POST["add_Categories"])) {
            if(empty($_POST["Description"]) || empty($_POST["libelle"])  || empty($_POST["icone"]) ){
                ?>
                <div class="alert alert-danger" role="alert"> Please fill all libelle , description and icone fields.</div>

                <?php
                
            } 
            else {
                $lebelle = $_POST["libelle"];
                $description = $_POST["Description"];
                $icone = $_POST["icone"];
                include '../include/conectionsql.php';
                $requit="INSERT INTO categorie (libelle ,description , icone) VALUES ('$lebelle', '$description' , '$icone')";
                if (mysqli_query($connection, $requit)) {
                    ?>
                <div class="alert alert-primary" role="alert">  Categorie added successfully.</div>
                
                <?php
                header('Location: Categories.php');
                } 
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                }

                

            }
        }

        



    ?>
    <form action="" method="post">
        <label class="form-label">Libelle</label>
        <input type="text"  class="form-control" name="libelle" >

        

        <label class="form-label my-3">Description</label>
        <textarea name="Description"  class="form-control"></textarea>

        <label class="form-label">Icone</label>
        <input type="text"  class="form-control" name="icone" >

        <input type="submit" value="Add Categories" class="btn btn-primary btn-lg my-3" name="add_Categories">
    </form>
</div>
    
    
</body>
</html>