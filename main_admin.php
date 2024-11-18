<?php
session_start();
require("config.php");


if (isset($_SESSION['email']) && $_SESSION['email'] == "root") {
    if (isset($_POST["matricule"])) {
        // $rqt_insert = "insert into employees(matricule, login, pass) values (:matricule_user, :mail, :pas ) ";

        // $stmt = $db->prepare($rqt_insert);
        // $flag = $stmt->execute([
        //     ":matricule_user" => $_POST['nomComplet'],
        //     ":mail" => $_POST['email_user_emp'],
        //     ":pas" => $_POST['pass_user_emp']
        // ]);

        $rqt_insert = "INSERT INTO employees (name, prenom, grade, email, tel, adresse, matricule, login, pass) VALUES (:nom, :prenom, :grade, :email, :tel, :adresse, :matricule, :login, :pass)";

        $stmt = $db->prepare($rqt_insert);
        $flag = $stmt->execute([
            ":nom" => $_POST['name'],
            ":prenom" => $_POST['prenom'],
            ":grade" => $_POST['grade'],
            ":email" => $_POST['email'],
            ":tel" => $_POST['tel'],
            ":adresse" => $_POST['adresse'],
            ":matricule" => $_POST['matricule'],
            ":login" => $_POST['login'],    
            ":pass" => password_hash($_POST['pass'], PASSWORD_DEFAULT)
        ]);

        if ($flag == true) {
            header("Location: login.php");
        } else {
            echo "account not created";
        }
    }

?>

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
            h1 {
                text-align: center;
            }

            input {
                margin: 6px 0px;
            }
        </style>

    <div class="all_container_ d-flex justify-content-center align-items-center" style="height:100%; padding:30px 0px;">
        <div class="container bg-white rounded border px-3 py-3" style="width:40%; box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px; ">
            <h3 class="text-center my-2"> Bonjour <span class="text-danger"> <?php echo ucfirst($_SESSION["email"]); ?></span></h3
                >

            <form action="" method="POST">
                <label for="nomComplet">
                    Nom :
                </label>
                <input type="text" name="name" class="form-control" required>
                <label for="prenom">
                    Prenom :
                </label>
                <input type="text" name="prenom" class="form-control" required>
                <label for="grade">
                    Grade
                </label>
                <input type="text" name="grade" class="form-control" required>
                <label for="email">
                    Email
                </label>
                <input type="text" name="email" class="form-control" required>
                <label for="tel">
                Telephone
                </label>
                <input type="tel" name="tel" class="form-control" required>
                <label for="adresse">
                Adresse
                </label>
                <input type="text" name="adresse" class="form-control" required>
                <label for="matricule">
                Matricule
                </label>
                <input type="text" name="matricule" class="form-control" required>
                <label for="login">
                Login
                </label>
                <input type="text" name="login" class="form-control" required>
                <label for="pass">
                Mot de Passe
                </label>
                <input type="password" name="pass" class="form-control" required>




                <div class="btn__center__ d-flex justify-content-center">
                <input type="submit" class="bg-primary rounded border-0 text-white text-center py-2 px-3" value="Ajouter Utilisateur">
                </div>
                
            </form>

        </div>

        
        </div>
    </body>

    </html>
<?php } else {
    header("Location:login.php");
} ?>