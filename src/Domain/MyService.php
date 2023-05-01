<?php

declare(strict_types=1);

namespace Jferdi24\PatternsLaravel\Domain;

class MyService
{
    protected string $name;

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function print(): string
    {
        return "hello, {$this->name}";
    }
}
