<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Jferdi24\PatternsLaravel\Application;
use Jferdi24\PatternsLaravel\Domain\MyService;
use Symfony\Component\HttpFoundation\Request;

$app = new Application();

$app->registerDependency(MyService::class, new MyService());
$app->registerDependency(Request::class, Request::createFromGlobals());

$response = $app->processRequest();

$response->send();
