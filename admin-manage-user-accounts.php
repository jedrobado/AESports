<!DOCTYPE html>
<?php
	include ('session.php');
	include ('connection.php');
	$user_sql = "SELECT ID FROM accounts WHERE Type = 'User'";
	$user_res = mysqli_query($conn, $user_sql);
	$user_count = mysqli_num_rows($user_res);

	$sql = "SELECT * FROM accounts";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);
?>
<html>
<head>
	<?php include('library/html/header.php'); ?>
</head>
<body>
	<?php include('library/html/navbar2.php'); ?>
	<div class="container">
		<div class="page-header">
			<h2 class="text-center"	><span class="fa fa-users"></span> User Accounts(<?php echo htmlspecialchars($user_count); ?>)</h2>
			<h5>List of Registered Users</h5>
			<hr>
		</div>
		<div class="table-responsive">
			<table class="table table-hover text-dark">
				<thead class="thead-dark">
					<tr>
						<th colspan="1">ID</th>
						<th colspan="1">Name</th>
						<th colspan="1">Gender</th>
						<th colspan="1">Email</th>
						<th colspan="1">Status</th>
						<th colspan="1">Username</th>
						<th colspan="2" class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$disp_user = "SELECT * FROM accounts WHERE Type = 'User' ORDER BY ID DESC";
						$disp_res = mysqli_query($conn, $disp_user);
						$disp_count = mysqli_num_rows($disp_res);

			if ($disp_count > 0) {
				while ($row = mysqli_fetch_assoc($disp_res)) {
					$fullname = htmlspecialchars($row['LastName']).  ", ". htmlspecialchars($row['FirstName']) . " " . htmlspecialchars($row['MiddleName']);
					echo "<tr>
							<td>".htmlspecialchars($row['ID'])."</td>
							<td>".htmlspecialchars($fullname)."</td>
							<td>".htmlspecialchars($row['Gender'])."</td>
							<td>".htmlspecialchars($row['Email'])."</td>
							<td>".htmlspecialchars($row['Status'])."</td>
							<td>".htmlspecialchars($row['Username'])."</td>
							<td><a class='btn btn-primary' href='actions.php?user_act=".$row['ID']."'><span class='fa fa-check' name></span> Enabled</a></td>
							<td><a class='btn btn-danger' href='actions.php?user_deact=".$row['ID']."'><span class='fa fa-close' name></span> Disabled</a></td>
						</tr>";
					}
				} else {
					echo "<tr><td colspan='7'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> Users Not Found</h3></td></tr>";
			}
					?>
				</tbody>
			</table>
		</div>
	</div>
<!--JS Libraries-->
<script type="text/javascript" src="js/mdb.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
</body>
</html>