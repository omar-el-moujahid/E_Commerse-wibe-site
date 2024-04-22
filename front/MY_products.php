<?php
    include '../include/conectionsql.php';

    $requite_globale = "SELECT * FROM categorie ";
    $requite_globale = $connection_opd->query("SELECT * FROM categorie ");
    $cats = $requite_globale->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" >
    <title>Listed by Category</title>
</head>
<body>

    <?php include '../include/nav_front.php'; ?>
   
    <div class="container">
        <?php foreach($cats as $cat): ?>
            <h4 class="my-3"><?php echo $cat->libelle; ?></h4>
            <hr class="border border-danger border-2 opacity-50">
            <hr class="border border-primary border-3 opacity-75"> 

            <?php 
                $requit2 = "SELECT * FROM produit WHERE id_categorie = ?";
                $result2 = $connection_opd->prepare($requit2);
                $result2->execute([$cat->id]);
                $products = $result2->fetchAll(PDO::FETCH_ASSOC);
            ?>       

            <div class="container">
                <div class="row">
                    <?php foreach($products as $product): ?>
                        <div class="card mb-4 col-md-3 m-4 ">
                            <?php if(empty($product["icone"])): ?>
                                <img src="../upload/pro/images.jpeg" class="card-img-top w-50 mx-auto" alt="...">
                            <?php else: ?>
                                <img src="../upload/pro/<?php echo $product["icone"]; ?>" class="card-img-top w-50 mx-auto" alt="...">
                            <?php endif; ?>

                            <div class="card-body">
                                <a class="btn stretched-link" href="produit.php?id=<?php echo $product["id"]; ?>">More Details</a>

                                <h5 class="card-title"><?php echo $product["libelle"]; ?></h5>

                                <?php if(!empty($product["discount"])): ?>
                                    <p class="card-text">
                                        <?php
                                            $prix_discounted = $product["prix"] - ($product["prix"] / $product["discount"]);
                                            $prix_discounted = number_format($prix_discounted , 2);
                                            echo $prix_discounted . " MAD";
                                        ?>
                                    </p>
                                <?php else: ?>
                                    <p class="card-text"><?php echo $product['prix'] . " MAD"; ?></p>
                                <?php endif; ?>
                            
                                <p class="card-text"><small class="text-body-secondary">
                                    <?php echo date_format(date_create($product["date_de_creation"]), 'Y/m/d'); ?>
                                </small></p>
                            </div>

                            <div class="card-footer" style="z-index: 100;">
                                <?php include '../include/add_pannier_from_form.php'; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if (empty($products)): ?>
                        <div class="alert alert-info" role="alert"> Category empty for now!</div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        var number;
        function plus(id) {
            var number = (document.getElementById(id).value); 
            number++;
            document.getElementById(id).value = number;
        }
        function minus(id) {
            var number = (document.getElementById(id).value); 
            if(number > 0) {
                number--;
            }
            document.getElementById(id).value = number;
        }

        var windowWidth = window.innerWidth;
        console.log(windowWidth);
        if(windowWidth < 450) {
            var childElements = document.querySelector("#row");
            childElements.forEach(function(child) {
                child.classList.remove("col-md-3");
                child.classList.add("col-md-5");
            });
        }
    </script>

</body>
</html>
