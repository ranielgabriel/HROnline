<?php
	session_save_path('tmp');
	session_start();
	header('Content-type: image/jpeg');
	$code = $_SESSION['code'];

	$image = imagecreate(298, 110);
	imagecolorallocate($image, 255, 255, 255);
	$color = imagecolorallocate($image, 0, 0, 0);

	for($ctr = 1; $ctr <= 65; $ctr++){
		$x1 = rand(1, 284);
		$x2 = rand(1, 150);
		$x3 = rand(1, 170);
		$x4 = rand(1, 190);

		imageline($image, $x1, $x2, $x3, $x4, $color);
	}

	imagettftext($image, 85, 0, 5, 80, $color,'font.ttf', $code);
	imagejpeg($image);
?>