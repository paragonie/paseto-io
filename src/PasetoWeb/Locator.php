<?php
declare(strict_types=1);
namespace ParagonIE\PasetoWeb;

/**
 * Class Locator
 * @package ParagonIE\PasetoWeb
 */
class Locator
{
    /**
     * @var \Twig_Environment $twig
     */
    protected static $twig;

    /**
     * @param \Twig_Environment $twig
     * @return void
     */
    public static function setTwig(\Twig_Environment $twig)
    {
        self::$twig = $twig;
    }

    public static function getTwig(): \Twig_Environment
    {
        return self::$twig;
    }
}
