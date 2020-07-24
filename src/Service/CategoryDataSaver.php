<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CategoryDataSaver
 */
class CategoryDataSaver
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CategoryDataSaver constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $categories
     */
    public function save(array $categories): void
    {
        foreach ($categories as $category) {
            $this->em->persist($category);
            $this->em->flush();
        }
        $this->em->flush();
    }
}