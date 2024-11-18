<?php 
session_start();
require("config.php");

if (isset($_SESSION['email']) && $_SESSION['email'] == "root") { ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Document</title>
</head>

<body>
    <style>
        .box {
            background: rgb(124, 97, 97);
            width: 100px;
            height: 100px;
            border-radius: 20px;
            margin-top: 10px;
            box-shadow: -25px 29px 26px -40px rgba(255,255,255,1);
        }

        .linkk {
            text-decoration: none;
            margin-bottom: 10px;
            box-shadow: -31px 27px 31px -35px rgba(0, 0, 0, 0.37);
            width: fit-content;

        }

        .container_one__ {
            width: 210px;
            height: 210px;
            border-radius: 20px;
            margin-top: 10px;
            background: rgb(216, 150, 150);
            box-shadow: -25px 29px 26px -40px rgba(255,255,255,1);


        }

        .sub_container__ {
gap:20px;        }

        .fdfds {
             background: rgb(201, 60, 28);
            width: 330px;
            height: 250px;
        }

        .body_container__ {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
background: #212121
;
        }

       

        .cdqscs{
            display: flex;
            flex-direction: column;
        }

        .xx{
            background: rgb(201, 60, 28);
            width: 330px;
            height: 250px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: -25px 29px 26px -40px rgba(255,255,255,1);

        }

            /* .talkcontainer__{
                width: 500px;
                height: 500px;
            } */

        .xhand{
            font-size: 80px;
        }

        .hhhhre{
            display: flex;
            /* justify-content: space-around; */
           
        }

        .topcontainer__wlcm{
            width: 55%;
            margin-right: 20px;
            margin-top: 10px;
            height: 480px;
            background-color: rgb(76, 76, 86);
            border-radius: 15px;
            display: flex;
            justify-content: flex-start;
            padding: 40px 0px;
            flex-direction: column;
            align-items: center;
            color: white;
            box-shadow :-25px 29px 26px -40px rgba(255,255,255,1);

        }

        .welcoming_message{
            font-size: 30px;
            /* margin-bottom: 200px; */
            margin-top: 40px;
        }

    </style>

    <!-- <nav class="navbar navbar-expand-lg navbar-light " style="
        background-color: white;
        box-shadow: -1px 6px 69px -25px rgba(0,0,0,0.75);

">


        <div class="container-fluid d-flex justify-content-between px-5">
            <a class="navbar-brand mx-2" href="status.php"><img src="logo.png" alt="" style="width: 50px" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
                <a href="logout.php" class="nav-link logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                        <path
                            d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                    </svg>
                    LOGOUT</a>
            </div>
        </div>
    </nav> -->



    <div class="body_container__">
        <div class="container-fluid hhhhre " style="gap: 10px; width: 60%;">

            <div class="topcontainer__wlcm">
                <span class="xhand">&#128075;</span>
                <p class="welcoming_message text-center">
                    <strong>Bonjour dans Votre Session,</strong> <br>
                    Mr. <?= (ucfirst($_SESSION["email"]) == 'Root') ? 'Admin' : ''; ?>
                </p>
            </div>

            <div class="talkcontainer__">

                <div class="sub_container__ d-flex ml-2 mr-5  justify-content-end">
                    <div class="container___two">
                    
                            <div class="box d-flex justify-content-center align-items-center">
                                <a href="main_admin.php" class="linkk">   <span class="text-white" style="font-size: 50px"> + </span> </a>
        
                            </div>
                    
                    
                            <div class="box d-flex justify-content-center align-items-center">
        
                                <a href="show_data_user.php" class="linkk m-0">  <i class="fa fa-list" style="font-size: 30px; color: white"></i> </a>
        
                            </div>
                    
                    </div>
        
                        <div class="container_one__ d-flex justify-content-center align-items-center">
                        
                            <a href="status.php" class="linkk m-0">   <i class="fa fa-check-square-o" style="font-size: 50px; color: white"></i></a>
        
                        </div>
                    
                </div>
                

                
                <div class="xxxxx   mt-3 d-flex justify-content-end ml-2  mr-5 align-items-center">
                        <div class="xx">
                        <a href="logout.php" class="linkk m-0">  <i class="fa fa-sign-out" style="font-size: 50px; color: white"></i>  </a>
                        </div>
                </div>            
                
            </div>

          
        </div>
    </div>
    </div>
</body>

</html>
<?php } else { header("location:login.php");}?>