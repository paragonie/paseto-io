<?php
// DIC configuration
/** @var \Slim\App $app */
/** @var \Slim\Container $container */
$container = $app->getContainer();

$container['twig'] = function (\Slim\Container $c): Twig_Environment {
    $settings = $c->get('settings')['twig'];
    $twigEnv = new Twig_Environment($settings['loader']);

    foreach ($settings['filters'] as $name => $func) {
        if ($func instanceof Twig_Filter) {
            $twigEnv->addFilter($func);
        } elseif (is_callable($func)) {
            $twigEnv->addFilter(
                new Twig_Filter($name, $func)
            );
        }
    }

    foreach ($settings['functions'] as $name => $func) {
        if ($func instanceof Twig_Function) {
            $twigEnv->addFunction($func);
        } elseif (is_callable($func)) {
            $twigEnv->addFunction(
                new Twig_SimpleFunction($name, $func)
            );
        }
    }

    foreach ($settings['globals'] as $key => $value) {
        $twigEnv->addGlobal($key, $value);
    }

    return $twigEnv;
};
\ParagonIE\PasetoWeb\Locator::setTwig($container['twig']);

// monolog
$container['logger'] = function ($c) {
    /** @var \Slim\Container $c */
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
