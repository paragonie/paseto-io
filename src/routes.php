<?php
use ParagonIE\PasetoWeb\Handlers\{
    Demo,
    HomePage,
    RFCViewer
};
use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/rfc/[{slug}]', RFCViewer::class);
$app->any('/demo', Demo::class);
$app->get('/', HomePage::class);
$app->get('', HomePage::class);

