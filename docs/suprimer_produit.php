<?php
    include 'include/conectionsql.php';
    $id=$_GET["id"];
    $requit="DELETE FROM categorie WHERE id= '$produit'";
    $result= mysqli_query($connection , $requit);
    if(!$result){
        echo 'Error: Unable to delete product. Please try again.';
        //header('Location: Categories.php');
    }
    else{
        echo 'product deleted successfully.';
       // header('Location: Categories.php');
    }
?>

<script>
    // Redirect to Categories.php after 3 seconds
    setTimeout(function() {
        window.location.href = 'Produits.php';
    }, 1500);
</script>