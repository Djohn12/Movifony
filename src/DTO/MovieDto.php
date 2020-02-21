<?php

declare(strict_types=1);

namespace Movifony\DTO;

/**
 * Class MovieDto
 * Handle raw data from IMDB import file
 *
 * @author Corentin Bouix <cbouix@clever-age.com>
 */
class MovieDto
{
    private string $title;

    /**
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
