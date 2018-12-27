<!DOCTYPE html>
<html>
<head>
	<title>Display Users</title>
	<style>
		table {
			width: 100%;
		}
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
	</style>
</head>
<body>
	<?php
	include 'connectDb.php';
	?>
	<a href="addUser.php">Add User</a>
	<table>
		<tr>
			<th>Id</th>
			<th>Username</th>
			<th>Password</th>
			<th>Full Name</th>
			<th>Address</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php
		$conn = connectDb();
		$sql = "SELECT * FROM users";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	echo '
		    	<tr>
					<td>'.$row["idUser"].'</td>
					<td>'.$row["username"].'</td>
					<td>'.$row["password"].'</td>
					<td>'.$row["fullName"].'</td>
					<td>'.$row["address"].'</td>
					<td><a href="editUser.php?id='.$row["idUser"].'">Edit</a></td>
					<td><a href="deleteUser.php?id='.$row["idUser"].'">Delete</a></td>
				</tr>
		    	';

		    }
		}
		$conn->close();
		?>
	</table>
	
</body>
</html>