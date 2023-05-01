<?php

declare(strict_types=1);

namespace Jferdi24\PatternsLaravel\Http\Controllers;

use Jferdi24\PatternsLaravel\Domain\MyService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class WelcomeController
{
    public function greet(Request $request, MyService $myService): JsonResponse
    {
        $myService->setName($request->get('name', 'World!'));

        return new JsonResponse([
            'message' => $myService->print(),
            'method' => 'greet',
            'controller' => WelcomeController::class,
        ]);
    }
}
