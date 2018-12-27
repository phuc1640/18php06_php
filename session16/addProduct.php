<?php ob_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Products</title>
</head>
<body>
	<?php
	$tableName = 'products';
	include 'connectDb.php';
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
	$errName = $errDescription = $errImage = $errPrice = $errStatus = "";
	$name = $description = $image = $price = $status = "";
	
	$message = "";
	$isSuccess = true;
	if(isset($_POST['save'])) {
		$created = date ("Y-m-d H:i:s");
		$name = $_POST['name'];
		$description = $_POST['description'];
		$image = $_FILES['image'];
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
		
		if ($isSuccess) {
			$target_dir = "image/";
			$imageName = $target_dir . basename(uniqid() . $image["name"]);
			move_uploaded_file($image["tmp_name"], $imageName);
			insertProduct($name, $description, $imageName, $price, $status, $created);
			echo "Success";
			header("Location: displayListProduct.php");
		}
		
	}


	?>
	<h1>Add Product</h1>
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