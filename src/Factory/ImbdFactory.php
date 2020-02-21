<?php

declare(strict_types=1);

namespace Movifony\Factory;

use Movifony\DTO\MovieDto;
use Movifony\Entity\ImdbMovie;

/**
 * Class ImbdMovieFactory
 *
 * @author Corentin Bouix <cbouix@clever-age.com>
 */
class ImbdFactory
{
    /**
     * @param MovieDto $movieDto
     *
     * @return ImdbMovie
     */
    public static function createMovie(MovieDto $movieDto): ImdbMovie
    {
        $movie = new ImdbMovie();
        $movie->setTitle($movieDto->getTitle());
        $movie->setIdentifier($movieDto->getIdentifier());

        return $movie;
    }
}
