<?php

declare(strict_types=1);

namespace Movifony\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Movifony\DTO\MovieDto;
use Movifony\Entity\ImdbMovie;
use Movifony\Factory\ImdbFactory;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ImdbMovieImporter
 * 
 * 
 * @author Corentin Bouix <cbouix@clever-age.com>
 */
class ImdbMovieImporter implements ImporterInterface
{
    /**
     * @var ManagerRegistry $managerRegistry
     */
    protected $managerRegistry;    


    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }
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
        $om = $this->getManager();
        if (!$om)
        {
            // throw new Exception("Can't find any manager for Imdb");
            return false;
        }
        $om->persist($movie);
        $om->flush();
        return true;
    }
    
    /**
     * Clear current manager
     */
    public function clear(): void
    {
        $this->managerRegistry->getManager()->clear();
    }

    public function getManager(): ObjectManager
    {
        return $this->managerRegistry->getManagerForClass(ImdbMovie::class);
    }

}
