<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" >
    <title> Basket </title>
</head>
<body>

    <?php
        include '../include/nav_front.php';
    ?>
   <?php
   include '../include/conectionsql.php';
   $total=0;
   ?>
    <div class="container py-2">
            <?php
                    $id_user=$_SESSION['Utilisateure']['id'];
                    $pannier=$_SESSION['pannier'][$id_user];
                    if(empty( $pannier)){
                    ?>
                    <div class="alert  alert-warning"> Your Basket is empty for now add   <a href="index.php"> production </a></div>
                    <?php
                    }
                    else{
                        $ids_pro=array_keys($pannier);
                        //var_dump(array_keys($ids_pro)) ;
                        /* foreach($ids_pro as $id_pro){
                            $requit="SELECT * FROM produit WHERE id= $id_pro ";
                            $result=mysqli_query($connection,$requit);
                            $produit=mysqli_fetch_assoc($result);
                        } */
                        $id_produits=implode(",",$ids_pro); 
                        $id_produits ="(".$id_produits.")";
                        $sql_state = $connection_opd->query("SELECT * FROM produit WHERE id IN $id_produits");
                        $produis=$sql_state->fetchAll(PDO::FETCH_ASSOC);
                        //var_dump($produis);
                        ?>
                                    <h4 class="my-3"> Basket ( <?php echo count($produis) ?> ) </h4>
            <hr class="border border-danger border-2 opacity-50">
            <hr class="border border-primary border-3 opacity-75"> 
            <div class="container">
            <div class="row">
               
                        <table class="table table-dark table-striped my-3 ">
                            <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Qauntity</th>
                                        <th>Prix</th>
                                        <th>Totale</th>


                                    </tr>
                            </thead>
                        <tbody>
                        <?php
                        foreach($produis as $product){

                            ?>

                   <tr>
                   <td><?php echo $product["id"]; ?></td>
                  
                   <td> <img src="../upload/pro/<?php echo $product["icone"]?>" alt="image product" class="img-fluid" width="90px"> </td>
                   <td><?php echo $product["libelle"]; ?></td>
                   <td> <?php
                   include '../include/add_pannier_from_form.php'
                   ?>
                   <?php 
                   if(isset($_POST["delete"])){
                    echo "tets;";
                   }
                   ?>
                   <!-- <form method="post">
                   <input type="submit" class="btn btn-danger" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete the product ? ')">
                   </form> -->
                   
                   </td>
                   <?php 
                        if($product["discount"] > 0) {
                            $prix=floatval($product["prix"]);
                            $discount=intval($product["discount"]);
                            $prix_dicount = $prix * (1 - $discount / 100);
                            ?>
                            <td> 
                                <?php
                                echo $prix_dicount ." DH";  
                                ?> 
                            </td>
                        <?php
                        } else {
                            ?>
                            <td>
                                <?php
                                $prix_dicount=floatval($product["prix"]);
                                echo $prix_dicount;
                                ?>
                            </td>
                        <?php
                        }
                        ?>
                        <td>
                            <?php
                            $total_prod=$prix_dicount * $qnt;
                            $total+=$total_prod;
                            echo number_format($total_prod, 2);
                            ?>
                        </td>

                                    <?php
                                }
                        
                                ?>
                       <tfoot>
                            <tr>
                                <td   colspan="5"><strong>Total</strong></td>
                                <td >
                                    <div  style="text-align: center;" class="alert alert-success"><?php echo number_format($total, 2); ?> DH</div>
                                </td>
                            </tr>
                            <tr>
                           
                                <td colspan="6" align="right">
                                    <form method="post" >
                                                                            <!-- formaction="valide_commande.php" echo $id_user ."<br>".$total ;  -->

                                        <input  type="submit" name="valide" class="btn btn-success" value="Validate Order">
                                        <input type="submit" name="empty" class="btn btn-danger" value="Empty Basket" onclick=" return confirm(' Are you sure you want to delete the order? ')">
                                    </form>
                                </td>
                                <?php 
                                    if(isset($_POST["empty"])){
                                        //var_dump($id_user);
                                        //echo "teee";
                                     $_SESSION['pannier'][$id_user]=[];
                                    }

                                if(isset($_POST["valide"])){
                                        $requit='';
                                        try {
                                        $panier=$_SESSION['pannier'][$id_user];
                                        $requit_commande=$connection_opd->prepare('INSERT INTO command(id_client , total) VALUES(?,?)');
                                        $requit_commande->execute([$id_user, $total]);
                                        /* $requit_result=$connection_opd->prepare('SELECT id FROM command WHERE id_client = ? AND total=? limit 1');
                                        $requit_result->execute([$id_user, $total]);
                                        $id_commande= $requit_result->fetchAll(PDO::FETCH_ASSOC); */
                                        $id_commande = $connection_opd->lastInsertId();
                                        var_dump($id_commande)  ;
                                        $requit = $connection_opd->prepare('INSERT INTO line_commande (prix, qantity, totale, id_prod , id_command) VALUES (?, ?, ?, ?,?)');
                                        foreach($panier as $commande => $qnt) {
                                            //echo "Product ID: $commande, Quantity: {$qnt['qnt']}<br>";
                                            $requit_line = $connection_opd->prepare('SELECT * FROM produit WHERE id = ?');

                                            $id_produits_commande = intval($commande);
                                            
                                            $requit_line->execute([$id_produits_commande]);

                                           $requit_line= $requit_line->fetchAll(PDO::FETCH_ASSOC);
                                            //var_dump($requit_line);
                                            try {
                                                    if($product["discount"] > 0) {
                                                        $prix=floatval($product["prix"]);
                                                        $discount=intval($product["discount"]);
                                                        $prix_dicount = $prix * (1 - $discount / 100);
                                                        
                                                    } else {
                                                    
                                                            $prix_dicount=floatval($product["prix"]);
                                                    }
                                                $requit->execute([$prix_dicount, $qnt['qnt'], $prix_dicount * $qnt['qnt'], $id_produits_commande , $id_commande]);
                                            } 
                                            catch (PDOException $e) {
                                                echo "Error: " . $e->getMessage();
                                            }
                                        }
                                        } 
                                            catch (PDOException $e) {
                                                echo "Error: " . $e->getMessage();
                                        }

                                        unset($_SESSION['pannier'][$id_user]);

                                        ?>
                                            
                                            <script>
                                                setTimeout(function(){
                                                    window.location.href = 'valide_commande.php';
                                                },1);
                                            </script>
                                            <?php
                                    }
                                    ?>
                            </tr>
                        </tfoot>
                        

           
     </tbody>

                        
                        
        <?php

                        }
                    
                ?>
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
