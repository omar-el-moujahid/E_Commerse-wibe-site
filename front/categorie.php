<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" >
    <title>Listed by Categorie </title>
</head>
<body>

    <?php
        include '../include/nav_front.php';
    ?>
   
    <div class="container">
    <?php
            $id=$_GET["id"];
                $requite = "SELECT libelle FROM categorie WHERE id = $id";
                include '../include/conectionsql.php';
                $result = mysqli_query($connection, $requite);
                if ( mysqli_num_rows($result) > 0) {
                    $libelle = mysqli_fetch_assoc($result);
                } else {
                    echo "!good";
                }
        ?>
         <h4 class="my-3"><?php
           echo $libelle["libelle"];
         ?> </i> 
          </h4>
         <hr class="border border-danger border-2 opacity-50">
        <hr class="border border-primary border-3 opacity-75"> 

        <?php 
            $requit2="SELECT * FROM produit WHERE id_categorie =$id";
            $result2=mysqli_query($connection,$requit2);
            $products=mysqli_fetch_all($result2,MYSQLI_ASSOC);
        ?>

        <div class="container">
                <div class="row">
                    <?php
                        foreach($products as $product){
                            ?>
                            <div class="card mb-4 col-md-3 m-4 ">
                            <?php
                                    if(empty($product["icone"])){
                                        ?>
                                        <img src="../upload/pro/images.jpeg" class="card-img-top  w-50 mx-auto " alt="...">
                                        <?php   
                                    }

                                    else{
                                        ?>
                                        <img src="../upload/pro/<?php
                                        echo  $product["icone"]
                                        ?>
                                        "class="card-img-top w-50 mx-auto" alt="...">
                                        <?php    
                                    }
                                ?>

                            <div class="card-body">
                            <a class="btn stretched-link" href="produit.php?id=<?php echo $product["id"]; ?>">More Details</a>

                            <h5 class="card-title">
                                <?php
                                echo $product["libelle"];
                                ?>
                            </h5>
                            <!--  <p class="card-text">
                            <?php
                            $prix_dicount = $product["prix"]  - ($product["prix"]/ $product["discount"]);
                            $prix_dicount= number_format($prix_dicount , 2);
                                echo $prix_dicount;
                                echo  $product["disription"];
                                ?> 
                            </p> -->
                            <?php 
                            if(!empty($product["discount"])){
                            ?>
                            <p class="card-text">
                            
                            <?php
                            $prix_dicount = $product["prix"]  - ($product["prix"]/ $product["discount"]);
                            $prix_dicount= number_format($prix_dicount , 2);
                            echo $prix_dicount;
                            ?> MAD
                            </p>
                            <?php
                            }else{
                                ?>
                                <p class="card-text">
                            <?php
                            echo $product['prix'];
                            ?> MAD
                            </p>
                                <?php
                            }
                            ?>
                            
                            <p class="card-text"><small class="text-body-secondary">
                                <?php
                                echo date_format(date_create($product["date_de_creation"]),'Y/m/d');
                                ?> 
                            </small></p>
                        </div>
                        <div class="card-footer" style="z-index: 100;">
                            <div class="counter d-flex" style="width: 100%;">
                                <button class="btn btn-primary mx-2" onclick="plus(<?php echo $product['id'];?>)">+</button>
                                <input class="form-control" type="number" name="qantite" id="<?php echo $product['id'];?>" style="width: 50%;" value="0" min=0>
                                <button class="btn btn-primary mx-2" onclick="minus(<?php echo $product['id'];?>)">-</button>
                            </div>
                        </div>
                     </div>
                        <?php
                    }

                    
                    if (empty($products)) {
                        echo '<div class="alert alert-info" role="alert"> categorie empty for now!</div>';
                    }
                    
                ?>

                        <script>
                            var number  ;
                            function plus(id){
                                var number = (document.getElementById(id).value); 
                                number++;
                                document.getElementById(id).value=number;
                            }
                            function minus(id){
                                
                                var number = (document.getElementById(id).value); 
                                if(number>0){
                                    number--;
                                }
                                document.getElementById(id).value=number;
                            }

                            var windowWidth = window.innerWidth;
                            console.log(windowWidth);
                            if(windowWidth<450){
                                var childElements = document.querySelector("#row");
                                childElements.forEach(function(child) {
                                child.classList.remove("col-md-3");
                                child.classList.add("col-md-5");
                            });
                                

                            }
                        </script>



            </div>
        </div>
        
    </div>

</body>
</html>