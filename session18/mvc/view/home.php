
<!DOCTYPE html>
<html>
<head>
	<title>Add News</title>
</head>
<body>
	
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