<?php
  session_start();
  $conecter = false ;

  if(isset( $_SESSION["Utilisateure"])){
                ?>
                  <nav class="navbar navbar-expand-lg bg-body-tertiary">
                  <div class="container-fluid">
                    <a class="navbar-brand" href="#Ecommerce">Ecommerce</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                      <ul class="navbar-nav">
                      <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="index.php">Add user</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" href="add_categroies.php">Add Categories</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="add_produit.php">Add Product</a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link active" href="Categories.php">Categories</a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link active" href="Produits.php">Products</a>
                        </li>

                        <li class="nav-item">
                          <a class="nav-link active" href="Deconexion.php">Deconnexion</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </nav>
                                
                <?php
            }
            else{
              ?>
                 <nav class="navbar navbar-expand-lg bg-body-tertiary">
                  <div class="container-fluid">
                    <a class="navbar-brand" href="#Ecommerce">Ecommerce</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                      <ul class="navbar-nav">
                      <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="index.php">Add user</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="connexion.php">Connexion</a>
                        </li>
                
                      </ul>
                    </div>
                  </div>
                </nav>
                                
                <?php
            }
?>

