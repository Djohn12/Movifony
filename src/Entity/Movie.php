<?php

declare(strict_types=1);

namespace Movifony\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Entity()
 * @ORM\Table(name="mf_movie")
 *
 * @author Corentin Bouix <cbouix@clever-age.com>
 */
class Movie
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     */
    protected string $title;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
