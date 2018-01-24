<?php

require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

use lib\CustomRequest;
use lib\HookRequest;
use lib\Bot;

$logger = new Logger('Logger');
$logger->pushHandler(new StreamHandler(__DIR__.'/logs/app_test.log', Logger::DEBUG));
$logger->pushHandler(new FirePHPHandler());

// Add you bot's API key and name
$bot_api_key  = '387168517:AAENfUAXSddm7wUCSEZhy0OWiF8L84q4DYA';
$bot_username = 'DFtest_bot';
$api_url = 'https://api.telegram.org/bot'.$bot_api_key.'/';

// Define the URL to your hook.php file
$hook_url     = 'https://861f32dc.ngrok.io/hook.php';

$host = 'localhost';
$db   = 'telegram';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$request = new CustomRequest($logger, $api_url);
$hook = new HookRequest($request, $pdo);
$bot = new Bot($hook);