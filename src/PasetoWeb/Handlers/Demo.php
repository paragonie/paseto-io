<?php
declare(strict_types=1);
namespace ParagonIE\PasetoWeb\Handlers;

use ParagonIE\PasetoWeb\Locator;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Demo
 * @package ParagonIE\PasetoWeb
 */
class Demo
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
        Locator::getTwig()->display('demo.twig', ['active' => 'demo']);
        return $response;
    }
}
