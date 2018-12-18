<?php ob_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Input Form</title>
</head>
<body>
	<?php
	$tableName = 'products';
	function connectDb() {
		$servername = "localhost";
		$username = "root";
		$password = "abc123";
		$dbname = "18php06_php";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
	}
	function insertProduct($name ,$description, $image, $price, $status, $created) {
		$message = "";
		global $tableName;
		$conn = connectDb();		 
		$sql = "INSERT INTO $tableName (name, description, image, price, status, created)
		VALUES ('$name', '$description', '$image', '$price', '$status', '$created')";

		if ($conn->query($sql) === TRUE) {
		    $message = "Thanh cong";
		    // header("Location : displayListProduct.php");
		} else {
		    $message = "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
		return $message;
	}
	
	?>
	<?php
	$errName = $errDescription = $errImage = $errPrice = $errStatus = "";
	$name = $description = $image = $price = $status = "";
	
	$message = "";
	$isSuccess = true;
	if(isset($_POST['save'])) {
		$created = date ("Y-m-d H:i:s");
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
			insertProduct($name, $description, $image, $price, $status, $created);
			echo "Success";

		}
		// header("Location : displayListProduct.php");
	}


	?>
	<h1>Add Product</h1>
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