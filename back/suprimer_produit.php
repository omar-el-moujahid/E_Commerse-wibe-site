<?php
    include '../include/conectionsql.php';
    $id=$_GET["id"];
    $requit="DELETE FROM produit WHERE id= '$id'";
    $result= mysqli_query($connection , $requit);
    if(!$result){
        echo 'Error: Unable to delete category. Please try again.';
        header('Location: Produits.php');
    }
    else{
        echo 'Category deleted successfully.';
        header('Location: Produits.php');
    }
?>
<!-- <script>
    setTimeout(function() {
        window.location.href = 'Produits.php';
    }, 1500);
</script> -->
<!-- <script>
    setTimeout(function() {
        window.location.href = 'Produits.php';
    }, 1500);
</script> -->