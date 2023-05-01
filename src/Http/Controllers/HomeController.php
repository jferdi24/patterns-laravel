<?php

declare(strict_types=1);

namespace Jferdi24\PatternsLaravel\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController
{
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'controller' => HomeController::class,
            'method' => 'index',
        ]);
    }
}
