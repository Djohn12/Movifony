<?php

declare(strict_types=1);

namespace Movifony\Service;

use Movifony\DTO\MovieDto;
use Movifony\Entity\ImdbMovie;

/**
 * Define import available logic for movie import
 */
interface ImporterInterface
{
    /** 
     * Transfer array data to a Dto
     * @param array
     * @return MovieDto
     */
    public function read(array $data): MovieDto;

    /** 
     * Transform Dto to a Movie object
     * @param MovieDto
     * @return ImdbMovie
     */
    public function process(MovieDto $movieDto): ImdbMovie;

    /**
     * Import Movie object to database
     * @param ImdbMovie
     * @return bool
     */
    public function import(ImdbMovie $movie): bool;
}
