<?php 
require_once "config.php";
if(isset($_GET['ref'])){
    $rqt = "DELETE FROM employees where matricule =?";
    $stm = $db->prepare($rqt);
    $result = $stm->execute([$_GET['ref']]);
    if($result){
        header("Location:show_data_user.php?message=Suppression réussie");
    }
    else{
        echo "Echec de suppression";}
}

?>