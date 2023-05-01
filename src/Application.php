<?php

declare(strict_types=1);

namespace Jferdi24\PatternsLaravel;

use ReflectionException;
use ReflectionMethod;
use Symfony\Component\HttpFoundation\Response;

class Application
{
    protected array $dependencies = [];
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

        try {
            $controllerReflect = new ReflectionMethod($controller, $method);
            $parameters = $controllerReflect->getParameters();

            $dependencies = [];
            foreach ($parameters as $parameter) {
                $dependenceClass = (string) $parameter->getType();
                $dependencies[] = $this->dependencies[$dependenceClass];
            }
        } catch (ReflectionException $exception) {
            return new Response("<pre>Ha ocurrido un error resolviendo la ruta <br>".$exception->getMessage());
        }

        /** return (new $controller)->{$method}(...$dependencies); */
        return call_user_func([
            new $controller,
            $method,
        ], ...$dependencies);
    }

    public function registerDependency(string $className, object $resolve): void
    {
        $this->dependencies[$className] = $resolve;
    }
}
