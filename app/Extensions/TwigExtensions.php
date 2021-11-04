<?php

namespace App\Extensions;

use Twig_Extension;
use Twig_SimpleFunction;

class TwigExtensions extends Twig_Extension
{
    public function getName()
    {
        //
    }

    /**
     * Functions
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('dateBr2Sql', 'dateBr2Sql'),
            new Twig_SimpleFunction('dateSql2Br', 'dateSql2Br'),
            new Twig_SimpleFunction('currencyBrl2Float', 'currencyBrl2Float'),
            new Twig_SimpleFunction('currencyFloat2Brl', 'currencyFloat2Brl'),
            new Twig_SimpleFunction('getFullFtpUrl', 'getFullFtpUrl'),
            new Twig_SimpleFunction('is_numeric', function ($str) {
                return is_numeric($str);
            })
        ];
    }

    /**
     * Filters
     * @return array
     */
    public function getFilters()
    {
        return [
            // Filters go here
        ];
    }
}
