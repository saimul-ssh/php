<?php include_once "app/db.php"; ?>
<?php include_once "app/functions.php"; ?>

<?php 
    session_start();

    // profile page access security
    if(isset($_SESSION['id']) and isset($_SESSION['name'])and isset($_SESSION['email'])){
        header('location:profile.php');
    }


    // relogin system
    if (isset($_COOKIE['user_login_id'])){
        $user_id=$_COOKIE['user_login_id'] ;

        $sql = "SELECT * from users where id='$user_id'";
        $data = $mysqli -> query($sql);
        $login_information = $data -> fetch_assoc(); // user data fetch.

        // session manage
                $_SESSION["id"] = $login_information["id"];
                $_SESSION["name"] = $login_information["name"];
                $_SESSION["username"] = $login_information["uname"];
                $_SESSION["email"] = $login_information["email"];
                $_SESSION["cell"] = $login_information["cell"];
                $_SESSION["pic"] = $login_information["photo"];
    }



?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">



    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>User management system</title>
</head>
<body>
<?php

    if (isset($_POST["signin"])) {
        $ue=$_POST['ue'];
        $password=$_POST['password'];
    }

    
    if(empty($ue) || empty($password)) {
        $mess = '<p class="alert alert-danger"> All fields are required ! 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </p>  ';
    }
    else{
        $sql = "SELECT * from users where email='$ue' or uname='$ue'";
        $data = $mysqli -> query($sql);
        $login_information = $data -> fetch_assoc(); // user data fetch.
        $count = $data -> num_rows;
        if($count == 1) {
            if(password_verify($password, $login_information["password"])==true) {

                // session manage
                $_SESSION["id"] = $login_information["id"];
                $_SESSION["name"] = $login_information["name"];
                $_SESSION["username"] = $login_information["uname"];
                $_SESSION["email"] = $login_information["email"];
                $_SESSION["cell"] = $login_information["cell"];
                $_SESSION["pic"] = $login_information["photo"];


                // set cookie
                setcookie("user_login_id", $login_information["id"], time()+ (60*60*24*10)) ;

                // redirect to profile page 
                header("location:profile.php");
            }
            else{
                $mess = '<p class="alert alert-danger">You entered a wrong password. 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button> </p>  ';
            }

        }

        else{
            $mess = '<p class="alert alert-danger">Wrong Username or email. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </p>  ';
        }
    }


?>

<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Log in</div>
                        <div class="card-body">
                            <?php 
                                if (isset($mess)) {
                                    echo $mess;
                                }
                                
                            ?>
                            <form name="my-form" onsubmit="return validform()" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">


                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Username / E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="ue">
                                    </div>
                                </div>


                                 <div class="form-group row">
                                    <label for="nid_number" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="nid_number" class="form-control" name="password">
                                    </div>
                                </div>                               

                               

                                    <div class="col-md-6 offset-md-4">
                                        <input type="submit" value="Log in" class="btn btn-primary" name="signin">
                                    </div>
                                </div>
                            </form>
                            <a href="register.php">Create an account</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>