<?php
	include 'connectDb.php';
?>
<?php
	$id = $_GET['id'];
	$title = $description = $image = $content = $createdDate = $changedDate = "";
	$errTitle = $errDescription = $errImage = $errContent = "";
	$conn = connectDb();
	$sql = "SELECT * FROM news WHERE idNews = $id";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$title = $row["title"];
		    	$description = $row["description"];
		    	$image = $row["image"];
		    	$content = $row["content"];
		    	$createdDate = $row["createdDate"];
		    	$changedDate = $row["changedDate"];

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
	function updateNews($id, $title ,$description, $image, $content, $createdDate, $changedDate) {
		$conn = connectDb();
		$sql = "UPDATE news SET title='$title', description='$description', image='$image', content='$content', changedDate='$changedDate'  WHERE idNews=$id";
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
			echo "$imageName";
			move_uploaded_file($image["tmp_name"], $imageName);
			updateNews($id, $title ,$description, $imageName, $content, $createdDate, $changedDate);
			echo "Success";
			header("Location: displayListNews.php");
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
		<p><img src="<?php echo $image; ?>" width="90px"></p>
		<input type="submit" name="save" value="Save">
	</form>

</body>
</html>