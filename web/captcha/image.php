<?php
session_start();
header("Content-type: image/png");

$image = imagecreate(400, 200);



$charAuthorized = "abcdefghijklmnopqrstuvwxyz0123456789";
$lenghtCaptcha = rand(5, 8);
$charAuthorized = str_shuffle($charAuthorized);
$captcha = substr($charAuthorized, 0, $lenghtCaptcha);
$_SESSION["captcha"] = $captcha;

$listOfFonts = glob("../fonts/*.ttf");

$back = imagecolorallocate($image, rand(0,100), rand(0,100), rand(0,100));

$posCharX = rand(10, 20);
for($cpt=0; $cpt<$lenghtCaptcha; $cpt++){

	$posCharY = rand(80, 130);
	$colorAllocate[] = imagecolorallocate($image, rand(150,250), rand(150,250), rand(150,250));

	imagettftext(
		$image,
		rand(35,45),
		rand(-20, 20),
		$posCharX ,
		$posCharY,
		$colorAllocate[$cpt],
		$listOfFonts[rand(0, count($listOfFonts)-1)],
		$captcha[$cpt]);

	$posCharX += rand(40, 50);

}


$geometryNumber = rand(5, 10);

for($cpt=0; $cpt<$geometryNumber; $cpt++){


	switch (rand(0, 2)) {
		case 0:
			imageline($image, rand(0, 400), rand(0, 200), rand(0, 400), rand(0, 200), $colorAllocate[rand(0, $lenghtCaptcha-1)]);
			break;

		case 1:
			imageellipse($image, rand(0, 400), rand(0, 200), rand(0, 400), rand(0, 200), $colorAllocate[rand(0, $lenghtCaptcha-1)]);
			break;

		default:
			imagerectangle($image, rand(0, 400), rand(0, 200), rand(0, 400), rand(0, 200), $colorAllocate[rand(0, $lenghtCaptcha-1)]);
			break;
	}


}



imagepng($image);
