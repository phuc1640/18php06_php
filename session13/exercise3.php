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
<!-- BT3: Ở trung tâm giải trí Euroland có chiếc máy tự động có thể thực hiện 
được hai loại giao dịch sau:
1) Bỏ vào 2 euro sẽ nhận được 3 USD và được tặng thêm 1 viên kẹo.
2) Bỏ vào 5 USD sẽ nhận được 3 euro và được tặng thêm 1 viên kẹo.
Khi Buratino đến nghịch máy đổi tiền, cậu ta chỉ có toàn USD. 
Khi cậu ta rời khỏi đó thì tiền đô bị hao hụt đi, không có thêm tiền euro 
nhưng có được 50 viên kẹo.
Hỏi Buratino đã tốn bao nhiêu USD để có được món quà 50 viên kẹo đó? -->