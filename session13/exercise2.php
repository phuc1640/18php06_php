<?php
	function calculateSalary($baseSalary, $coefficient) {
		$salary = 0.0;
		$bonusPercent = 0.0;
		if ($coefficient < 3) {
			$bonusPercent = 0.2;
		} else {
			$bonusPercent = 0.5;	
		}
		$salary = ($baseSalary * $coefficient) + ($baseSalary * $coefficient) * $bonusPercent;
		echo $salary, '<br>';
		if ($salary > 50000000) {
			echo 'Ban gioi day', '<br>';
		} elseif ($salary >= 5000000) {
			echo 'Ban can co gang hon', '<br>';
		} else {
			echo 'Ban bi sa thai ;)', '<br>';
		}
	}
	calculateSalary(600000, 3);
?>