<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Jferdi24\PatternsLaravel\Application;

$app = new Application();

$response = $app->processRequest();

$response->send();
