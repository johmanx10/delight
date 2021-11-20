<?php

declare(strict_types=1);

namespace Delight\Website\Twig;

use Symfony\Component\String\Slugger\SluggerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class HeadingAnchorExtension extends AbstractExtension
{
    public function __construct(
        private SluggerInterface $slugger
    ) {}

    public function getFunctions(): array
    {
        return array_map(
            fn (int $level) => new TwigFunction(
                sprintf('h%d', $level),
                fn (string $text, string $id = null) => (
                    $this->createHeadingWithAnchor($level, $text, $id)
                ),
                ['is_safe' => ['html']]
            ),
            range(1, 6)
        );
    }

    public function createHeadingWithAnchor(
        int $level,
        string $text,
        string $id = null
    ): string {
        $id ??= $this->slugger->slug(strtolower($text))->toString();

        return sprintf(
            '<h%1$d id="%3$s">%4$s%2$s</h%1$d>',
            $level,
            $text,
            $id,
            self::createAnchor($id)
        );
    }

    public static function createAnchor(string $id): string
    {
        return sprintf(
            '<a class="anchor" href="#%s" aria-hidden="true" tabindex="-1"></a>',
            $id
        );
    }
}
