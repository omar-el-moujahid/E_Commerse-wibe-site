
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Admin</title>
    </head>
    <body>
        <?php 
        include'include/nav.php';
        ?>
    <div class="container">
        <?php
           
            if(!isset( $_SESSION["Utilisateure"])){
                header('Location: index.php');
            }
        ?>
        <h3> Hello <?php echo $_SESSION["Utilisateure"]['login']  ?> </h3>
    </div>
        
        
    </body>
    </html>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);?>