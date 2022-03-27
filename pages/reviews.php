<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

return render(
    'reviews',
    [
        'title' => 'Beoordelingen - Delight Coachingpraktijk',
        'meta' => [
            'description' => 'Zoals een ander over mij vertelt, zo spreekt men, oprecht en open.'
        ],
        'reviews' => [
            [
                'summary' => 'Ik was al lang zoekende',
                'author' => 'Joke',
                'reviewBody' => [
                    <<<PARAGRAPH
                    Ik was al lang zoekende. Viel van de ene klacht in de andere,
                    zonder dat er echt een vinger op gelegd kon worden. Artsen
                    konden niet vinden wat mij mankeerde. Ik wilde zo graag weer
                    een energiek en blij leven.
                    PARAGRAPH,

                    <<<PARAGRAPH
                    Toen ik bij Anja kwam heeft ze
                    me eerst laten praten. Gek genoeg had ik nog nooit zoveel
                    verteld. Het ging helemaal vanzelf, daar in die gezellige,
                    huiselijke sfeer, in haar praktijk.
                    Kopje koffie erbij en het voelde alsof mijn beste vriendin,
                    maar ook mijn moeder, echt oprecht naar me luisterde, zonder
                    haast en tijdsdruk. Zo nu en dan een aantekening makende,
                    kwam Anja daarna met inzichten die ze tussendoor had ontvangen.
                    En zo kreeg ik voor het eerst zicht op de verbinding tussen
                    de klachten.
                    PARAGRAPH,

                    <<<PARAGRAPH
                    De behandelingen die volgden bestonden uit heerlijke,
                    ontspannende Reiki behandelingen, waarna ze steeds weer
                    vertelde wat ze tegenkwam en had gedaan.
                    Ze werkt met edelstenen en etherische geuren.
                    Die helpen haar, zegt ze dan. Ook hebben we tijd besteed aan
                    de familielijn.
                    Door poppetjes neer te zetten en die te benoemen, waar Anja
                    energetisch op in kan voelen, wordt er veel duidelijk van de
                    familiesystemen.
                    PARAGRAPH,

                    <<<PARAGRAPH
                    Na 6 behandelingen had ik zelf weer de regie over mijn
                    leven en wist door mijn problemen heen te kijken.
                    Ik kan verder, voel me lichter en blijer en heb weer zin in
                    het leven.
                    PARAGRAPH,

                    <<<PARAGRAPH
                    Ik ga nog af en toe terug om te checken of alles nog in
                    balans is, en om weer geïnspireerd te raken door haar.
                    PARAGRAPH
                ]
            ]
        ]
    ]
);
