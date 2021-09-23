<?php
/* This file has been prefixed by <PHP-Prefixer> for "Using Guzzle in a WordPress plug-in with PHP-Prefixer" */

declare(strict_types=1);

require dirname(__DIR__, 2) . '/vendor/autoload.php';

$request = \PPP\GuzzleHttp\Psr7\ServerRequest::fromGlobals();

$output = [
    'method' => $request->getMethod(),
    'uri' => $request->getUri()->__toString(),
    'body' => $request->getBody()->__toString(),
];

echo json_encode($output);
