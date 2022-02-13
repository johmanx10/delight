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
        return [
            new TwigFunction(
                'anchor',
                fn (array $context, string $text, string $id = null, string $page = null) => (
                    $this->createAnchor($text, $id, $page ?? $context['meta']['canonical'])
                ),
                ['is_safe' => ['html'], 'needs_context' => true]
            ),
            ...array_map(
                fn (int $level) => new TwigFunction(
                    sprintf('h%d', $level),
                    fn (array $context, string $text, string $id = null) => (
                        $this->createHeadingWithAnchor($level, $text, $id, $context['meta']['canonical'])
                    ),
                    ['is_safe' => ['html'], 'needs_context' => true]
                ),
                range(1, 6)
            )
        ];
    }

    private function normalizeId(string $text, string $id = null): string
    {
        return $this->slugger->slug(strtolower($id ?? $text))->toString();
    }

    public function createAnchor(
        string $text,
        string $id = null,
        string $page = ''
    ): string {
        return sprintf(
            '<a href="%s#%s">%s</a>',
            $page,
            $this->normalizeId($text, $id),
            $text
        );
    }

    public function createHeadingWithAnchor(
        int $level,
        string $text,
        string $id = null,
        string $page = ''
    ): string {
        $id = $this->normalizeId($text, $id);

        return sprintf(
            '<h%1$d id="%3$s">%4$s%2$s</h%1$d>',
            $level,
            $text,
            $id,
            self::createHeadingAnchor($id, $page)
        );
    }

    public static function createHeadingAnchor(string $id, string $page): string
    {
        return sprintf(
            '<a class="anchor" href="%s#%s" aria-hidden="true" tabindex="-1"></a>',
            $page,
            $id
        );
    }
}
