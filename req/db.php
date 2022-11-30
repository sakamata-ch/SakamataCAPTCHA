<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

function isSessionAvailable(string $session): bool
{
    $ret = DB::queryFirstRow('SELECT pass FROM captchaSession WHERE id=%s', $session);
    return $ret !== null;
}

function isUserPassed(string $session): bool
{
    $ret = DB::queryFirstRow('SELECT pass FROM captchaSession WHERE id=%s', $session);
    if ($ret !== null) {
        DB::delete('captchaSession', 'id=%s', $session);
        return $ret['pass'] === 1;
    } else
        return false;
}

function createSession(string $returnUrl): string
{
    $sessionId = base64_encode(random_bytes(27));
    DB::insert('captchaSession', [
        'id' => $sessionId,
        'returnUrl' => $returnUrl
    ]);

    return $sessionId;
}

function setUserPassed(string $session): string
{
    $ret = DB::queryFirstRow('SELECT returnUrl FROM captchaSession WHERE id=%s', $session);
    if ($ret !== null) {
        DB::update('captchaSession', ['pass' => 1], 'id=%s', $session);
        return $ret['returnUrl'];
    } else
        return false;
}
