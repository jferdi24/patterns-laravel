<?php

declare(strict_types=1);

namespace Jferdi24\PatternsLaravel;

use Symfony\Component\HttpFoundation\Response;

class Application
{
    protected array $segments = [];
    protected string $controller;
    protected string $method;

    public function __construct()
    {
        $this->segments = explode('/', $_SERVER['REQUEST_URI']);

        $this->setController();
        $this->setMethod();
    }

    public function setController(): void
    {
        $this->controller = empty($this->segments[1])
            ? 'home'
            : $this->segments[1];
    }

    public function setMethod(): void
    {
        $this->method = empty($this->segments[2])
            ? 'index'
            : explode('?', $this->segments[2])[0];
    }

    public function getController(): string
    {
        $controller = ucfirst($this->controller);

        return "Jferdi24\\PatternsLaravel\\Http\\Controllers\\{$controller}Controller";
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function processRequest(): Response
    {
        $controller = $this->getController();
        $method = $this->getMethod();

        /** return (new $controller)->{$method}(); */
        return call_user_func([
            new $controller,
            $method,
        ]);
    }
}
