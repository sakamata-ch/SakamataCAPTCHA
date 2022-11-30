<?php
require_once __DIR__ . '/textgen.php';

function validate($input = null)
{
    global $string;

    return $string === ($input ?? $_POST['input'] ?? '');
}
