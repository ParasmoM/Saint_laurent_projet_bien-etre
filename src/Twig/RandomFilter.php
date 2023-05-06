<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RandomFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('random', [$this, 'randomArray']),
        ];
    }

    public function randomArray($array)
    {
        if (is_array($array)) {
            shuffle($array);
        }

        return $array;
    }
}
