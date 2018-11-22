<?php
	function calculate($a, $b, $operator) {
		switch ($operator) {
			case '+':
				echo $a + $b;
				break;

			case '-':
				echo $a - $b;
				break;

			case '*':
				echo $a * $b;
				break;

			case '/':
				echo $a / $b;
				break;
			
			default:
				echo "Nhap lai ";
				break;
		}
	}
	calculate(6, 2, '*');
?>