    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Connexion</title>
    </head>
    <body>
        <?php 
        include'include/nav.php';
        ?>
    <div class="container py-2">
    
    <?php
        if(isset($_POST["Connexion"])){
            if(empty($_POST["login"]) || empty($_POST["password"])){
                ?>
                <div class="alert alert-danger" role="alert"> Please fill in both login and password fields.</div>

                <?php
            } 

            else {
                $login = $_POST["login"];
                $password = $_POST["password"];
                

                require_once 'include/conectionsql.php';
                $query = "SELECT * FROM utilisateur WHERE login = ? LIMIT 1";
                
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "s", $login);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){
                    if(password_verify($password ,$row["pasword"] )){
                       
                        ?>
                        
                        <div class="alert alert-primary" role="alert">  Login successful !</div>
                        
                        <?php

                        
                        var_dump( $row );
                        $_SESSION["Utilisateure" ] =$row;
                        header('Location: admin.php');
                    }
                    else{

                        ?>
                        
                        <div class="alert alert-danger" role="alert">  Incorrect password.</div>
                        
                        <?php 
                        
                    }
                }

                else{
                    ?>
                        
                    <div class="alert alert-danger" role="alert">  User not found.</div>

                    <a style="text-decoration: none; color:black" href="index.php"><p>Create an account</p></a>

                    <?php 
                }

            }
        }
    ?>

    <h4 class="my-3">Connexion</h4>

        <form action="" method="post">
            <label class="form-label">login</label>
            <input type="text"  class="form-control" name="login" >

            <label class="form-label">Password</label>
            <input type="password"  class="form-control" name="password">

            <input type="submit" value="Connexion" class="btn btn-primary btn-lg my-3" name="Connexion">
        </form>
    </div>
        
        
    </body>
 </html>
