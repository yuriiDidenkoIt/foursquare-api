<?php

namespace App\Service;

use App\Validator\Foursquare\CategoryValidator;
use App\Entity\Category;
use Psr\Log\LoggerInterface;

/**
 * Class CategoriesDataFormatter
 */
class CategoriesDataFormatter
{
    /**
     * @var CategoryValidator;
     */
    private $validator;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var array
     */
    private $result = [];

    /**
     * CategoriesDataFormatter constructor.
     *
     * @param CategoryValidator $validator
     * @param LoggerInterface $logger
     */
    public function __construct(CategoryValidator $validator, LoggerInterface $logger)
    {
        $this->validator = $validator;
        $this->logger = $logger;
    }


    /**
     * @param array $categories
     *
     * @return Category[]
     */
    public function format(array $categories): array
    {
        $this->doFormat($categories, true);

        return $this->result;
    }

    /**
     * @param array $categories
     * @param bool $isFirstLevel
     */
    private function doFormat(array $categories, bool $isFirstLevel): void
    {
        foreach ($categories as $category) {
            $subCategoriesIds = array_map(
                function ($subCategory) {
                    return $subCategory['id'];
                },
                $category['categories']
            );
            $id = $category['id'];
            $name = $category['name'];
            $iconPrefix = $category['icon']['prefix'];
            $iconSuffix = $category['icon']['suffix'];

            $this->validator->validate([
                'id' => $id,
                'name' => $name,
                'iconPrefix' => $iconPrefix,
                'iconSuffix' => $iconSuffix,
            ]);

            $this->result[$id] = (new Category())
                ->setCategoryId($id)
                ->setName($name)
                ->setIsFirstLevel($isFirstLevel)
                ->setIconPrefix($iconPrefix)
                ->setIconSuffix($iconSuffix)
                ->setSubCategoriesIds($subCategoriesIds);
            if ($category['categories']) {
                $this->doFormat($category['categories'], false);
            }
        }
    }
}