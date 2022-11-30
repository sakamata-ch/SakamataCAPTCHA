<?php
$hiraganas = array(
    'あ', 'い', 'う', 'え', 'お',
    'か', 'き', 'く', 'け', 'こ',
    'さ', 'し', 'す', 'せ', 'そ',
    'た', 'ち', 'つ', 'て', 'と',
    'な', 'に', 'ぬ', 'ね', 'の',
    'は', 'ひ', 'ふ', 'へ', 'ほ',
    'ま', 'み', 'む', 'め', 'も',
    'や', 'ゆ', 'よ',
    'ら', 'り', 'る', 'れ', 'ろ',
    'わ', 'を', 'ん'
);

$rawseed = $rawseed ?? $_GET['seed'] ?? $_POST['seed'] ?? null;
$seed = (isset($rawseed) && is_numeric($rawseed)) ? intval($rawseed) : random_int(1, PHP_INT_MAX);
srand($seed);

$string = '';
for ($i = 0; $i < 5; $i++) {
    $string .= $hiraganas[mt_rand(0, count($hiraganas) - 1)];
    srand(mt_rand(1, PHP_INT_MAX));
}
