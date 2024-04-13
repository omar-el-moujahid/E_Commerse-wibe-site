
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" >
    <title>Liste of Produits </title>
</head>
<body>
    <?php 
    include'../include/nav.php';
    ?>
<div class="container">
   
    <h3 class=" my-3">Liste of Products</h3>
    <hr class="border border-danger border-3 opacity-75">

    <a href="add_produit.php">       
         <input type="submit" value="Add Product" class="btn btn-primary btn-lg my-3" name="add_Categories">
    </a>
   <table class="table table-dark table-striped my-3 ">
       <thead>
               <tr>
                   <th>ID</th>
                   <th>Product</th>
                   <th>Prix</th>
                   <th>Discount</th>
                   <th>categorie</th>
                   <th>Date added</th>
                   <th>Description</th>
                   <th>Image</th>
                   
                   <th> Operation</th>

               </tr>
       </thead>
     <tbody>
       <?php
           include '../include/conectionsql.php';
           $requit='SELECT * FROM produit';
           $results = mysqli_query($connection, $requit);
           while ($row = mysqli_fetch_assoc($results)) {
            $id_categorie = $row["id_categorie"];
            $requit_id = "SELECT libelle FROM categorie WHERE id='$id_categorie' LIMIT 1";
            $result_id= mysqli_query($connection,$requit_id);
            $row_id = mysqli_fetch_assoc($result_id);
            $date_now = strtotime(date('Y-m-d')); // Current date in Unix timestamp format
                $date_creation = strtotime($row["date_de_creation"]); // Convert date_de_creation to Unix timestamp

                // Calculate the difference in days
                $diff_days = abs(round(($date_now - $date_creation) / (60 * 60 * 24)));

                ?>
               <tr>
                   <td><?php echo $row["id"]; ?></td>
                   <td><?php echo $row["libelle"]; ?></td>
                   <?php 
                    if($row["discount"]> 0){
                        $prix_dicount = $row["prix"]  - ($row["prix"]/ $row["discount"]);
                        $prix_dicount= number_format($prix_dicount , 2)
                        ?>
                        <td> <span style="text-decoration:line-through;">
                        <?php
                             echo $row["prix"] ." DH" .  "<br>"  ?> 
                        </span>  <?php
                             echo  $prix_dicount ." DH" ;  ?> 
                        </td>
                        <?php
                    }
                    else{
                        ?>
                        <td><?php echo $row["prix"]; ?></td>
                        <?php
                    }
                   ?>
                   </td>
                   <td><?php echo $row["discount"] ." %"; ?></td>
                   <td><?php echo $row_id["libelle"]; ?></td>
                   <td><?php echo $diff_days." days ago"; ?></td>
                   <td> 
                   <div style="width:200px;"><?php echo $row["disription"]?></div>
                    </td>

                    <td> <img src="../upload/pro/<?php echo $row["icone"]?>" alt="image product" class="img-fluid" width="90px"> </td>
                   <td>
                    <a href="modifier_produit.php?id=<?php echo $row["id"]?>"><input type="submit" class="btn btn-primary" value="Modify"></a>

                    <a href="suprimer_produit.php?id=<?php echo $row["id"]?>" onclick="return confirm('Vouler vous vraiment suprimer la categories <?php  echo $row['libelle'] ;  ?> ')"><input type="submit" class="btn btn-danger" value="DLETE"></a>
                        
                        
                 </td>
               </tr>
               <?php
           }
   
           ?>
           
     </tbody>
   </table>
       
   </div>
       
    
</body>
</html>
