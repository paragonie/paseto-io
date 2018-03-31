<?php

use ParagonIE\PasetoWeb\Handlers\{
    HomePage
};
use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', HomePage::class);
$app->get('', HomePage::class);

