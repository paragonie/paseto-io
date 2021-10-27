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
        $implementations = \json_decode(\file_get_contents(PASETO_IO_ROOT . '/data/implementations.json'), true);

        // Sort alphabetically
        \uasort($implementations, function (array $a, array $b): int {
            return \preg_replace('/[^0-9A-Za-z]/', '', $a['language'])
                   <=>
               \preg_replace('/[^0-9A-Za-z]/', '', $b['language']);
        });
        $vars['modernImpls'] = [];
        $vars['legacyImpls'] = [];
        foreach ($implementations as $impl) {
            if ($impl['features']['v1.local'] || $impl['features']['v1.public'] || $impl['features']['v2.local'] || $impl['features']['v2.public']) {
                array_push($vars['legacyImpls'], $impl);
            }
            if ($impl['features']['v3.local'] || $impl['features']['v3.public'] || $impl['features']['v4.local'] || $impl['features']['v4.public']) {
                array_push($vars['modernImpls'], $impl);
            }
        }
        Locator::getTwig()->display('index.twig', $vars);
        return $response;
    }
}
