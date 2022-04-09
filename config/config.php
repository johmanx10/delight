<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

if (defined('PAGES')) {
    return;
}

$env = new Dotenv();
$env->usePutenv(true);
$env->loadEnv(__DIR__ . '/../.env');

const PAGES = [
    'home' => [
        'label' => 'Home',
        'path' => '',
        'controller' => __DIR__ . '/../pages/home.php',
        'output' => 'index.html'
    ],
    'holistisch-therapeut' => [
        'label' => 'Holistisch therapeut',
        'path' => 'holistisch-therapeut.html',
        'controller' => __DIR__ . '/../pages/holistisch-therapeut.php',
        'output' => 'holistisch-therapeut.html'
    ],
    'life-coach' => [
        'label' => 'Life coach',
        'path' => 'life-coach.html',
        'controller' => __DIR__ . '/../pages/life-coach.php',
        'output' => 'life-coach.html'
    ],
    'reiki' => [
        'label' => 'Reiki',
        'path' => 'reiki.html',
        'controller' => __DIR__ . '/../pages/reiki.php',
        'output' => 'reiki.html'
    ],
    'over-jou' => [
        'label' => 'Over jou',
        'path' => 'over-jou.html',
        'controller' => __DIR__ . '/../pages/over-jou.php',
        'output' => 'over-jou.html'
    ],
    'over-mij' => [
        'label' => 'Over mij',
        'path' => 'over-mij.html',
        'controller' => __DIR__ . '/../pages/over-mij.php',
        'output' => 'over-mij.html'
    ],
    'reviews' => [
        'label' => 'Reviews',
        'path' => 'beoordelingen.html',
        'controller' => __DIR__ . '/../pages/reviews.php',
        'output' => 'beoordelingen.html'
    ],
//    'blog' => [
//        'label' => 'Blog',
//        'path' => 'blog/',
//        'controller' => __DIR__ . '/../pages/blog.php',
//        'output' => 'blog/index.html'
//    ],
    'contact' => [
        'label' => 'Contact',
        'path' => 'contact.html',
        'controller' => __DIR__ . '/../pages/contact.php',
        'output' => 'contact.html'
    ]
];

const TEMPLATE_OPTIONS = [
    'debug' => true,
    'strict_variables' => true
];

const NAV_LAYOUT = [
    'links' => [
        'home',
        'holistisch-therapeut',
        'life-coach',
        'reiki',
        'over-jou',
        'over-mij',
        'reviews',
//        'blog',
        'contact'
    ],
    'doormat' => [
        'Diensten' => ['holistisch-therapeut', 'life-coach', 'reiki'],
        'Impressies' => ['over-jou', 'over-mij', 'reviews'],
        'Klantenservice' => ['contact']
    ]
];

define('IS_DEVELOPMENT', ($_ENV['APP_ENV'] ?? 'prod') === 'dev');

define(
    'WEBSITE',
    getenv('WEBSITE') ?: (
        IS_DEVELOPMENT
            ? 'http://johmanx10.delight.localhost'
            : 'https://www.delightcoachingpraktijk.nl'
    )
);

const WEB_ROOT = __DIR__ . '/../public/';
