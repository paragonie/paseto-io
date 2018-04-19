<?php
declare(strict_types=1);
namespace ParagonIE\PasetoWeb\Handlers;

use ParagonIE\PasetoWeb\Locator;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class RFCViewer
 * @package ParagonIE\PasetoWeb
 */
class RFCViewer
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
        $twig = Locator::getTwig();
        $twig->display('rfc.twig', [
            'draft' => $this->getDraft($args),
            'active' => 'rfc'
        ]);
        return $response;
    }

    /**
     * @param array $args
     *
     * @return string
     */
    public function getDraft(array $args = []): array
    {
        $drafts = include PASETO_IO_ROOT . '/src/rfcdrafts.php';
        if (isset($args['slug'])) {
            if (\is_string($args['slug'])) {
                $slug = $args['slug'];
                foreach ($drafts as $draft) {
                    if ($draft['slug'] === $slug) {
                        $draft['contents'] = \file_get_contents(
                            PASETO_IO_ROOT . '/data/rfc/' . $draft['file']
                        );
                        return $draft;
                    }
                }
            }
        }

        // Default: Latest RFC draft
        \uasort($drafts, function (array $a, array $b): int {
            return $b['date'] <=> $a['date'];
        });
        $draft = \array_shift($drafts);
        $draft['contents'] = \file_get_contents(
            PASETO_IO_ROOT . '/data/rfc/' . $draft['file']
        );
        return $draft;
    }
}
