<?php

declare(strict_types=1);

use Delight\Website\Twig\HeadingAnchorExtension;
use Delight\Website\Twig\RoutingExtension;
use Delight\Website\Twig\SubresourceIntegrityExtension;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Extra\String\StringExtension;
use Twig\Loader\FilesystemLoader;

$environment = new Environment(
    new FilesystemLoader(
        __DIR__ . '/../templates'
    ),
    TEMPLATE_OPTIONS
);

$environment->addExtension(new DebugExtension());
$environment->addExtension(new StringExtension());
$environment->addExtension(new RoutingExtension(WEBSITE, PAGES));
$environment->addExtension(
    new SubresourceIntegrityExtension(__DIR__ . '/../public/')
);
$environment->addExtension(
    new HeadingAnchorExtension(new AsciiSlugger())
);

return $environment;
