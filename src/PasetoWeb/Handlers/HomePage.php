<?php
declare(strict_types=1);
namespace ParagonIE\PasetoWeb\Handlers;

use ParagonIE\PasetoWeb\Locator;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class HomePage
 * @package ParagonIE\PasetoWeb
 */
class HomePage
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args = []
    ): Response {
        $vars = [];
        $vars['table'] = \json_decode(\file_get_contents(PASETO_IO_ROOT . '/data/implementations.json'), true);
        Locator::getTwig()->display('index.twig', $vars);
        return $response;
    }
}
