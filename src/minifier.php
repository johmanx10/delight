<?php

declare(strict_types=1);

use voku\helper\HtmlMin;

$minifier = new HtmlMin();

$minifier->doRemoveWhitespaceAroundTags();
$minifier->doRemoveOmittedQuotes(false);

return $minifier;
