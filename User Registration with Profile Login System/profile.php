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
                            <h2>Hi   <?php echo $_SESSION["name"]; ?> <a href="data.php" class="btn btn-primary float-right">All Members</a></h2>
                        </div>
                        <div class="card-body">
                            <img src="" alt="" class="shadow" style="height:200px;width: 200px;border-radius: 50%;margin: 20px  auto; display:block;">
                            <table class="table table-striped">
                                <tr>
                                    <td>Name</td>
                                    <td><?php echo $_SESSION["name"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $_SESSION["email"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $_SESSION["username"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td><?php echo $_SESSION["cell"]; ?></td>
                                </tr>
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