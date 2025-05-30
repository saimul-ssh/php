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
	if (isset($_POST["addstudent"])) {
		$name=$_POST['name'];
		$email=$_POST['email'];
		$cell=$_POST['cell'];
		$age=$_POST['age'];
		$location=$_POST['location'];

		// gender fixing
		if(isset($_POST['gender'])){
			$gender=$_POST['gender'];
		}
		


		
		
		if(empty($name) || empty($email) || empty($cell) || empty($age) || empty($location) || empty($gender) || empty($_FILES['photo'])) {
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
		
		$data = fileupload($_FILES['photo'],'students/',['jpg','png','gif','jpeg']);    
        $photo = $data['file_name'];		
		
		$photo = $data['file_name']; // for file name

			if (!empty($data['mess'])){
				$mess = $data['mess'];
			}
			else{
				$sql ="INSERT into students (name, email, cell, age, location, gender, photo, status) values('$name','$email','$cell','$age','$location','$gender','$photo','Active')";
				$mysqli -> query($sql);
				$mess = '<p class="alert alert-success"> Student added successfully ! 
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</p>  ';

			}
		


		}
	


}


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
				<h2>Sign Up</h2>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input class="form-control" type="text" name="name">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input class="form-control" type="text" name="email" >
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input class="form-control" type="text" name="cell" >
					</div>
						<div class="form-group">
						<label for="">Age</label>
						<input class="form-control" type="number" name="age" >
					</div>
					<div class="form-group">
						<label for="">Location</label>
						<select name="location" id="" class="form-control">
							<option value="">-Select-</option>
							<option value="Feni">Feni</option>
							<option value="Dhaka">Dhaka</option>
							<option value="Sylhet">Sylhet</option>
							<option value="Chadpur">Chadpur</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Gender</label><br>
						<input class="" value="male" type="radio" name="gender" id="male"><label for="male" >Male</label>
						<input class="" value="female" type="radio" name="gender" id="female" ><label for="female">Female</label>
					</div>
					<div class="form-group">
						<label for="">Photo</label>
						<input class="form-control" type="file" name="photo">
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit" value="Add student" name="addstudent">
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