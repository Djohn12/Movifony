<?php

declare(strict_types=1);

namespace Movifony\Command;

use League\Csv\Exception;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Movifony\Service\ImdbMovieImporter;
use Movifony\DTO\MovieDto;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Helper\ProgressBar;

/**
 * Command that will import IMDB movies data from TSV file
 *
 * @link   https://www.imdb.com/interfaces/
 *
 * @author Corentin Bouix <cbouix@clever-age.com>
 */
class ImdbMovieImportCommand extends Command
{
    /** @var string */
    protected const MOVIE_FILENAME = 'data.tsv';

    /** @var string */
    protected static $defaultName = 'movifony:import:movies:imdb';

    /** @var string */
    protected string $projectDir;

    /** @var ImdbMovieImporter */
    protected ImdbMovieImporter $imdbMovieImporter;

    /** @var LoggerInterface */
    protected LoggerInterface $logger;

    /** @var int */
    protected const BATCH_SIZE=1000;

    public function __construct(string $name = null, string $projectDir, ImdbMovieImporter $imdbMovieImporter, LoggerInterface $loggerInterface)
    {
        parent::__construct($name);
        $this->projectDir = $projectDir;
        $this->imdbMovieImporter = $imdbMovieImporter;
        $this->logger = $loggerInterface;

    }

    /**
     * 
     * 
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        //load the CSV document from a file path
        $csv = Reader::createFromPath($this->getImportFilePath(), 'r');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter("\t");

        //$header = $csv->getHeader(); //returns the CSV header record
        $records = $csv->getRecords();
        $progressBar = new ProgressBar($output, 2000);
        $records->rewind();

        while($records->valid())
        {
            for ($i=0; $i < self::BATCH_SIZE; $i++) {
                // $movieDto = new MovieDto($records->current()['title']);
                // $movie = $this->imdbMovieImporter->process($movieDto);
                $this->importFile($records->current());
                $records->next();
                $progressBar->advance();
            }
            $this->imdbMovieImporter->clear();
        }
        $progressBar->finish();
        
        
        // foreach ($records as $record) {
            //     // $state = $this->imdbMovieImporter->import($movie);
            //     // if (!$state)
            //     // {
                //     //     $this->logger->warning("Can't import movie with title : {$movie->getTitle()}");
                //     // }
                //     $this->imdbMovieImporter->import($movie);
                //     // $output->writeln(print_r($movie));
                // }
    }

    /**
     * import new Movie in database from record
     * @param array $record (a row from tsv file)
     * @return bool
     */
    public function importFile(array $record): bool
    {
        $movieDto = new MovieDto($record['title']);
        $movie = $this->imdbMovieImporter->process($movieDto);
        dump($movie);
        return $this->imdbMovieImporter->import($movie);
    }

    /**
     * Get file path name
     *
     * @return string
     */
    protected function getImportFilePath(): string
    {
        return implode(
            DIRECTORY_SEPARATOR,
            [
                $this->projectDir,
                'data',
                self::MOVIE_FILENAME,
            ]
        );
    }
}
