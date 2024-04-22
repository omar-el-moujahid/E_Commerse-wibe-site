<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" >
    <title>Commandes </title>
</head>
<body>

    <?php
        include '../include/nav.php';
    ?>
   
    <div class="container">
        <?php
            include '../include/conectionsql.php';
            $requit=$connection_opd->query("SELECT * FROM command ");
            $commands=$requit->fetchAll(PDO::FETCH_OBJ);
        ?>
         <h4 class="my-3">
         Commandes
          </h4>
        <hr class="border border-danger border-2 opacity-50">
        <hr class="border border-primary border-3 opacity-75"> 
        <div class="container">
        <table class="table table-striped my-3 ">
            <thead>
            <tr>
                <th>ID</th>
                <th>Client Name</th>
                <th>Client ID</th>
                <th>Total</th>
                <th>Add in </th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
                <?php

                    $requit=$connection_opd->prepare('SELECT id ,login FROM utilisateur WHERE id=?'); 
                    //$date_now = strtotime(date('Y-m-d')); 
                    
                    foreach ($commands as $command) {
                        $requit->execute([$command->id_client]);
                        $results = $requit->fetch(PDO::FETCH_OBJ);
                        //$date= strtotime($command->date_create);
                        //var_dump($results->login);
                        ?>
                        <tr>
                            <td><?php echo $command->id ; ?></td>
                            <td><?php echo $results->login ; ?></td>
                            <td><?php echo $results->id; ?></td>
                            <td><?php echo $command->total; ?></td>
                            <td> <?php echo $command->date_create?></td>
                            <td>
                                <a href="Deatails_commande.php?id=<?php echo $command->id ?>"><input type="submit" class="btn btn-primary" value="Deatails"></a>                                    
                            </td>
                        </tr>
                        <?php
                    }
                ?>
                    
            </tbody>
        </table>
        <?php
            foreach ($commands as $command) {
            //var_dump($command->id);
            }
        ?>
     </div>

</body>
</html>