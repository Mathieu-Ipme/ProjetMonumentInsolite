<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\GenreExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class GenreExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [

        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_genres', [GenreExtensionRuntime::class, 'getGenres']),
        ];
    }
}
