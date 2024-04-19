<?php
// src/Entity/Categories.php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Entity\Products;
use JsonSerializable;
use Repository\CategoriesRepository;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 * @ORM\Table(name="categories")
 */
class Categories implements JsonSerializable {

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $category_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $category_name;

    /** @var Collection */
    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="category")
     */
    private Collection $products;

    /**
     * Get id.
     * 
     * @return int
     */
    public function getCategoryId(){
        return $this->category_id;
    }

    /**
     * Get category_name.
     * 
     * @return string
     */
    public function getCategoryName(){
        return $this->category_name;
    }

    /**
     * Get products.
     * 
     * @return Collection
     */
    public function getProducts() {
        return $this->products;
    }

    /**
     * Set category_name.
     * 
     * @param string $category_name
     * 
     * @return Categories
     */
    public function setCategoryName($category_name){
        $this->category_name = $category_name;
        return $this;
    }

    public function __construct() {
        $this->products = new ArrayCollection();
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return [
            "category_id" => $this->category_id,
            "category_name" => $this->category_name
        ];
    }

}