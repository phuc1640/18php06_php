<?php
	$vnd = 200000;
	$candies = 0;
	$wrapper = 0;
	while ($vnd > 0) {
		$vnd -= 200;
		$candies++;
		$wrapper++;
		if ($wrapper == 2) {
			$candies++;
			$wrapper--;
		}
	}
	echo $candies;
?>
<!-- BT4: Cho ban 2000 vnđ đi mua kẹo .Biết :
1 viên kẹo giá 200 vnđ.
cứ 2 vỏ kẹo đổi được 1 viên.
Hỏi với 2000 vnđ, ban sẽ mua đc bao nhiêu viên kẹo ?? -->