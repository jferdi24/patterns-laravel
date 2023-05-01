<?php

declare(strict_types=1);

namespace Jferdi24\PatternsLaravel\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

class AboutController
{
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'controller' => AboutController::class,
            'method' => 'index',
        ]);
    }
}
