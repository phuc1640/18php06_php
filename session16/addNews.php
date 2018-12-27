<?php ob_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Add News</title>
</head>
<body>
	<?php
	include 'connectDb.php';
	function insertNews($title ,$description, $image, $content, $createdDate, $changedDate) {
		$message = "";
		$conn = connectDb();		 
		$sql = "INSERT INTO news (title, description, image, content, createdDate, changedDate)
		VALUES ('$title', '$description', '$image', '$content', '$createdDate', '$changedDate')";

		if ($conn->query($sql) === TRUE) {
		    $message = "Thanh cong";
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
	$errTitle = $errDescription = $errImage = $errContent = "";
	$title = $description = $image = $content = "";
	
	$message = "";
	$isSuccess = true;
	if(isset($_POST['save'])) {
		$createdDate = date ("Y-m-d H:i:s");
		$changedDate = date ("Y-m-d H:i:s");
		$title = $_POST['title'];
		$description = $_POST['description'];
		$image = $_FILES['image'];
		$content = $_POST['content'];
		
		if ($title == '') {
			$errTitle = "Please input title";
			$isSuccess = false;
		}
		if ($description == '') {
			$errDescription = "Please input description";
			$isSuccess = false;
		}
		if ($image['name'] == '' || !validateImage($image)) {
			$errImage = "Please input image";
			$isSuccess = false;
		}
		if ($content == '') {
			$errContent = "Please input content";
			$isSuccess = false;
		}
		
		if ($isSuccess) {
			$target_dir = "image/";
			$imageName = $target_dir . basename(uniqid() . $image["name"]);
			move_uploaded_file($image["tmp_name"], $imageName);
			insertNews($title ,$description, $imageName, $content, $createdDate, $changedDate);
			echo "Success";
			header("Location: displayListNews.php");
		}
		
	}


	?>
	<h1>Add News</h1>
	<form action="#" method='post' enctype="multipart/form-data">
		<p>Title : <input type="text" name="title" value="<?php echo $title;?>"></p>
		<p>
			<?php
			echo $errTitle;
			?>
		</p>
		<p>Description : <textarea rows="4" cols="50" name="description"><?php echo $description;?></textarea></p>
		<p>
			<?php
			echo $errDescription;
			?>
		</p>
		<p>Content : <textarea rows="4" cols="50" name="content"><?php echo $content;?></textarea></p>
		<p>
			<?php
			echo $errContent;
			?>
		</p>
		<input type="file" name="image" id="image">
		<p>
			<?php
			echo $errImage;
			?>
		</p>
		<input type="submit" name="save" value="Save">
	</form>

</body>
</html>