<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title>Document</title>
</head>

<body>
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


    <?php
    require("config.php");
    if (isset($_POST["submit"])) {
        $stm = $db->prepare("update employees set name=:first, prenom=:second, grade=:third, email=:forth, tel=:fifth, adresse=:sixth, matricule=:seven, login=:eight, pass=:nine WHERE matricule=:ref");
        $flag = $stm->execute([
            ":first" => $_POST['name'],
            ":second" => $_POST['prenom'],
            ":third" => $_POST['grade'],
            ":forth" => $_POST['email'],
            ":fifth" => $_POST['tel'],
            ":sixth" => $_POST['adresse'],
            ":seven" => $_POST['matricule'],
            ":eight" => $_POST['login'],
            ":nine" => password_hash($_POST["pass"], PASSWORD_DEFAULT),
            ":ref" => $_GET['ref'],
        ]);

        if ($flag)
            header("Location:show_data_user.php?message=Modification réussie");
    }
    ?>
    

            <style>
                input {
                    margin: 8px 0px;
                }
                
    body {
        background :#c7cbca;
    }

            </style>
            <div class="container-fluid d-flex justify-content-center"  >
                <div class="sub_container bg-white p-3 my-5 rounded" style="width:50%">
                <?php


                    if (isset($_GET["ref"])) {
                        $stm = $db->prepare("select * from employees where matricule=?");
                        $stm->execute([$_GET["ref"]]);
                        $y = $stm->fetch(PDO::FETCH_OBJ);
                        if ($y) :
                    ?><h3 class="card-header text-center my-2">Modifier l'Employé matricule : <?= $_GET["ref"] ?></h3>
                <form action="" method="POST">
                    <label for="nomComplet">
                        Nom :
                    </label>
                    <input type="text" name="name" class="form-control" value="<?= $y->name ?>">
                    <label for="prenom">
                        Prenom :
                    </label>
                    <input type="text" name="prenom" class="form-control" value="<?= $y->prenom ?>">
                    <label for="grade">
                        Grade
                    </label>
                    <input type="text" name="grade" class="form-control" value="<?= $y->grade ?>">
                    <label for="email">
                        Email
                    </label>
                    <input type="text" name="email" class="form-control" value="<?= $y->email ?>">
                    <label for="tel">
                        Telephone
                    </label>
                    <input type="tel" name="tel" class="form-control" value="<?= $y->tel ?>">
                    <label for="adresse">
                        Adresse
                    </label>
                    <input type="text" name="adresse" class="form-control" value="<?= $y->adresse ?>">
                    <label for="matricule">
                        Matricule
                    </label>
                    <input type="text" name="matricule" class="form-control" value="<?= $y->matricule ?>">
                    <label for="login">
                        Login
                    </label>
                    <input type="text" name="login" class="form-control" value="<?= $y->login ?>">
                    <label for="pass">
                        Mot de Passe
                    </label>
                    <input type="password" name="pass" class="form-control" value="<?= $y->pass ?>">
                    <div class="btn__center__ d-flex justify-content-center">
                        <input type="submit" name="submit" class="bg-primary rounded border-0 text-white text-center py-2 px-3" value="Modifier Utilisateur">
                    </div>

                </form>
                </div>
            </div>
    <?php
        else :
            echo "Ce produit n'existe pas";
        endif;
    } else {
        echo "référence perdue!";
    }
    ?>

</body>

</html>