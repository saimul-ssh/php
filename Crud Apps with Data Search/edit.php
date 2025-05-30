<?php include_once "app/db.php"; ?>
<?php include_once "app/functions.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
<?php

    if(isset($_GET['id'])){
        $id_url = $_GET['id'];
    }


	if (isset($_POST["update"])) {
		$name=$_POST['name'];
		$email=$_POST['email'];
		$cell=$_POST['cell'];
		$age=$_POST['age'];
		$location=$_POST['location'];

		// gender fixing
		if(isset($_POST['gender'])){
			$gender=$_POST['gender'];
		}
		


		
		
		if(empty($name) || empty($email) || empty($cell) || empty($age) || empty($location) || empty($gender)) {
			$mess = '<p class="alert alert-danger"> All fields are required ! 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</p>  ';
		}
		elseif(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
			$mess = '<p class="alert alert-danger"> Please enter a valid email ! 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</p>  ';
		}
		elseif($age <=20 || $age >= 80){
			$mess = '<p class="alert alert-danger"> Your age is not fit for this course ! 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</p>  ';
		}
		else{
			/// file uploading
			//$data = fileupload($_FILES['photo'], 'students/',['jpg','png','gif','jpeg','webp'],
			/*[
				//'type'=> 'file' // only for file
		]*///);
		
		//$data = fileupload($_FILES['photo'],'students/',['jpg','png','gif','jpeg']);    
        //$photo = $data['file_name'];		
		
		//$photo = $data['file_name']; // for file name

			if (!empty($data['mess'])){
				$mess = $data['mess'];
			}
			else{

				if(isset($_FILES['new_photo']['name'])){
					$data = fileupload($_FILES['new_photo'],'students/',['jpg','png','gif','jpeg']);
					$photoname = $data['file_name'];
					unlink('students/'.$_POST['old_photo']);
				}
				else{
					$photoname = $_POST['old_photo'];
				}

				$sql ="UPDATE students SET
					name = '$name', email = '$email', cell = '$cell', age = '$age', location ='$location', gender='$gender', photo = '$photoname'  Where id='$id_url'";
					$mysqli -> query($sql);
					$mess = '<p class="alert alert-success"> Student Data Updated successfully ! 
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</p>  ';
			
		}
			
		
			

	}
	


}

	// single student data fetch
    $sql = "select * from students where id='$id_url' ";
    $data = $mysqli -> query($sql);

    $single_student = $data -> fetch_assoc();

?>	
	

	<div class="wrap shadow">
		<a href="index.php" class="btn btn-success btn-sm">All Student</a>
		<div class="card">
			<div class="card-body">
				<?php 
                        if (isset($mess)) {
                            echo $mess;
                        }
                ?>
				<h2>Update Student Data</h2>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id_url; ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input class="form-control" type="text" name="name" value="<?php echo $single_student['name']; ?>">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input class="form-control" type="text" name="email" value="<?php echo $single_student['email']; ?>">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input class="form-control" type="text" name="cell" value="<?php echo $single_student['cell']; ?>">
					</div>
						<div class="form-group">
						<label for="">Age</label>
						<input class="form-control" type="number" name="age" value="<?php echo $single_student['age']; ?>">
					</div>
					<div class="form-group">
						<label for="">Location</label>
						<select name="location" id="" class="form-control">
							<option value="">-Select-</option>
							<option value="Feni" <?php if($single_student['location'] == 'Feni' ): echo "selected"; endif; ?>>Feni</option>
							<option value="Dhaka" <?php if($single_student['location'] == 'Dhaka' ): echo "selected"; endif; ?>>Dhaka</option>
							<option value="Sylhet" <?php if($single_student['location'] == 'Sylhet' ): echo "selected"; endif; ?>>Sylhet</option>
							<option value="Chadpur" <?php if($single_student['location'] == 'Chadpur' ): echo "selected"; endif; ?>>Chadpur</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Gender</label><br>
						<input class="" value="male" type="radio" name="gender" id="male" <?php if($single_student['gender'] == 'male'): echo "checked"; endif;?>><label for="male" >Male</label>
						<input class="" value="female" type="radio" name="gender" id="female" <?php if($single_student['gender'] == 'female' ): echo "checked"; endif; ?>><label for="female">Female</label>
					</div>
                    <div class="form-group">
                        <img style="width:150px;" src="students/<?php echo $single_student['photo']; ?>" alt="">
						<input type="hidden" value="<?php echo $single_student['photo']; ?>" name="old_photo">
                    </div>
					<div class="form-group">
						<label for="">Photo</label>
						<input class="form-control" type="file" name="new_photo">
					</div>
                    
					<div class="form-group">
						<input class="btn btn-primary" type="submit" value="Update student" name="update">
					</div>
				</form>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>