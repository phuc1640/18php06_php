<?php 
	// Tao gia tri cookie
	setcookie("name", "18PHP06", time() + 10);
	// Su dung gia tri cookie
	echo $_COOKIE['name'];
	// Xoa gia tri cookie
	// setcookie("name", "18PHP06", time() - 10);
?>