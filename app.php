<?php
require_once __DIR__ . '/bootstrap.php';

$request->apiRequestJson('setWebhook', array('url' => $hook_url));
