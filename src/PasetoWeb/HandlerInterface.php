<?php
namespace ParagonIE\PasetoWeb;

use Slim\Http\{
    Request,
    Response
};

/**
 * Interface HandlerInterface
 * @package ParagonIE\PasetoWeb
 */
interface HandlerInterface
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return mixed
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args = []
    ): Response;
}
