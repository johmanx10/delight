<?php

declare(strict_types=1);

namespace Delight\Website\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RoutingExtension extends AbstractExtension
{
    public function __construct(
        private string $website,
        private array $routes
    ) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('path', [$this, 'getPath']),
            new TwigFunction('url', [$this, 'createUrl']),
            new TwigFunction('label', [$this, 'getLabel'])
        ];
    }

    public function getPath(string $route): string
    {
        return $this->routes[$route]['path'] ?? '';
    }

    public function createUrl(string $route): string
    {
        return sprintf(
            '%s/%s',
            rtrim($this->website, '/'),
            ltrim($this->getPath($route), '/')
        );
    }

    public function getLabel(string $route): string
    {
        return $this->routes[$route]['label'] ?? '';
    }
}
