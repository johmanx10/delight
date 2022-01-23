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
                fn (array $context, string $text, string $id = null) => (
                    $this->createHeadingWithAnchor($level, $text, $id, $context['meta']['canonical'])
                ),
                ['is_safe' => ['html'], 'needs_context' => true]
            ),
            range(1, 6)
        );
    }

    public function createHeadingWithAnchor(
        int $level,
        string $text,
        string $id = null,
        string $page = ''
    ): string {
        $id = $this->slugger->slug(strtolower($id ?? $text))->toString();

        return sprintf(
            '<h%1$d id="%3$s">%4$s%2$s</h%1$d>',
            $level,
            $text,
            $id,
            self::createAnchor($id, $page)
        );
    }

    public static function createAnchor(string $id, string $page): string
    {
        return sprintf(
            '<a class="anchor" href="%s#%s" aria-hidden="true" tabindex="-1"></a>',
            $page,
            $id
        );
    }
}
