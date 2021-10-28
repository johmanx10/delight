<?php

declare(strict_types=1);

use voku\helper\HtmlMin;

$minifier = new HtmlMin();

$minifier->doRemoveSpacesBetweenTags();
$minifier->doRemoveWhitespaceAroundTags();

return $minifier;
