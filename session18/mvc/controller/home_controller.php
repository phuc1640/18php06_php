<?php 
	include 'model/home_model.php';

	class HomeController {

		public function handleRequest()
		{
			$action = isset($_GET['requestView'])?$_GET['requestView']:"home";
			echo $action;
			if ($action == 'home') {
				$this->insertNewsView();
			} else if ($action == 'displayListNews'){
				$this->newsView();
			}
		}

		function insertNewsView() {
			// can lay thong tin tin tuc va san pham ra
			$model = new HomeModel();
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
				if ($image['name'] == '' || !$model->validateImage($image)) {
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
					$model->insertNews($title ,$description, $imageName, $content, $createdDate, $changedDate);
					echo "Success";
					// header("Location: displayListNews.php");
				}
				
			}
			include 'view/home.php';
		}

		public function newsView()
		{	
			$model = new HomeModel();
			$conn = $model->connect_db();
			$sql = "SELECT * FROM news";
			$result = $conn->query($sql);
			include 'view/displayListNews.php';
		}
	}

?>
