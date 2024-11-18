<?php
session_start();
require("config.php");


// print_r($_POST);
if (isset($_SESSION['email']) && $_SESSION['email'] == "root") {


if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'status_') === 0) {
            $request_id = substr($key, strlen('status_'));

            $status = intval($value);

            $stmt = $db->prepare("UPDATE leave_requests SET status = :status WHERE id_request = :request_id");
            $stmt->bindParam(':status', $status, PDO::PARAM_INT);
            $stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
            $_POST["deleteall__"] = "1";
            $stmt->execute();
        }
    }
}

$rqt_show = "SELECT * FROM leave_requests";
$stmt = $db->prepare($rqt_show);
$stmt->execute();
$leave_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Leave Requests</title>
</head>

<body>
    <style>
         body {
            background :#c7cbca;
    }
    </style>
  <nav class="navbar navbar-expand-lg navbar-light " style="background-color: white;box-shadow: -1px 6px 69px -25px rgba(0,0,0,0.75);
">
            <div class="container-fluid d-flex justify-content-between px-5">
            <a class="navbar-brand mx-2" href="status.php"><img src="logo.png" alt="" style="width:50px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                    <a class="nav-link active d-flex align-items-center " style="gap:10px;" aria-current="page" href="main_admin.php"><i class="fa fa-plus-square" style="font-size:24px"></i>
 Ajouter Employee</a>
                        <a class="nav-link active d-flex align-items-center" style="gap:10px;" href="status.php"><i class="fa fa-check-square" style="font-size:24px"></i>
 Requests</a>
                        <a class="nav-link active d-flex align-items-center" style="gap:10px;" href="show_data_user.php"><i class="fa fa-list" style="font-size:24px"></i>
 Liste Employee</a>
                    </div>
                    
                </div>
                <div class="cncn d-flex align-items-center bg-danger text-white px-2 py-1 rounded">                       
                                        <a href="logout.php" class="nav-link logout"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                </svg>
                LOGOUT</a>
                    </div>
            </div>
        </nav>


    <style>
        table {
            width: 100%;
        }

        td,
        th {
            text-align: center;
            height: 30px;
            /* width: 15%; */
        }
    </style>
   <div class="container_all d-flex justify-content-center align-items-center flex-column " style="height:100%; gap:10px; padding:40px 0px;">
   <div class="container_sub__ d-flex flex-column justify-content-center align-items-center rounded py-3" style="width:80%; gap:10px">
       <div class="tops_side__sub text-center rounded mb-3 py-3 bg-white" style="width:80%;box-shadow: -9px 13px 27px -20px rgba(0,0,0,0.75)"> <h3>Le nombre total des demandes est : <span class="text-danger"><?php $sql_count= "select count(*) from leave_requests"; $stmt_count= $db->prepare($sql_count) ;$stmt_count->execute(); $counting = $stmt_count->fetchAll(PDO::FETCH_ASSOC); echo($counting[0]["count(*)"]); ?></span></h3>
        <div class="container_sub__ d-flex align-items-center justify-content-center" >
                <form action="" method="post" >
                    <label for="">Filtrer par : </label>
                    <select style="margin: 10px 20px;" class="rounded"  name="search_approve" id="">
                        <option value="1" <?php if(isset($_POST["search_approve"])){  if($_POST["search_approve"] == 1 ) {echo"selected";}  } ?> >Confirmé</option>
                        <option value="0" <?php if(isset($_POST["search_approve"])){ if($_POST["search_approve"] == 0 ) {echo "selected";}  } ?>  >Refusé</option>
                    </select>
                    <label for="">Affichier Tous :</label>
                    <input type="checkbox" style="margin: 10px 20px;" name="deleteall__">
                    <input class="bg-primary border-0 text-white px-2 py-1 rounded" type="submit" value="Recherche">

                </form>
                <a href="generate_pdf.php?id.pdf=2" style="text-decoration:none; margin-left:10px!important; margin-top:2px!important;"class="imprimer text-white bg-success rounded m-0 py-1 px-2 "><i class="fa fa-print"></i>
 Imprimer</a>
            </div>
         </div>
    <?php 
    
    // $_POST["deleteall__"] = "x";

    
    
    if (isset($_POST["search_approve"]) ) {
        $sql1_count= "select count(*) from leave_requests where status =?"; 
        $stmt1_count= $db->prepare($sql1_count) ;
        $stmt1_count->execute([$_POST["search_approve"]]); 
        $counter = $stmt1_count->fetchAll(PDO::FETCH_ASSOC);

if ($counter[0]["count(*)"] != 0) {


        // unset($_POST["deleteall__"]); $x= 1;
        if (!isset($_POST["deleteall__"])) {
        $rqt_show = "SELECT * FROM leave_requests where status =:stat";
        $stmt3 = $db->prepare($rqt_show);
        $stmt3->execute([":stat"=>$_POST["search_approve"]]);
        $leave_requests_3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

?> 

<div class="counter__employees_" style="gap:10px; width:80%">
    <div class="second_sub__ bg-white px-3 py-4 rounded" style="box-shadow: -31px 31px 41px -38px rgba(0,0,0,1);">
        <h2 class="text-center mb-4">Resultat : </h2>
            <table border="1" class="table table-dark">
                <tr>
                    <th>ID Request</th>
                    <th>Employee Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Number of Days</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($leave_requests_3 as $request) : ?>
                    <tr>
                      <?php  $_SESSION["number_days"] = diffDates($request['start_date'], $request['end_date']) ;?>
                        <td><?php echo $request['id_request']; ?></td>
                        <td><?php echo $request['employee_matricule']; ?></td>
                        <td><?php echo $request['start_date']; ?></td>
                        <td><?php echo $request['end_date']; ?></td>
                        <td><?php echo diffDates($request['start_date'], $request['end_date']) ?></td>
                        <td><?php if($request['status'] == 0) {    
                            echo "<strong style=\"color:red;letter-spacing:0.5px;\"> Non confirmé </strong>";
                        } else {  
                            echo "<strong style=\"color:green;\"> Confirmé </strong>"; 
                        } ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="request_id" value="<?php echo $request['id_request']; ?>">
                                <?php if ($request['status'] == 1) : ?>
                                    <input type="radio" name="status_<?php echo $request['id_request']; ?>" value="1" checked> Yes
                                    <input type="radio" name="status_<?php echo $request['id_request']; ?>" value="0"> No
                                <?php else : ?>
                                    <input type="radio" name="status_<?php echo $request['id_request']; ?>" value="1"> Yes
                                    <input type="radio" name="status_<?php echo $request['id_request']; ?>" value="0" checked> No
                                <?php endif; ?>
                                <div class="container d-flex align-items-center justify-content-center mt-2" style="gap: 10px">
                                    <input type="submit" class=" btn bg-primary text-white" style="margin-left:10px;padding:7px; 10px" name="submit_<?php echo $request['id_request']; ?>" value="Valider">
                                    <a style=" text-decoration:none; padding:8px; 10px" class="rounded bg-danger  text-white" onclick="return confirm('Voulez vous supprimer l\'employé numéro <?php echo $request['id_request']; ?>?')" href="supprimer_request.php?ref=<?php echo $request['id_request']; ?>">Supprimer</a>
                                </div>


                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table></div>
        </div>
        </div>
    </div>

    

    <?php }}else { ?>

   <div class="container_sub__ d-flex flex-column justify-content-center align-items-center rounded bg-white py-3" style="width:80%; gap:10px">
        <h3><span class="text-danger">0</span> RESULTAT TROUVE !</h3>
   </div>
<?php }  }  ?>

 
 


        <?php if (isset($_POST["deleteall__"])or empty($_POST))  { 
              $sql1_count= "select count(*) from leave_requests "; 
              $stmt1_count= $db->prepare($sql1_count) ;
              $stmt1_count->execute(); 
              $counter = $stmt1_count->fetchAll(PDO::FETCH_ASSOC);
      
      if ($counter[0]["count(*)"] != 0) {
             ?>
        <div class="counter__employees_" style="gap:10px; width:80%">
        <div class="second_sub__ bg-white px-3 py-4 rounded" style="box-shadow: -31px 31px 41px -38px rgba(0,0,0,1);">
        <h2 class="text-center mb-4">Resultat : </h2>
            <table border="1" class="table table-dark">
                <tr>
                    <th>ID Request</th>
                    <th>Employee Matricule</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Number of Days</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($leave_requests as $request) : ?>
                    <tr>
                        <td><?php echo $request['id_request']; ?></td>
                        <td><?php echo $request['employee_matricule']; ?></td>
                        <td><?php echo $request['start_date']; ?></td>
                        <td><?php echo $request['end_date']; ?></td>
                        <td><?php echo diffDates($request['start_date'], $request['end_date']) ?></td>
                        <td><?php if($request['status'] == 0) {    
                            echo "<strong style=\"color:red;letter-spacing:0.5px;\"> Non confirmé </strong>";
                        } else {  
                            echo "<strong style=\"color:green;\"> Confirmé </strong>"; 
                        } ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="request_id" value="<?php echo $request['id_request']; ?>">
                                <?php if ($request['status'] == 1) : ?>
                                    <input type="radio" name="status_<?php echo $request['id_request']; ?>" value="1" checked> Yes
                                    <input type="radio" name="status_<?php echo $request['id_request']; ?>" value="0"> No
                                <?php else : ?>
                                    <input type="radio" name="status_<?php echo $request['id_request']; ?>" value="1"> Yes
                                    <input type="radio" name="status_<?php echo $request['id_request']; ?>" value="0" checked> No
                                <?php endif; ?>
                                <div class="container d-flex align-items-center justify-content-center mt-2" style="gap: 10px">
                                    <input type="submit" class=" btn bg-primary text-white" style="margin-left:10px;padding:7px; 10px" name="submit_<?php echo $request['id_request']; ?>" value="Valider">
                                    <a style=" text-decoration:none; padding:8px; 10px" class="rounded bg-danger  text-white" onclick="return confirm('Voulez vous supprimer l\'employé numéro <?php echo $request['id_request']; ?>?')" href="supprimer_request.php?ref=<?php echo $request['id_request']; ?>">Supprimer</a>
                                </div>


                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table></div>
        </div>
    </div> <?php } else {?>
        <div class="container_sub__ d-flex flex-column justify-content-center align-items-center rounded bg-white py-3" style="width:80%; gap:10px">
        <h3><span class="text-danger">0</span> RESULTAT TROUVE !</h3>
   </div>
        
        <?php }} ?>
</body>

</html>

<?php } else { header("Location:login.php");
        exit();} ?>