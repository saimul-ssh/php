<?php include_once "app/db.php"; ?>
<?php include_once "app/functions.php"; ?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>JOIN</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>



	<div class="wrap-table shadow">
		<div class="card">
			<div class="card-body">
				<h2>All JOIN</h2>
				<table class="table table-striped">
					<thead>
						<tr>inner join</tr>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Cell</th>
							<th>Address</th>
							<th>Product</th>
							<th>Price</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php

						$sql = "SELECT * FROM customers INNER JOIN products ON customers.id = products.cid";
						$data = $mysqli->query($sql);
						$i = 1;

						while ($all_users = $data->fetch_assoc()):

							?>
							<tr>
								<td><?php echo $i;
								$i++; ?></td>
								<td><?php echo $all_users['name']; ?></td>
								<td><?php echo $all_users['cell']; ?></td>
								<td><?php echo $all_users['address']; ?></td>
								<td><?php echo $all_users['product_name']; ?></td>
								<td><?php echo $all_users['price']; ?></td>
								<td>
									<a class="btn btn-sm btn-info"
										href="single-student.php?link=<?php echo $all_users['id']; ?>">View</a>
									<a class="btn btn-sm btn-warning"
										href="edit.php?id=<?php echo $all_users['id']; ?>">Edit</a>
									<a id="delete_btn" class="btn btn-sm btn-danger"
										href="delete.php?id=<?php echo $all_users['id']; ?>">Delete</a>
								</td>
							</tr>
							<?php
						endwhile;
						?>
					</tbody>
				</table>
				<table class="table table-striped">
					<thead>
						<tr>left join</tr>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Cell</th>
							<th>Address</th>
							<th>Product</th>
							<th>Price</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php

						$left_join = "SELECT * FROM customers LEFT JOIN products ON customers.id = products.cid";
						$data = $mysqli->query($left_join);
						$i = 1;

						while ($all_users_for_left_join = $data->fetch_assoc()):

							?>
							<tr>
								<td><?php echo $i;
								$i++; ?></td>
								<td><?php echo $all_users_for_left_join['name']; ?></td>
								<td><?php echo $all_users_for_left_join['cell']; ?></td>
								<td><?php echo $all_users_for_left_join['address']; ?></td>
								<td><?php echo $all_users_for_left_join['product_name']; ?></td>
								<td><?php echo $all_users_for_left_join['price']; ?></td>
								<td>
									<a class="btn btn-sm btn-info"
										href="single-student.php?link=<?php echo $all_users_for_left_join['id']; ?>">View</a>
									<a class="btn btn-sm btn-warning"
										href="edit.php?id=<?php echo $all_users_for_left_join['id']; ?>">Edit</a>
									<a id="delete_btn" class="btn btn-sm btn-danger"
										href="delete.php?id=<?php echo $all_users_for_left_join['id']; ?>">Delete</a>
								</td>
							</tr>
							<?php
						endwhile;
						?>
					</tbody>
				</table>
				<table class="table table-striped">
					<thead>
						<tr>right join</tr>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Cell</th>
							<th>Address</th>
							<th>Product</th>
							<th>Price</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php

						$sql = "SELECT * FROM customers RIGHT JOIN products ON customers.id = products.cid";
						$data = $mysqli->query($sql);
						$i = 1;

						while ($all_users = $data->fetch_assoc()):

							?>
							<tr>
								<td><?php echo $i;
								$i++; ?></td>
								<td><?php echo $all_users['name']; ?></td>
								<td><?php echo $all_users['cell']; ?></td>
								<td><?php echo $all_users['address']; ?></td>
								<td><?php echo $all_users['product_name']; ?></td>
								<td><?php echo $all_users['price']; ?></td>
								<td>
									<a class="btn btn-sm btn-info"
										href="single-student.php?link=<?php echo $all_users['id']; ?>">View</a>
									<a class="btn btn-sm btn-warning"
										href="edit.php?id=<?php echo $all_users['id']; ?>">Edit</a>
									<a id="delete_btn" class="btn btn-sm btn-danger"
										href="delete.php?id=<?php echo $all_users['id']; ?>">Delete</a>
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
		$('a#delete_btn').click(function () {
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