<?php

namespace App\Command;

use App\Service\CategoriesDataFormatter;
use App\Service\CategoryDataSaver;
use App\Service\FoursquareCategoriesGetter;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

/**
 * Class LoadCategories
 */
class LoadCategories extends Command
{
    /**
     * @var FoursquareCategoriesGetter
     */
    private $foursquareCategoriesGetter;

    /**
     * @var CategoryDataSaver
     */
    private $categoryDataSaver;

    /**
     * @var CategoriesDataFormatter
     */
    private $categoryFormatter;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var string
     */
    protected static $defaultName = 'app:load-categories';

    /**
     * LoadCategories constructor.
     *
     * @param FoursquareCategoriesGetter $foursquareCategoriesGetter
     * @param CategoryDataSaver $categoryDataSaver
     * @param CategoriesDataFormatter $categoryFormatter
     * @param LoggerInterface $logger
     * @param EntityManagerInterface $em
     */
    public function __construct(
        FoursquareCategoriesGetter $foursquareCategoriesGetter,
        CategoryDataSaver $categoryDataSaver,
        CategoriesDataFormatter $categoryFormatter,
        LoggerInterface $logger,
        EntityManagerInterface $em
    )
    {
        $this->foursquareCategoriesGetter = $foursquareCategoriesGetter;
        $this->categoryDataSaver = $categoryDataSaver;
        $this->categoryFormatter = $categoryFormatter;
        $this->logger = $logger;
        $this->em = $em;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Load categories from FOURSQUARE API and saving to db.')
            ->setHelp('Load categories from https://api.foursquare.com/v2/venues/categories');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->writeln('Start loading categories  from https://api.foursquare.com/v2/venues/categories');
            $connection = $this->em->getConnection();
            $platform = $connection->getDatabasePlatform();
            $connection->executeUpdate($platform->getTruncateTableSQL('category', true));
            $categories = $this->categoryFormatter->format($this->foursquareCategoriesGetter->get());
            $this->categoryDataSaver->save($categories);
            $output->writeln('Categories successfully loaded and saved!');
        } catch (Throwable $e) {
            $this->logger->error($e->getMessage());
            $output->writeln($e->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}