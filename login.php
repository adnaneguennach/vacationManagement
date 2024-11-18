<?php
session_start();

require ("config.php");


if(isset($_POST['email_user'] ) &&  isset($_POST['pass']) ){

    
    $rqt = "SELECT login, pass FROM admin where login = :mail ";
    $stmt = $db->prepare($rqt);
    $stmt->execute([
        ":mail" => $_POST['email_user']
        ]);

    $tab = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($tab and password_verify($_POST["pass"], $tab[0]->pass)) {
        
        $_SESSION['email'] =  $_POST['email_user'];
        $_SESSION ['pass'] = $_POST['pass'];
        header("Location:homeadmin.php?message=Welcome");

    } else {
        $rqt_user = "SELECT login, pass, matricule FROM employees where login = :mm_user ";
        $stmt_user = $db->prepare($rqt_user);
        $stmt_user->execute([
            ":mm_user" => $_POST['email_user'],
            ]);

        $tab_user = $stmt_user->fetchAll(PDO::FETCH_OBJ);
        
        if ($tab_user and password_verify($_POST["pass"], $tab_user[0]->pass)) {

            $_SESSION['matricule'] = $tab_user[0]->matricule;
            $_SESSION['email'] =  $_POST['email_user'];
            $_SESSION ['pass'] = $_POST['pass'];
            header("Location:main_user.php?message=Welcome");}
        
        else {
            
        header("Location:error.php");
        session_destroy();
        }
    }


    print_r( $_SESSION);

    echo "<pre>";
    print_r($tab);
    echo "</pre>"; 
 }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title>Document</title>
</head>
<style>
    .cscs:hover{
        opacity: 70%;
    }
  
</style>
<body >

<div class="container-fluid d-flex justify-content-center align-items-center " style="height:100vh;background :#c7cbca;" >
    <div class="form_container__ border px-3 py-3 rounded bg-white" style="width:380px; height:fit-content;box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px; ">
        <form action="#" method="post" >
            <label  for="">
                Email :
            </label>
            <input type="text" name="email_user" class="form-control my-2" required><br><br>
            <label for="">
                Mot De Passe : 
            </label>
            <input type="password" name="pass" class="form-control my-2" required><br><br>

        <div class="d-flex justify-content-center"> <input class="rounded bg-primary text-white border-0 py-1 cscs" style="width:50%" type="submit" value="SIGNIN"></div> 

        </form>
    </div>


</div>
   
</body>

</html>