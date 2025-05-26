<?php include_once "app/db.php"; ?>
<?php include_once "app/functions.php"; ?>
<?php session_start(); ?>

<?php 
    // logout system
    if (isset($_GET['logout']) and $_GET['logout'] == 'success') {
        // session destroy
        session_destroy();

        // cookie destroy
        setcookie("user_login_id", "", time()- (60*60*24*10)) ;
        header("location:index.php");
    }

    // profile page access security
    if(!isset($_SESSION['id']) and !isset($_SESSION['name']) and !isset($_SESSION['email'])){
        header('location:index.php');
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


<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Profile page</div>
                        <div class="card-header">
                            <h2>All Member list <a href="profile.php" class="btn btn-primary float-right">Your Profile</a></h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Cell</th>
                                    <th scope="col">Active Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                
                                    $sql = "SELECT * from users";
                                    $data = $mysqli -> query($sql);
                                    $i=1;


            
                                    while($all_users = $data->fetch_assoc()) :
                                ?>

                                    <tr>
                                    <th scope="row"><?php echo $i; $i++; ?></th>
                                    <td><?php echo $all_users['name']; ?></td>
                                    <td><?php echo $all_users['uname']; ?></td>
                                    <td>@<?php echo $all_users['email']; ?></td>
                                    <td>@<?php echo $all_users['cell']; ?></td>
                                    <td> Working </td>
                                    </tr>
                                
                                <?php 
                                    endwhile;
                                ?>
                                </tbody>
                                </table>
                        </div>
                        <div class="card-footer">
                            <a href="?logout=success">logout</a>
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

