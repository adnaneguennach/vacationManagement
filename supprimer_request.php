<?php 
require_once "config.php";
if(isset($_GET['ref'])){
    $rqt = "DELETE FROM leave_requests where id_request =?";
    $stm = $db->prepare($rqt);
    $result = $stm->execute([$_GET['ref']]);
    if($result){
        header("Location:status.php?message=Suppression réussie");
    }
    else{
        echo "Echec de suppression";}
}

?>