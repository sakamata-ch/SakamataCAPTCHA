<?php
# Source from: https://neoinspire.net/archives/115
# And modified by mkaraki
require_once __DIR__ . '/req/textgen.php';
header("Content-type: image/webp");
header("Access-Control-Allow-Origin: *");

$width = 500;
$height = 200;
$fontSize = 80;
$distortion = true;

srand(0);

//フォントのパス設定
putenv('GDFONTPATH=' . realpath('.'));
$font = 'sakamata-font-0-nostrict.ttf';

//元画像を使わないから1から作成
$img = imagecreatetruecolor($width, $height);

//captchaで使う色を設定
$black = imagecolorallocate($img, 22, 22, 22);
$darkGray = imagecolorallocate($img, 55, 55, 55);
$gray = imagecolorallocate($img, 200, 200, 200);
$white = imagecolorallocate($img, 255, 255, 255);

//画像を背景色でfill
imagefill($img, 0, 0, $white);

//センタリング処理用
$wd = (imagesx($img) - $fontSize * 0.35 * strlen($string)) / 2;
$ht = $height / 2 + $fontSize * 0.35;


//各文字を表示
for ($i = 0; $i < mb_strlen($string); $i++) {
    $putString = mb_substr($string, $i, 1, 'UTF-8');
    imagettftext($img, $fontSize + rand(-5, 5), rand(-5, 5), $wd + $fontSize * $i, $ht + rand(-10, 10), $darkGray, $font, $putString);
}

//ディストーション処理
if ($distortion) {
    imagesetthickness($img, 1);

    //ラインディストーション
    $i = 0;
    while ($i < 30) {
        $randWidth1 = rand(0, $width);
        $randHeight1 = rand(0, $height);
        $randWidth2 = rand(0, $width);
        $randHeight2 = rand(0, $height);
        imageline($img, $randWidth1, $randHeight1, $randWidth2, $randHeight2, $gray);
        $i++;
    }

    //ドットディストーション
    $i = 0;
    while ($i < 1500) {
        $randWidth = rand(0, $width);
        $randHeight = rand(0, $height);
        imagesetpixel($img, $randWidth, $randHeight, $black);
        $i++;
    }

    # Disable this process because this make too hard to read
    # //ガウス処理
    # $gaus = array(array(1.0, 2.0, 1.0), array(2.0, 4.0, 2.0), array(1.0, 2.0, 1.0));
    # imageconvolution($img, $gaus, 16, 0);
}

//最終画像出力
imagewebp($img);
imagedestroy($img);
