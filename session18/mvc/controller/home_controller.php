<?php 
	include 'model/home_model.php';

	class HomeController {
		var $model;
		public function __construct()
		{
			$this->model = new HomeModel();
		}
		public function handleRequest()
		{
			$action = isset($_GET['requestView'])?$_GET['requestView']:"home";
			switch ($action) {
				case 'home':
					echo "<br>";
					echo "HOME";
					break;
				case 'displayListNews':
					$this->newsView();
					break;
				case 'deleteNews':
					$id = $_GET['id'];
					$this->deleteNews($id);
					break;	
				case 'editNews':
					$id = $_GET['id'];
					$this->editNews($id);
					break;	
				default:
					$this->insertNewsView();
					break;
			}
			
		}

		function insertNewsView() {
			// can lay thong tin tin tuc va san pham ra
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
				if ($image['name'] == '' || !$this->model->validateImage($image)) {
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
					$this->model->insertNews($title ,$description, $imageName, $content, $createdDate, $changedDate);

				}
				
			}
			include 'view/home.php';
		}

		public function newsView()
		{	
			$conn = $this->model->connect_db();
			$sql = "SELECT * FROM news";
			$result = $conn->query($sql);
			include 'view/displayListNews.php';
		}

		public function deleteNews($id)
		{
			$conn = $this->model->connect_db();
			$sql = "DELETE FROM news WHERE idNews=$id";
			if ($conn->query($sql) === TRUE) {

			    $this->newsView();
			} else {
			    echo "Error deleting record: " . $conn->error;
			}
		}

		public function editNews($id)
		{
			$conn = $this->model->connect_db();
			$title = $description = $image = $content = $createdDate = $changedDate = "";
			$errTitle = $errDescription = $errImage = $errContent = "";
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
				if ($image['name'] == '' || !$this->model->validateImage($image)) {
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
					$this->model->updateNews($id, $title ,$description, $imageName, $content, $createdDate, $changedDate);

				}	
			}
			include 'view/editNews.php';
		}
	}

?>
