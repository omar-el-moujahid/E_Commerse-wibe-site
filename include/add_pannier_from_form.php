<div >
<?php
    session_start();
    $id_user = $_SESSION["Utilisateure"]["id"];
    $qnt = $_SESSION["pannier"][$id_user][$product['id']]['qnt'] ?? 0; 
?>
    <form method="post"  class="counter d-flex" style="width: 100%;" action="ajoute_pannier.php" >
    <button  class="btn btn-primary mx-2" onclick="plus(<?php echo $product['id'];?>) ;return false">+</button>
    <input class="form-control" type="number" name="qantite" id="<?php echo $product['id'];?>" style="width: 50%;" value=<?php echo $qnt ?> min=0>
    <button   class="btn btn-primary mx-2" onclick="minus(<?php echo $product['id'];?>) ;return false ">-</button>
    <input class="form-control" type="text" name="id" id="<?php echo $product['id'];?>" style="width: 50%;" value=<?php echo $product["id"] ?> hidden>
    
    
    <?php
        if($qnt==0){
            ?>
<!--             <input class="btn btn-success"  type="submit" value=" Add ">
 -->            <button class="btn btn-success"  type="submit" value=" Add " >
                <i class="fa-solid fa-cart-shopping"></i>
            </button>
            <?php
        }
        else{
            ?>
            <!-- <input class="btn btn-warning "  type="submit" value=" Modifie ">
            <input formaction="panier_supprimer.php" class="btn btn-danger" type="submit" name="delete"  value="Delete">
         -->
         <button class="btn btn-warning mx-2" type="submit" name="Modifie" >
                <i class="fas fa-pen"></i>
            </button>
            <button formaction="panier_supprimer.php"  class="btn btn-danger" type="submit" name="delete" >
            <i class="fa-solid fa-trash"></i>
            </button>
            <?php
            
        }
     ?>


    
    </form>
</div>