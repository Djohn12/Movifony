<?php
declare(strict_types=1);

namespace Movifony\Factory;

use Movifony\DTO\MovieDto;
use Movifony\Entity\ImdbMovie;

/**
 * Class ImdbFactory
 */
class ImdbFactory
{
    /**
     * Create and return new Movie object from movieDto
     * @param MovieDto $movieDto
     * @return ImdbMovie
     */
    static public function createMovie(MovieDto $movieDto): ImdbMovie
    {
        $newMovie = new ImdbMovie();
        $newMovie->setTitle($movieDto->getTitle());
        return $newMovie;
    }
}