<?php
	$vnd = 2000;
	$candies = 0;
	$wrapper = 0;
	while ($vnd > 0) {
		$vnd -= 200;
		$candies++;
		$wrapper++;
		if ($wrapper == 2) {
			$candies++;
			$wrapper = 1;
		}
	}
	echo $candies;
?>