<?php
require __DIR__ . '/../req/db.php';

if (!isset($_GET['session']))
    return;

$passed = isUserPassed($_GET['session']);

print(json_encode(array(
    'result' => $passed ? 0 : 1
)));
