<?php
	include 'connectDb.php';
?>
<?php
	$id = $_GET['id'];
	$name = $description = $image = $price = $status = $created = $category = "";
	$errName = $errDescription = $errImage = $errPrice = $errStatus = $errCategory = "";
	$conn = connectDb();
	$sql = "SELECT * FROM products WHERE idProduct = $id";
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
		    	$category = $row["idCategory"];
		    }
		}
		$conn->close();
?>
<?php
function validateImage($image) {
	$target_dir = "image/";
	$target_file = $target_dir . basename($image["name"]);
	$uploadOk = true;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
		$check = getimagesize($image["tmp_name"]);
		if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = true;
        // Check if file already exists
		
		// Check file size
		if ($image["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = false;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = false;
		}
    } else {
        echo "File is not an image.";
        $uploadOk = false;
    }
    return $uploadOk;
}

?>

<?php
	function updateProduct($id, $name, $description, $image, $price, $status, $created, $category) {
		$conn = connectDb();
		$sql = "UPDATE products SET name='$name', description='$description', image='$image', price='$price', status='$status' ,idCategory='$category' WHERE idProduct=$id";
		if ($conn->query($sql) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		    exit();
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
		$image = $_FILES['image'];
		$price = $_POST['price'];
		$category = $_POST['category'];
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
		if ($image['name'] == '' || !validateImage($image)) {
			$errImage = "Please input the image";
			$isSuccess = false;
		}
		if ($price == '' || !is_numeric($price)) {
			$errPrice = "Please input the price";
			$isSuccess = false;
		}
		if ($status == '') {
			$errStatus = "Please input the status";
			$isSuccess = false;
		}
		if ($category == '') {
			$errCategory = "Please input the category";
			$isSuccess = false;
		}
		if ($isSuccess) {
			$target_dir = "image/";
			$imageName = $target_dir . basename(uniqid() . $image["name"]);
			move_uploaded_file($image["tmp_name"], $imageName);
			updateProduct($id, $name, $description, $imageName, $price, $status, $created, $category);
			echo "Success";
			header("Location: displayListProduct.php");
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Product</title>
</head>
<body>
	<h1>Edit Product</h1>
	<form action="#" method='post' enctype="multipart/form-data">
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
		<input type="file" name="image" id="image">
		<p>
			<?php
			echo $errImage;
			?>
		</p>
		<img src="<?php echo $image; ?>" width="90px">
		<p>Category : 
			<select name="category">
				<option value="">Choose category</option>
				<?php
				$conn = connectDb();
				$sql = "SELECT * FROM category";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
				?>
				<option value="<?php echo $row["idCategory"]; ?>" <?php if($category == $row["idCategory"]) echo "selected"; ?>><?php echo $row["name"]; ?></option>

				<?php
					}
				}
				?>
			</select>
		</p>
		<p>
			<?php
			echo $errCategory;
			?>
		<!-- </p> -->
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