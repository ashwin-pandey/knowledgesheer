<h6>All Users</h6>
<hr>
<div class="view-all-users">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
			<th>Id</th>
			<th>Username</th>
			<th>Firstname</th>
			<th>Lastname</th>
			<th>Email</th>
			<th>Role</th>
			<th>Change</th>
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
		$user_password       = $row['user_password'];
		$user_firstname      = $row['user_firstname'];
		$user_lastname       = $row['user_lastname'];
		$user_email          = $row['user_email'];
		$user_image          = $row['user_image'];
		$user_role           = $row['user_role'];


		echo "<tr>";

		echo "<td>$user_id </td>";
		echo "<td>$username</td>";
		echo "<td>$user_firstname</td>";
		echo "<td>$user_lastname</td>";
		echo "<td>$user_email</td>";
		if ($user_role == 'subscriber') {
			echo "<td>Subscriber</td>";
		} else {
			echo "<td>Admin</td>";
		}
		if ($user_role == 'subscriber') {
			echo "<td><a href='users.php?source=view_all_users&change_to_admin={$user_id}'>Admin</a></td>";
		} else {
			echo "<td><a href='users.php?source=view_all_users&change_to_sub={$user_id}'>Subscriber</a></td>";
		}
		
		echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
		echo "<td><a href='users.php?source=view_all_users&delete={$user_id}'>Delete</a></td>";
		echo "</tr>";

		}

		?>
		</tbody>
	</table>
</div>

<?php

if(isset($_GET['change_to_admin'])) {
	$the_user_id = escape($_GET['change_to_admin']);
	$query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id   ";
	$change_to_admin_query = query($query);
	redirect("users.php?source=view_all_users");
}

if(isset($_GET['change_to_sub'])){
	$the_user_id = escape($_GET['change_to_sub']);
	$query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id   ";
	$change_to_sub_query = query($query);
	redirect("users.php?source=view_all_users");
}

if(isset($_GET['delete'])){
	if(isset($_SESSION['user_role'])) {
		if($_SESSION['user_role'] == 'admin') {
			$the_user_id = escape($_GET['delete']);
			$query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
			$delete_user_query = query($query);
			redirect("users.php?source=view_all_users");
		}
	}
}

?>