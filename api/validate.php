<?php
require_once(__DIR__ . '/../req/validate.php');
header("Content-type: text/json");

print json_encode(array('result' => validate() ? 'ok' : 'ng', 'actual' => $string, 'input' => $_POST['input']), JSON_UNESCAPED_UNICODE);
