<?php ob_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Products</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
</head>
<body>
	<?php
	$tableName = 'products';
	include 'connectDb.php';
	function insertProduct($name ,$description, $image, $price, $status, $created, $category) {
		$message = "";
		global $tableName;
		$conn = connectDb();		 
		$sql = "INSERT INTO products (name, description, image, price, status, created, idCategory)
		VALUES ('$name', '$description', '$image', '$price', '$status', '$created', '$category')";

		if ($conn->query($sql) === TRUE) {
		    $message = "Thanh cong";
		    var_dump($sql);
		} else {
		    $message = "Error: " . $sql . "<br>" . $conn->error;
		    exit();
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
	$errName = $errDescription = $errImage = $errPrice = $errStatus = $errCategory = "";
	$name = $description = $image = $price = $status = $category = "";
	
	$message = "";
	$isSuccess = true;
	if(isset($_POST['save'])) {
		$created = date ("Y-m-d H:i:s");
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
			// move_uploaded_file($image["tmp_name"], $imageName);
			// insertProduct($name, $description, $imageName, $price, $status, $created, $category);
			echo "Success";
			// header("Location: displayListProduct.php");
		}
		
	}


	?>
	<h1>Add Product</h1>
	<form action="#" method='post' enctype="multipart/form-data" onsubmit="return addProductValidate()">
		<p>Name : <input type="text" name="name" value="<?php echo $name;?>"></p>
		<p id="checkName">
			<?php
			echo $errName;
			?>
		</p>
		<p>Price : <input type="text" name="price" value="<?php echo $price;?>"></p>
		<p id="checkPrice">
			<?php
			echo $errPrice;
			?>
		</p>
		<p>Description : <textarea rows="4" cols="50" name="description"><?php echo $description;?></textarea></p>
		<p id="checkDescription">
			<?php
			echo $errDescription;
			?>
		</p>
		<input type="file" name="image" id="image">
		<p id="checkImage">
			<?php
			echo $errImage;
			?>
		</p>
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
		<p id="checkCategory">
			<?php
			echo $errCategory;
			?>
		</p>
		<p>
			<input type="radio" name="status" value="1" <?php if($status=='1') echo "checked"; ?>>Available<br>
			<input type="radio" name="status" value="2" <?php if($status=='2') echo "checked"; ?>>Out of order<br>
		</p>
		<p id="checkStatus">
			<?php
			echo $errStatus;
			?>
		</p>
		<input type="submit" name="save" value="Save">
		<input type="button" name="button" value="Đăng nhập" id="save">
	</form>


	<script type="text/javascript" src="js/addProduct.js"></script>
</body>
</html>