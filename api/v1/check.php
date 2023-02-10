<?php
require_once __DIR__ . '/../../req/validate.php';

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
print(json_encode(array(
    'ok' => validate()
)));
