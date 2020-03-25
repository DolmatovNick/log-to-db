<?php

include 'vendor/autoload.php';

$offset = $_GET['offset'] ?? 0;
$stats = new LogStats((int)$offset);

Template::render('public/index.tpl', [
    'rows' => $stats->getRows(),
    'total_count' => $stats->getTotalCount(),
    'per_page' => 2,
]);