<?php
	include 'connectDb.php';
?>
<?php
	$id = $_GET['id'];
	$name = $description = $image = $price = $status = $created = "";
	$errName = $errDescription = $errImage = $errPrice = $errStatus = "";
	$conn = connectDb();
	$sql = "SELECT * FROM $tableName WHERE idProduct = $id";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$name = $row["name"];
		    	$description = $row["description"];
		    	$image = $row["image"];
		    	$price = $row["price"];
		    	$status = $row["status"];
		    	$created = $row["created"];

		    }
		}
		$conn->close();
?>
<?php
	function updateProduct($id, $name, $description, $image, $price, $status, $created) {
		$conn = connectDb();
		$sql = "UPDATE products SET name='$name', description='$description', image='$image', price='$price', status='$status'  WHERE idProduct=$id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}

		$conn->close();
	}
?>
<?php
	$message = "";
	$isSuccess = true;
	if(isset($_POST['save'])) {
		$name = $_POST['name'];
		$description = $_POST['description'];
		$image = $_POST['image'];
		$price = $_POST['price'];
		if (!empty($_POST['status'])) {
			$status = $_POST['status'];
		}
		if ($name == '') {
			$errName = "Please input name";
			$isSuccess = false;
		}
		if ($description == '') {
			$errDescription = "Please input description";
			$isSuccess = false;
		}
		if ($image == '') {
			$errImage = "Please input the image";
			$isSuccess = false;
		}
		if ($price == '') {
			$errPrice = "Please input the price";
			$isSuccess = false;
		}
		if ($status == '') {
			$errStatus = "Please input the status";
			$isSuccess = false;
		}
		if ($isSuccess) {
			updateProduct($id, $name, $description, $image, $price, $status, $created);
			echo "Success";

		}
		// header("Location : displayListProduct.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Product</title>
</head>
<body>
	<h1>Edit Product</h1>
	<form action="#" method='post'>
		<p>Name : <input type="text" name="name" value="<?php echo $name;?>"></p>
		<p>
			<?php
			echo $errName;
			?>
		</p>
		<p>Price : <input type="text" name="price" value="<?php echo $price;?>"></p>
		<p>
			<?php
			echo $errPrice;
			?>
		</p>
		<!-- <p>Description : <input type="text" name="description" value="<?php echo $description;?>"></p> -->
		<p>Description : <textarea rows="4" cols="50" name="description"><?php echo $description;?></textarea></p>
		<p>
			<?php
			echo $errDescription;
			?>
		</p>
		<p>Image : <input type="text" name="image" value="<?php echo $image;?>"></p>
		<p>
			<?php
			echo $errImage;
			?>
		</p>
		<p>
			<input type="radio" name="status" value="1" <?php if($status=='1') echo "checked"; ?>>Available<br>
			<input type="radio" name="status" value="2" <?php if($status=='2') echo "checked"; ?>>Out of order<br>
		</p>
		<p>
			<?php
			echo $errStatus;
			?>
		</p>
		<input type="submit" name="save" value="Save">
	</form>

</body>
</html>