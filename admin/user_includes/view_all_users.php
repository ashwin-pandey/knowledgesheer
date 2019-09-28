<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 col-sm-4 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">Users</span>
		<h3 class="page-title">View All Users</h3>
	</div>
</div>
<!-- End Page Header -->

<div class="card mb-3">
	<div class="card-header border-bottom p-3">
		<h5 class="card-title float-left">Users</h5>
		<a href="users.php?source=add_user" class="float-right btn btn-sm btn-primary">Add New</a>
	</div>
	<div class="card-body p-3">
	<table class="table table-striped table-bordered" id="view_all_posts">
		<thead>
			<tr>
				<th>#</th>
				<th>Username</th>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Email</th>
				<th>Role</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>

		<?php 

		$query = "SELECT * FROM users";
		$select_users = mysqli_query($connection,$query);  
		while($row = mysqli_fetch_assoc($select_users)) {
		$user_id             = $row['user_id'];
		$username            = $row['username'];
		$user_firstname      = $row['user_firstname'];
		$user_lastname       = $row['user_lastname'];
		$user_email          = $row['user_email'];
		$user_role           = $row['user_role'];


		echo "<tr>";

		echo "<td>$user_id </td>";
		echo "<td>$username</td>";
		echo "<td>$user_firstname</td>";
		echo "<td>$user_lastname</td>";
		echo "<td>$user_email</td>";
		echo "<td>$user_role</td>";
		echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
		echo "<td><a href='users.php?source=view_all_users&delete={$user_id}'>Delete</a></td>";
		echo "</tr>";

		}

		?>
		</tbody>
		<tfoot>
			<tr>
				<th>#</th>
				<th>Username</th>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Email</th>
				<th>Role</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</tfoot>
	</table>
	</div>
</div>

<?php

// if(isset($_GET['change_to_admin'])) {
// 	$the_user_id = escape($_GET['change_to_admin']);
// 	$query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id   ";
// 	$change_to_admin_query = query($query);
// 	redirect("users.php?source=view_all_users");
// }

// if(isset($_GET['change_to_sub'])){
// 	$the_user_id = escape($_GET['change_to_sub']);
// 	$query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id   ";
// 	$change_to_sub_query = query($query);
// 	redirect("users.php?source=view_all_users");
// }

if(isset($_GET['delete'])){
	if(isset($_SESSION['user_role'])) {
		if($_SESSION['user_role'] == 'admin') {
			$the_user_id = escape($_GET['delete']);
			$query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
			$delete_user_query = query($query);
			redirect("<?php echo $baseURL; ?>/admin/users.php?source=view_all_users");
		}
	}
}

?>