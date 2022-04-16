<?php

declare(strict_types=1);

use Delight\Website\PositionStack\ApiLookup;
use Delight\Website\PositionStack\CacheProxyLookup;
use Delight\Website\PositionStack\CoordinateLookup;
use Delight\Website\Twig\AddressExtension;
use Delight\Website\Twig\DateExtension;
use Delight\Website\Twig\HeadingAnchorExtension;
use Delight\Website\Twig\ProductExtension;
use Delight\Website\Twig\RoutingExtension;
use Delight\Website\Twig\SubresourceIntegrityExtension;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpClient\HttpClient;
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
$environment->addExtension(new ProductExtension());
$environment->addExtension(new DateExtension());
$environment->addExtension(
    new AddressExtension(
        new CoordinateLookup(
            new CacheProxyLookup(
                new ApiLookup(
                    HttpClient::createForBaseUri(getenv('POINTSTACK_API')),
                    getenv('POINTSTACK_ACCESS_KEY')
                ),
                new FilesystemAdapter(
                    namespace: 'addresses',
                    directory: __DIR__ . '/../var/cache'
                )
            )
        )
    )
);

return $environment;
