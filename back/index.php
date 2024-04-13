
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>E-commerce</title>
</head>
<body>
    <?php 
    include'../include/nav.php';
    ?>
<div class="container">
    <h4 class="my-3">  Add User </h4>
    <?php
        if(isset($_POST["ajouter"])) {
            if(empty($_POST["login"]) || empty($_POST["password"])){
                ?>
                <div class="alert alert-danger" role="alert"> Please fill in both login and password fields.</div>

                <?php
                /* echo "<p style='color: red;'></p>"; */
            } 
            else {
                $login = $_POST["login"];
                $password = $_POST["password"];
                
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                include '../include/conectionsql.php';
                $requit="INSERT INTO utilisateur (login ,pasword ) VALUES ('$login', '$hashed_password')";
                if (mysqli_query($connection, $requit)) {
                    ?>
                <div class="alert alert-primary" role="alert">  User added successfully.</div>

                <?php
                } 
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                }

                header( 'Location: connexion.php');

            }
        }

        



    ?>
    <form action="" method="post">
        <label class="form-label">login</label>
        <input type="text"  class="form-control" name="login" >

        <label class="form-label">Password</label>
        <input type="password"  class="form-control" name="password">

        <input type="submit" value="Add user" class="btn btn-primary btn-lg my-3" name="ajouter">
    </form>
</div>
    
    
</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);?>