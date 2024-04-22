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
        if (!empty($id_pro) && !empty($qnt)) {
            if(!isset($_SESSION["pannier"])){
                $_SESSION["pannier"][$id_user]=[];
            }

            /* $found = false;
            foreach ($_SESSION["pannier"][$id_user] as $productId => &$item) {
                if ($productId == $id_pro) {
                    $item["qnt"] += $qnt;
                    $found = true;
                    break;
                }
            } */
            
            

            
                $_SESSION["pannier"][$id_user][$id_pro] = ["qnt" => $qnt];
            

            var_dump($_SESSION["pannier"]);
           // header("Location: categorie.php?id=" . $_POST['id']); 
         
        } 

        if($qnt==0){
            unset($_SESSION["pannier"][$id_user][$id_pro]);
        }
        //header("Location: produit.php?id=" . $_POST['id']); 
        header("Location:".$_SERVER['HTTP_REFERER']); 

    }
//    session_destroy()
?>
