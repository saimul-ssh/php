<?php include_once "app/db.php"; ?>
<?php include_once "app/functions.php"; ?>

<?php //echo dirname(__FILE__)."/app/db.php"; ?>

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
if (isset($_POST["register"])) {
    // get form value
    $name=$_POST['full_name'];
    $uname=$_POST['username'];
    $email=$_POST['email_address'];
    $cell=$_POST['number'];

    //password validation
    $pass=$_POST['password'];
    $cpass=$_POST['confirm_password'];

    if($pass == $cpass){
        $confirm_pass=true;
    }
    else if($pass == $cpass){
        $confirm_pass= false;
    }

    // hash password
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    // user name check
    $uname_check = datacheck($mysqli, 'uname',$uname, 'users');
    $emmai_check = datacheck($mysqli, 'email',$email,'users');


    $pic=$_FILES['profile_pic'];


    if(empty($name) || empty($email) || empty($cell) || empty($pass) || empty($cpass)) {
        $mess = '<p class="alert alert-danger"> All fields are required ! 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </p>  ';
    }
    //for email validation
    elseif(filter_var($email , FILTER_VALIDATE_EMAIL) == FALSE) {
        $mess = '<p class="alert alert-danger"> Enter a valid email ! 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </p>  ';
    }
    elseif($confirm_pass == FALSE) {
        $mess = '<p class="alert alert-danger"> Password do not match! 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </p>  ';
    }
    elseif($uname_check == false) {
        $mess = '<p class="alert alert-danger"> User name already exists!!! 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </p>  ';
    }
    elseif($emmai_check == false) {
        $mess = '<p class="alert alert-danger"> Email already exists!!! 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </p>  ';
    }
    else {
        $data = fileupload($_FILES['profile_pic'],'students/',['jpg','png','gif','jpeg']);    

        $file_name = $data['file_name'];

        if(!empty($data['mess'])){
            $mess = $data['mess'];
        }
        else{
            $sql ="INSERT into users (name, uname, email, cell, password, photo) values('$name','$uname','$email','$cell','$hash','$file_name')";
            $mysqli -> query($sql);

            setMsg("Registration successfully");

            header("location:register.php");

        }
    }
}

?>

<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                             <?php 
                                if (isset($mess)) {
                                    echo $mess;
                                }
                                getMsg();
                            ?>
                            <form name="my-form" onsubmit="return validform()" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="full_name" class="form-control" name="full_name" value="<?php old('full_name'); ?>" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="user_name" class="form-control" name="username" value="<?php old('username'); ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email_address" value="<?php old('email_address'); ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                                    <div class="col-md-6">
                                        <input type="text" id="phone_number" class="form-control" name="number" value="<?php old('number'); ?>">
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label for="nid_number" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="nid_number" class="form-control" name="password">
                                    </div>
                                </div>                               


                                <div class="form-group row">
                                    <label for="nid_number" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="nid_number" class="form-control" name="confirm_password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nid_number" class="col-md-4 col-form-label text-md-right">Upload Picture</label>
                                    <div class="col-md-6">
                                        <input type="file" id="nid_number" class="form-control" name="profile_pic">
                                    </div>
                                </div>                                

                                    <div class="col-md-6 offset-md-4">
                                        <input name="register" type="submit" value="Sign Up" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                            <a href="index.php">Already have an account</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $(document).on('click', '.alert .close', function() {
        $(this).closest('.alert').fadeOut('slow');
    });
});
</script>

</body>
</html>




