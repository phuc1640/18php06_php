<!DOCTYPE html>
<html>
<head>
	<title>Display News</title>
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
	<a href="addNews.php">Add News</a>
	<table>
		<tr>
			<th>Id</th>
			<th>Title</th>
			<th>Description</th>
			<th>Content</th>
			<th>Image</th>
			<th>Created Date</th>
			<th>Changed Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php
			

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			    	echo '
			    	<tr>
						<td>'.$row["idNews"].'</td>
						<td>'.$row["title"].'</td>
						<td>'.$row["description"].'</td>
						<td>'.$row["content"].'</td>
						<td><img src="'.$row["image"].'" width="90px"></td>
						<td>'.$row["createdDate"].'</td>
						<td>'.$row["changedDate"].'</td>
						<td><a href="editNews.php?id='.$row["idNews"].'">Edit</a></td>
						<td><a href="view/deleteNews.php?id='.$row["idNews"].'">Delete</a></td>
					</tr>
			    	';

			    }
			}
		?>
	</table>
	
</body>
</html>