<?php

require_once __DIR__ . '/vendor/autoload.php';

use League\CommonMark\CommonMarkConverter;

$converter = new CommonMarkConverter([
    'html_input' => 'strip',
    'allow_unsafe_links' => false,
]);





echo $converter->convert("Bonjours les personnes j'essai le **markdown** ! ! !");
