<?php
	$candies = 0;
	$dollar = 0;
	$euro = 0;
	while ($candies < 50) {
		$dollar += 5;
		$euro += 3;
		$candies++;
		while ($euro >= 2) {
			$dollar -= 3;
			$euro -= 2;
			$candies++;
		}
	}
	echo $euro, '<br>';
	echo $dollar;
?>