<?php
	include 'connectDb.php';
?>
<?php
	$id = $_GET['id'];
	$conn = connectDb();
	$sql = "DELETE FROM products WHERE idProduct=$id";
	if ($conn->query($sql) === TRUE) {
	    echo "Record deleted successfully";
	} else {
	    echo "Error deleting record: " . $conn->error;
	}

	$conn->close();
	header("Location: displayListProduct.php");
?>