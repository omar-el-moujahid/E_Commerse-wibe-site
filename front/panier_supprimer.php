<?php
    session_start();
    /* var_dump($_POST);
    echo "<br>";*/
    $id_pro = $_POST["id"];
    $qnt = $_POST["qantite"];
    if(!isset($_SESSION["Utilisateure"])){
        header("Location: ../back/connexion.php");
    }
    else{
        $id_user=$_SESSION["Utilisateure"]["id"];
        unset($_SESSION["pannier"][$id_user][$id_pro]);
        header("Location:".$_SERVER['HTTP_REFERER']);
    }
//    session_destroy()
?>
