<?php
require __DIR__ . '/../req/db.php';

if (!isset($_POST['returnUrl']))
    return;

$sessionId = createSession($_POST['returnUrl']);

print(json_encode(array(
    'session' => $sessionId,
    'url' => '/captcha/image.php?session=' . $sessionId,
)));
