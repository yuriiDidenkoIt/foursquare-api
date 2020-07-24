<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    private const MATERIALIZED_TABLE = 'category_materialized';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return mixed[]
     * @throws DBALException
     */
    public function getFirstLevelCategoriesFromMaterialized(): array
    {
        $query = 'SELECT * FROM ' . self::MATERIALIZED_TABLE . ' as cm WHERE cm.is_first_level = :isFirstLevel;';
        $statement = $this->getEntityManager()->getConnection()->prepare($query);
        $statement->bindValue('isFirstLevel', true);
        $statement->execute();

        return $statement->fetchAll();

    }

    /**
     * @param string $categoryId
     *
     * @return mixed[]
     * @throws DBALException
     */
    public function getSubCategoriesFromMaterialized(string $categoryId)
    {
        $subQuery = 'SELECT sc.sub_categories_ids FROM ' . self::MATERIALIZED_TABLE . ' AS sc WHERE sc.category_id = :categoryId';
        $query = 'SELECT * FROM '
            . self::MATERIALIZED_TABLE . ' as cm where position(cm.category_id in (' . $subQuery . ')) > 0 ;';
        $statement = $this->getEntityManager()->getConnection()->prepare($query);
        $statement->bindValue('categoryId', $categoryId);
        $statement->execute();

        return $statement->fetchAll();

    }
}
