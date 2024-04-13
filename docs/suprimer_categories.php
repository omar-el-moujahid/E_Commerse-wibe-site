<?php
    include 'include/conectionsql.php';
    $id=$_GET["id"];
    $requit="DELETE FROM categorie WHERE id= '$id'";
    $result= mysqli_query($connection , $requit);
    if(!$result){
        echo 'Error: Unable to delete category. Please try again.';
        //header('Location: Categories.php');
    }
    else{
        echo 'Category deleted successfully.';
       // header('Location: Categories.php');
    }
?>

<script>
    // Redirect to Categories.php after 3 seconds
    setTimeout(function() {
        window.location.href = 'Categories.php';
    }, 1500);
</script>