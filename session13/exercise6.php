<?php
	$totalMarble = 120;
	$redMarble = $totalMarble * 0.2;
	$blueMarble = $totalMarble * 0.3;
	$yellowMarble = 1;
	$whiteMarble = 1;
	while (($whiteMarble / $yellowMarble) != 3/7) {
		$yellowMarble++;
		$whiteMarble = $totalMarble - $redMarble - $blueMarble - $yellowMarble;
	}
	echo $redMarble, '<br>';
	echo $blueMarble, '<br>';
	echo $yellowMarble, '<br>';
	echo $whiteMarble, '<br>';
?>
<!-- BT6:Một hộp có 120 viên bi gồm bốn màu : đỏ , xanh , vàng, trắng. Số bi màu đỏ chiếm 1/5 tổng số bi , số bi màu xanh chiếm 30% tổng số bi , còn lại là bi màu vàng và trắng .
A) Tính số bi màu đỏ ; số bi màu xanh 
b) Tính số bi màu vàng ; số bi màu trắng biết tỉ số giữa số bi trắng và số bi màu vàng là 3/7 -->