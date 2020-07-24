<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_first_level;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $sub_categories_ids = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icon_prefix;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $icon_suffix;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param string $category_id
     *
     * @return Category
     */
    public function setCategoryId(string $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsFirstLevel(): ?bool
    {
        return $this->is_first_level;
    }

    public function setIsFirstLevel(bool $is_first_level): self
    {
        $this->is_first_level = $is_first_level;

        return $this;
    }

    public function getSubCategoriesIds(): ?array
    {
        return $this->sub_categories_ids;
    }

    public function setSubCategoriesIds(?array $sub_categories_ids): self
    {
        $this->sub_categories_ids = $sub_categories_ids;

        return $this;
    }

    public function getIconPrefix(): ?string
    {
        return $this->icon_prefix;
    }

    public function setIconPrefix(string $icon_prefix): self
    {
        $this->icon_prefix = $icon_prefix;

        return $this;
    }

    public function getIconSuffix(): ?string
    {
        return $this->icon_suffix;
    }

    public function setIconSuffix(string $icon_suffix): self
    {
        $this->icon_suffix = $icon_suffix;

        return $this;
    }
}
