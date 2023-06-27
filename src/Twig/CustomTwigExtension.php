<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CustomTwigExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('urlContains', [$this, 'urlContains']),
        ];
    }

    public function urlContains($haystack, $needle)
    {
        // Check if the needle is present in the haystack URL
        return strpos($haystack, $needle) !== false;
    }
}