<?php
	include 'connectDb.php';
?>
<?php
	$id = $_GET['id'];
	$username = $password = $fullName = $address = "";
	$errUsername = $errPassword = $errFullName = $errAddress = "";
	$conn = connectDb();
	$sql = "SELECT * FROM users WHERE idUser = $id";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$username = $row["username"];
		    	$password = $row["password"];
		    	$fullName = $row["fullName"];
		    	$address = $row["address"];

		    }
		}
		$conn->close();
?>

<?php
	function updateUser($id, $username ,$password, $fullName, $address) {
		$conn = connectDb();
		$sql = "UPDATE users SET username='$username', password='$password', fullName='$fullName', address='$address' WHERE idUser=$id";
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
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullName = $_POST['fullName'];
		$address = $_POST['address'];		
		if ($username == '') {
			$errUsername = "Please input username";
			$isSuccess = false;
		}
		if ($password == '') {
			$errPassword = "Please input password";
			$isSuccess = false;
		}
		if ($fullName == '') {
			$errFullName = "Please input full name";
			$isSuccess = false;
		}
		if ($address == '') {
			$errAddress = "Please input address";
			$isSuccess = false;
		}
		
		if ($isSuccess) {
			updateUser($id, $username ,$password, $fullName, $address);
			echo "Success";
			header("Location: displayListUser.php");
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
</head>
<body>
	<h1>Edit User</h1>
	<form action="#" method='post' enctype="multipart/form-data">
		<p>Username : <input type="text" name="username" value="<?php echo $username;?>"></p>
		<p>
			<?php
			echo $errUsername;
			?>
		</p>
		<p>Password : <input type="password" name="password" value="<?php echo $password;?>"></p>
		<p>
			<?php
			echo $errPassword;
			?>
		</p>
		<p>Full Name : <input type="text" name="fullName" value="<?php echo $fullName;?>"></p>
		<p>
			<?php
			echo $errFullName;
			?>
		</p>
		<p>Address : <input type="text" name="address" value="<?php echo $address;?>"></p>
		<p>
			<?php
			echo $errAddress;
			?>
		</p>
		<input type="submit" name="save" value="Save">
	</form>

</body>
</html>