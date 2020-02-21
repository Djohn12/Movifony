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
    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $identifier;

    /**
     * @param string $title
     * @param string $identifier
     */
    public function __construct(string $title, string $identifier)
    {
        $this->title = $title;
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
