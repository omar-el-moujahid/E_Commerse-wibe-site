
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Liste of Categories </title>
</head>
<body>
    <?php 
    include'include/nav.php';
    ?>
<div class="container">
    <h3 class=" my-3">Liste of Categories </h3>
    <hr class="border border-primary border-3 opacity-75">

    <a href="add_categroies.php">       
         <input type="submit" value="Add Categories" class="btn btn-primary btn-lg my-3" name="add_Categories">
    </a>

<table class="table table-striped my-3 ">
    <thead>
            <tr>
                <th>ID</th>
                <th>Nome de Categorie</th>
                <th>Description</th>
                <th>Date d'ajoute</th>
                <th> Operatio</th>
            </tr>
    </thead>
  <tbody>
    <?php
        include 'include/conectionsql.php';
        $requit='SELECT * FROM categorie';
        $results = mysqli_query($connection, $requit);
        $date_now = strtotime(date('Y-m-d')); 
        
        while ($row = mysqli_fetch_assoc($results)) {
            $date_creation=strtotime($row["date_de_creation"]);
            $diff_days = abs(
                round(($date_now - $date_creation) / (60 * 60 * 24))) ;
           /*  echo "<br>".$date_creation ."<br>";
            echo "<br>".$date_now ."<br>";
            echo "<br>".$diff_days ."<br>"; */
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["libelle"]; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td><?php echo $diff_days . " Days ago"; ?></td>
                <td>
                    <a href="modifier_categories.php?id=<?php echo $row["id"]?>"><input type="submit" class="btn btn-primary" value="Modify"></a>

                    <a href="suprimer_categories.php?id=<?php echo $row["id"]?>" onclick="return confirm('Vouler vous vraiment suprimer la categories <?php  echo $row['libelle'] ;  ?> ')"><input type="submit" class="btn btn-danger" value="DLETE"></a>
                        
                        
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
