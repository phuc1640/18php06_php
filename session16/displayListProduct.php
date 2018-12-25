<!DOCTYPE html>
<html>
<head>
	<title>Display Product</title>
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
	<table>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Price</th>
			<th>Description</th>
			<th>Image</th>
			<th>Date</th>
			<th>Status</th>
			<th>Edit</th>
			<th>Delete</th>
			
		</tr>
		<?php
		$conn = connectDb();
		$sql = "SELECT * FROM $tableName";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	echo '
		    	<tr>
					<td>'.$row["idProduct"].'</td>
					<td>'.$row["name"].'</td>
					<td>'.$row["price"].'</td>
					<td>'.$row["description"].'</td>
					<td>'.$row["image"].'</td>
					<td>'.$row["created"].'</td>
					<td>'.($row["status"]==1?'Con hang':'Het hang').'</td>
					<td><a href="editProduct.php?id='.$row["idProduct"].'">Edit</a></td>
					<td><a href="deleteProduct.php?id='.$row["idProduct"].'">Delete</a></td>
				</tr>
		    	';

		    }
		}
		$conn->close();
		?>
	</table>
	
</body>
</html>