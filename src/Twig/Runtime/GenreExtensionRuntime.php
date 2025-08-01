<?php

namespace App\Twig\Runtime;

use App\Repository\GenreRepository;
use Twig\Extension\RuntimeExtensionInterface;

class GenreExtensionRuntime implements RuntimeExtensionInterface
{


    public function __construct(
        private GenreRepository $genreRepository
    )
    {
        // Inject dependencies if needed
    }

   public function getGenres(){

        return $this->genreRepository->findAll();
    }
}
