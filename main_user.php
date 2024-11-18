<?php
session_start();
require("Config.php");

if (empty($_SESSION) || !isset($_SESSION["matricule"])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST["dateDepart"]) && isset($_POST["dateRetour"])) {
    $date1 = $_POST["dateDepart"];
    $date2 = $_POST["dateRetour"];
    $dateTime1 = new DateTime($date1);
    $dateTime2 = new DateTime($date2);
    if ($dateTime1 >= $dateTime2) {
        echo "Please fix your dates.";
    } else {
        $rqt_demande = "INSERT INTO leave_requests(start_date, end_date, employee_matricule) VALUES (:dprt, :rtr, :mtrcl)";
        $stmt = $db->prepare($rqt_demande);
        $flag = $stmt->execute([
            ":dprt" => $_POST['dateDepart'],
            ":rtr" => $_POST['dateRetour'],
            ":mtrcl" => $_SESSION["matricule"]
        ]);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

$rqt_show_demande = "SELECT * FROM leave_requests WHERE employee_matricule = :ss";
$stmt_two = $db->prepare($rqt_show_demande);
$stmt_two->execute([':ss' => $_SESSION["matricule"]]);
$res = $stmt_two->fetchAll(PDO::FETCH_ASSOC); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

<div class="container__fluid__ d-flex justify-content-center align-items-center " style="width:100%; height:55vh">
    <div class="sub_container__ d-flex flex-column align-items-center bg-white p-3 rounded" style="width:50%; gap:10px;" >
    <h3 class="Result " style="margin-bottom:25px;">Mes Dates : </h3>

    <form action="" method="post" style="text-align:center;">
        <label for="dateDepart">Date de Depart : </label><br>
        <input type="date" name="dateDepart" class="form-control mt-2" id="dateDepart"><br><br>
        <label for="dateRetour">Date de Retour :</label><br>
        <input type="date" name="dateRetour" class="form-control mt-2" id="dateRetour"><br><br>

        <input type="submit" value="Confirmer" class="bg-primary border-0 rounded text-white px-3 py-2"><br>
    </form>
    
   
    </div>
</div>
<?php
if ($res) { 
    ?>

    <div class="container_lol d-flex justify-content-center pb-5 " style="width:100%">
        <div class="sub_container__ rounded bg-white p-4 text-center" style="width:50%">
        <h3 class="Result " style="margin-bottom:25px;">Mes demandes : </h3>
        <table border="1" class="table table-dark m-0 ">
            <tr>
                <th>ID Request</th>
                <th>Matricule</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr> 
            <?php foreach ($res as $request): ?>
                <tr>
                    <td><?php echo $request['id_request']; ?></td>
                    <td><?php echo $request['employee_matricule']; ?></td>
                    <td><?php echo $request['start_date']; ?></td>
                    <td><?php echo $request['end_date']; ?></td>
                    <td><?php  
                        if($request['status'] == 0) {    
                            echo "<strong style=\"color:red;letter-spacing:0.5px;\"> Non confirmé </strong>";
                        } else {  
                            echo "<strong style=\"color:green;\"> Confirmé </strong>"; 
                        } 
                    ?></td>
                </tr>
            <?php endforeach; ?>
        </table> 
        </div>
    </div>
    <?php 
}
?>


</body>
</html>
