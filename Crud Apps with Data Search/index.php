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

	

	<div class="wrap-table shadow">
		<a href="add-student.php" class="btn btn-success btn-sm">Add Student</a>
		<div class="card">
			<div class="card-body">
				<h2>All Data</h2>

				<form class="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<input type="text" name="search" class="p-1">
					<input type="submit" name="searchbutton" class="btn btn-primary" value="Search">
				</form>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>age</th>
							<th>Location</th>
							<th>Gender</th>
							<th>Photo</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php 

							$search ='';
							if(isset($_POST['searchbutton'])) {
								$search = $_POST['search'];
							}

							$sql = "SELECT * from students where location='$search' or gender='$search' or name like '%$search%'";
                                    $data = $mysqli -> query($sql);
                                    $i=1;

                                    while($all_users = $data->fetch_assoc()) :

						?>
						<tr>
							<td><?php echo $i;$i++; ?></td>
							<td><?php echo $all_users['name']; ?></td>
							<td><?php echo $all_users['email']; ?></td>
							<td><?php echo $all_users['cell']; ?></td>
							<td><?php echo $all_users['age']; ?></td>
							<td><?php echo $all_users['location']; ?></td>
							<td><?php echo $all_users['gender']; ?></td>
							<td><img src="students/<?php echo $all_users['photo']; ?>" alt=""></td>
							<td><?php echo $all_users['status']; ?></td>
							<td>
								<a class="btn btn-sm btn-info" href="single-student.php?link=<?php echo $all_users['id']; ?>">View</a>
								<a class="btn btn-sm btn-warning" href="edit.php?id=<?php echo $all_users['id']; ?>">Edit</a>
								<a id="delete_btn" class="btn btn-sm btn-danger" href="delete.php?id=<?php echo $all_users['id']; ?>">Delete</a>
							</td>
						</tr>
						<?php 
                            endwhile;
                        ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
			$('a#delete_btn').click(function(){
				let con = confirm("Are you sure for delete?");
				if (con === true) {
					return true;
				} else {
					return false;
				}
			});

	</script>
</body>
</html>