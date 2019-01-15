<a href="index.php">Home</a>|
<a href="index.php?requestView=displayListNews">News list</a>|
<a href="index.php?requestView=insertNews">Add News</a>
<?php 
	include 'controller/home_controller.php';
	$controller = new HomeController();
	$controller->handleRequest();
?>