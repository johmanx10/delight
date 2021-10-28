<?php

declare(strict_types=1);

use voku\helper\HtmlMin;

$minifier = new HtmlMin();

$minifier->doRemoveWhitespaceAroundTags();

return $minifier;
