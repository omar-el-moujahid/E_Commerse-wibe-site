<?php
    $id=$_GET["id"];
    $requite = "SELECT * FROM produit WHERE id = $id";
    include '../include/conectionsql.php';
    $result = mysqli_query($connection, $requite);
    if ( mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "!good";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" >
    
    <title><?php echo $product["libelle"]?> </title>
</head>
<body>

    <?php
        include '../include/nav_front.php';
    ?>
   
    <div class="container">
         <h4 class="my-3"><?php echo $product["libelle"]?>
          </h4>
         <hr class="border border-danger border-2 opacity-50">
        <hr class="border border-primary border-3 opacity-75"> 

        <div class="row">
            <div class="col-md-6 right">

            <?php
                if(empty($product["icone"])){
                    ?>
                    <img  class="img img-fluid w-75"  src="../upload/pro/images.jpeg"class="card-img-top" alt="...">
                    <?php   
                }

                else{
                    ?>
                    <img  class="img img-fluid w-75"  src="../upload/pro/<?php
                    echo  $product["icone"]
                    ?>
                    "class="card-img-top" alt="...">
                    <?php    
                }
            ?>
              
            </div>
            <div class="col-md-6 left">
                <h1>
                <?php echo$product["libelle"]?>
                </h1>
                <hr>
                <p >
                    <?php
                             echo  $product["disription"]
                            ?> 
                    </p>
                    <hr>
                <?php

                
                if(!empty($product["discount"])){
                    ?>
                    <h2>
                                     
                     </h2>

                     <h2>
                    Price :
                    <?php
                         $prix_dicount = $product["prix"]  - ($product["prix"]/ $product["discount"]);
                         $prix_dicount= number_format($prix_dicount , 2);
                            ?> 
                            <span class="badge text-bg-danger" style="text-decoration: line-through;">
                    <?php
                     echo $product["prix"];
                    ?> MAD
                    </span>   
                            <span class="badge text-bg-success">
                            <?php
                             echo  $prix_dicount;
                            ?> MAD
                            </span>
                            
                    </h2>

                    <p> Discount: 
                        <span class="badge text-bg-secondary">
                            <?php
                             echo  - $product["discount"]
                            ?> %
                        </span>
                     
                    </p>
                     <?php     
                }

                else{
                    ?>
                    <h2>
                            <span class="badge text-bg-success">
                            <?php
                             echo $product["prix"];
                            ?> MAD
                            </span>
                            
                    </h2> 
                    <?php    
                }
            ?>
            <div class="card-footer" style="z-index: 100;">
                            <div class="counter d-flex" style="width: 100%;">
                                <button class="btn btn-primary mx-2" onclick="plus(<?php echo $product['id'];?>)">+</button>
                                <input class="form-control" type="number" name="qantite" id="<?php echo $product['id'];?>" style="width: 50%;" value="0" min=0>
                                <button class="btn btn-primary mx-2" onclick="minus(<?php echo $product['id'];?>)">-</button>
            </div>  
            <a href="#" class="btn btn-primary my-3"> ADD TO PANNI</a>
 
        </div>
            
        </div>
    </div>
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
</body>
</html>