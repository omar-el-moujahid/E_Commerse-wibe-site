
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" >
    <title>Liste Categories  </title>
</head>
<body>
<div class="container py-2">
    <h4 class="my-3"><i class="fa-solid fa-list"></i> 
    Liste Categories
        
          </h4>
<?php
    // Array of CSS classes for different colors
    $colors = [
        'list-group-item-primary',
        'list-group-item-secondary',
        'list-group-item-success',
        'list-group-item-danger',
        'list-group-item-warning',
        'list-group-item-info',
        'list-group-item-light',
        'list-group-item-dark'
    ];

    require_once '../include/conectionsql.php';
    $requit = "SELECT * FROM categorie";
    $result = mysqli_query($connection, $requit);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetch associative array
    ?>
    <ul class="list-group">
        <?php foreach ($categories as $key => $categorie) { ?>
            <li class="list-group-item <?php echo $colors[$key % count($colors)]; ?>  "  >
            <a  class="btn btn-transparent "href="categorie.php?id=<?php
                echo $categorie["id"]
                ?>">
                <i class="<?php
                    echo$categorie['icone']
                ?>"></i>
                   <?php echo $categorie['libelle']; ?>
            </a>
            </li>

        <?php } ?>
    </ul>

</div>
</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);?>