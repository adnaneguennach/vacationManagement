<?php

session_start();
require("config.php");

if (isset($_SESSION['email']) && $_SESSION['email'] == "root") {

$zz = 0;
$stm = $db->prepare("SELECT name, prenom, grade, email, tel, adresse, matricule from employees");
$stm->execute();
$taber = $stm->fetchAll(PDO::FETCH_OBJ);
if ($taber) :

    foreach ($taber as $ii) {
        $zz++;
    }

?>
<?php endif; ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <title>Document</title>
    </head>

    <body style="background :#c7cbca;">
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
            th,
            td {
                text-align: center;

            }

            tr {
                height: 50px;
            }
        </style>

<div class="container_all d-flex justify-content-center flex-column" style="height:100%; gap:10px;padding:60px 0px;">
   <div class="counter__employees_ d-flex flex-column justify-content-center align-items-center" style=" gap:10px;">
             <div class="container_sub__ mb-3 bg-white d-flex flex-column justify-content-center align-items-center rounded py-3" style="width:80%; gap:10px;box-shadow: -31px 31px 41px -38px rgba(0,0,0,1)">
    
                <h3> Le nombre total des employees est : <span class="text-danger"><?php echo $zz; ?></span> </h3>

                <div class="container_sub__ d-flex align-items-center">
                    <form action="#" method="post">
                        <label for="">Filtrer par : </label>
                        <select class="rounded mx-3" name="search" id="">
                            <?php foreach ($taber as $bb) : ?>
                                <option value="<?= $bb->matricule; ?>"<?php  if (isset($_POST["search"]) and $bb->matricule == $_POST["search"]) {echo"Selected";} else {echo "";}?> > <?= $bb->matricule; ?> </option>

                            <?php endforeach; ?>
                        </select>
                        <label for="">Affichier Tous :</label>
                        <input type="checkbox" name="deleteall">
                        <input class="rounded mx-3 bg-primary border-0 text-white px-2 py-1"  type="submit" value="submit">
                    </form>
                    <a href="generate_pdf.php?id.pdf=1" style="text-decoration:none"class="imprimer text-white bg-success rounded m-0 py-1 px-2 "><i class="fa fa-print"></i>
 Imprimer</a>
                </div>
                </div>
        </div>


        <?php
        if (isset($_POST["search"])) {

            $stmt = $db->prepare("SELECT name, prenom, grade, email, tel, adresse, matricule from employees where matricule =:matr");
            $stmt->execute([":matr" => $_POST["search"]]);
            $tabb = $stmt->fetchAll(PDO::FETCH_OBJ);
          
        }
        if (isset($tabb) && $tabb) {
            if (!isset($_POST["deleteall"])) {
        ?>  
         <div class="container___ d-flex align-items-center justify-content-center" >
            <div class="width_table_ border rounded px-4 py-2 pb-4 bg-white  " style="width:80%;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                <h3 class="text-center my-3">Resultat : </h3>
            <table border='1' class="table table-dark m-0" cellspacing='0' cellpadding="10px" >
                    <tr>
                        <th>matricule</th>
                        <th>name</th>
                        <th>prenom</th>
                        <th>email</th>
                        <th>tel</th>
                        <th>adresse</th>
                        <th>Action </th>
                    </tr>
                    <?php foreach ($tabb as $x) : ?>
                        <tr>
                            <td><?= $x->matricule; ?></td>
                            <td><?= $x->name; ?></td>
                            <td><?= $x->prenom; ?></td>
                            <td><?= $x->email; ?></td>
                            <td><?= $x->tel; ?></td>
                            <td><?= $x->adresse; ?></td>
                            <td style="padding-top:15px;">
                                <a style="text-decoration:none; " class="rounded bg-danger text-white py-2 px-2" href="modifier_employee.php?ref=<?= $x->matricule; ?>">Modifier</a>
                                <a style="text-decoration:none;" class="rounded bg-primary  text-white py-2 px-2" onclick="return confirm('Voulez vous supprimer l\'employé numéro <?= $x->matricule; ?>?')" href="supprimer_employee.php?ref=<?= $x->matricule; ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table></div></div>
        <?php
            }
        } else {
//echo "Please choose.";
        }
        ?>
        

        

        <?php if(isset($_POST["deleteall"]) or empty($_POST)) { 
            
            $sql1_count= "select count(*) from employees"; 
            $stmt1_count= $db->prepare($sql1_count) ;
            $stmt1_count->execute(); 
            $counter = $stmt1_count->fetchAll(PDO::FETCH_ASSOC);
    
            if ($counter[0]["count(*)"] != 0) {
            
            ?>
            
        <div class="container___ d-flex align-items-center justify-content-center" >
            <div class="width_table_ rounded border px-4 py-2 pb-4 bg-white" style="width:80%;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                <h3 class="text-center my-3">Resultat :</h3>
                <table border='1' class="table table-dark" cellspacing='0' cellpadding="10px" style="width:100%; margin-bottom:0;">
                    <tr>
                        <th>matricule</th>
                        <th>name</th>
                        <th>prenom</th>
                        <th>email</th>
                        <th>tel</th>
                        <th>adresse</th>
                        <th>Action </th>
                    </tr>
                    <?php foreach ($taber as $x) : ?>
                        <?php $zz = $zz + 1; ?>
                        <tr>
                            <td><?= $x->matricule; ?></td>
                            <td><?= $x->name; ?></td>
                            <td><?= $x->prenom; ?></td>
                            <td><?= $x->email; ?></td>
                            <td><?= $x->tel; ?></td>
                            <td><?= $x->adresse; ?></td>
                            <td style="padding-top:15px;">
                                <a style=" text-decoration:none; " class="rounded bg-danger text-white py-2 px-2" href="modifier_employee.php?ref=<?= $x->matricule; ?>">Modifier</a>
                                <a style=" text-decoration:none;" class="rounded bg-primary  text-white py-2 px-2" onclick="return confirm('Voulez vous supprimer l\'employé numéro <?= $x->matricule; ?>?')" href="supprimer_employee.php?ref=<?= $x->matricule; ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            
            </div>
        </div> <?php } else {
             ?> <div class="allcontainer_result d-flex justify-content-center   ">  
            <div class="container_sub__ d-flex justify-content-center align-items-center rounded bg-white py-3" style="width:80%; gap:10px">
        <h3><span class="text-danger">0</span> RESULTAT TROUVE !</h3>
   </div></div>  
            
            <?php }  } ?> </div>
    </body>

    <script>
    window.onload = function() {
        var message = "<?php echo isset($_GET['message']) ? $_GET['message'] : ''; ?>";
        if (message) {
            alert(message);
            window.location.href = window.location.href.split('?')[0]; 
        }
    };
</script>

  <?php } else { header("Location:login.php");
        exit();} ?>  </html>