<?php

declare(strict_types=1);

namespace Movifony\Service;

use Movifony\DTO\MovieDto;
use Movifony\Entity\ImdbMovie;
use Movifony\Factory\ImdbFactory;

/**
 * Class ImdbMovieImporter
 * 
 * 
 * @author Corentin Bouix <cbouix@clever-age.com>
 */
class ImdbMovieImporter implements ImporterInterface
{

    /** 
     * @inheritDoc
     */
    public function read(array $data): MovieDto {
        return new MovieDto($data['title']);
    }
    
    /** 
     * @inheritDoc
     */
    public function process(MovieDto $movieDto): ImdbMovie
    {
        return ImdbFactory::createMovie($movieDto);
    }

    /**
     * @inheritDoc
     */
    public function import(ImdbMovie $movie): bool
    {

    }
}
