<?php 
	include 'config/database.php';
	class HomeModel extends ConnectDB {
		function getHomePage() {
			$sql = "SELECT * FROM news";
			$listNews = mysqli_query($this->connect_db(), $sql);
    		return $listNews;
		}

		function insertNews($title ,$description, $image, $content, $createdDate, $changedDate) {
			$message = "";
			$conn = $this->connect_db();		 
			$sql = "INSERT INTO news (title, description, image, content, createdDate, changedDate)
			VALUES ('$title', '$description', '$image', '$content', '$createdDate', '$changedDate')";

			if ($conn->query($sql) === TRUE) {
			    $message = "Thanh cong";
			} else {
			    $message = "Error: " . $sql . "<br>" . $conn->error;
			    exit();
			}
			return $message;
		}

		function updateNews($id, $title ,$description, $image, $content, $createdDate, $changedDate) {
			$conn = $this->connect_db();
			$sql = "UPDATE news SET title='$title', description='$description', image='$image', content='$content', changedDate='$changedDate'  WHERE idNews=$id";
			if ($conn->query($sql) === TRUE) {
			    echo "Record updated successfully";
			} else {
			    echo "Error updating record: " . $conn->error;
			    exit();
			}

		}

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

	}

?>