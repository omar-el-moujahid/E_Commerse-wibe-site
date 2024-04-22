<?php
    include '../include/conectionsql.php';
    $requite_globale = "SELECT * FROM categorie ";
    $requite_globale=$connection_opd->query("SELECT * FROM categorie ");
    $cats=$requite_globale->fetchAll(PDO::FETCH_OBJ);
    var_dump($cats);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.ne
    t/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" >
    
    <title>ttt </title>
</head>
<body>
</body>
</html>