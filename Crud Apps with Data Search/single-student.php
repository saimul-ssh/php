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
    
    if(isset($_GET['link'])){
        $id = $_GET['link'];
    }

    $sql = "SELECT * from students where id='$id' ";
    $data = $mysqli -> query($sql);


    $single_student = $data -> fetch_assoc();
    
    
    ?>
	

	<div class="wrap-table shadow">
        <a href="index.php" class="btn btn-success btn-sm">All Student</a>
		<div class="card">
			<div class="card-body">
				<h2>All Data</h2>
                <img src="students/<?php echo $single_student['photo']; ?>" alt="" style="width:150px;margin: 20px auto; display: Block;">
				<table class="table table-striped">
                    <tr>
                        <td>Name</td>
                        <td><?php echo $single_student['name']; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $single_student['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Cell</td>
                        <td><?php echo $single_student['cell']; ?></td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td><?php echo $single_student['age']; ?></td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td><?php echo $single_student['location']; ?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?php echo $single_student['gender']; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php echo $single_student['status']; ?></td>
                    </tr>
				</table>
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