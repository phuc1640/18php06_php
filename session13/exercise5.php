<?php
	$totalMarble = 50;
	$blueMarble = 0;
	$redMarble = 0;
	while (($blueMarble * 0.4 + $redMarble * 0.75) != 27) {
		$blueMarble++;
		$redMarble = $totalMarble - $blueMarble;
	}
	echo $blueMarble, '<br>';
	echo $redMarble, '<br>';
?>
<!-- BT5: Dũng có 50 viên bi gồm 2 loại: bi xanh và bi đỏ. Biết rằng nếu lấy 2/5 số bi xanh cộng với 3/4 số bi đỏ thì được 27 viên bi. Hỏi mỗi loại có bao nhiêu viên bi? -->