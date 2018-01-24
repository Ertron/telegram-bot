<?php
require_once __DIR__ . '/bootstrap.php';

$content = file_get_contents('php://input');
$array = json_decode($content, true);

$bot->process($array);