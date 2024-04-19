<?php
// src/Entity/Products.php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Entity\Stocks;
use Entity\Brands;
use Entity\Categories;
use JsonSerializable;
use Repository\ProductsRepository;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 * @ORM\Table(name="products")
 */
class Products implements JsonSerializable {

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $product_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $product_name;

    /** @var string */
    /**
     * @ORM\ManyToOne(targetEntity=Brands::class, inversedBy="products", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="brand_id")
     */
    private Brands $brand;

    /** @var string */
    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="products", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
     */
    private Categories $category;

    /** @var int */
    /**
     * @ORM\Column(type="integer")
     */
    private int $model_year;

    /** @var int */
    /**
     * @ORM\Column(type="integer")
     */
    private int $list_price;

    /** @var Collection */
    /**
     * @ORM\OneToMany(targetEntity=Stocks::class, mappedBy="product")
     */
    private Collection $stocks;

    /**
     * Get id.
     * 
     * @return int
     */
    public function getProductId(){
        return $this->product_id;
    }

    /**
     * Get product_name.
     * 
     * @return string
     */
    public function getProductName(){
        return $this->product_name;
    }

    /**
     * Get list_price.
     * 
     * @return int
     */
    public function getListPrice(){
        return $this->list_price;
    }

    /**
     * Get model_year.
     * 
     * @return int
     */
    public function getModelYear(){
        return $this->model_year;
    }

    /**
     * Get stocks.
     * 
     * @return Collection
     */
    public function getStocks() {
        return $this->stocks;
    }

    /**
     * Get brand.
     * 
     * @return Brands
     */
    public function getBrand(){
        return $this->brand;
    }

    /**
     * Get category.
     * 
     * @return Categories
     */
    public function getCategory(){
        return $this->category;
    }

    /**
     * Set model_year.
     * 
     * @param int $model_year
     * 
     * @return Products
     */
    public function setModelYear($model_year){
        $this->model_year = $model_year;
        return $this;
    }

    /**
     * Set product_name.
     * 
     * @param string $product_name
     * 
     * @return Products
     */
    public function setProductName($product_name){
        $this->product_name = $product_name;
        return $this;
    }

    /**
     * Set list_price.
     * 
     * @param int $list_price
     * 
     * @return Products
     */
    public function setListPrice($list_price){
        $this->list_price = $list_price;
        return $this;
    }

    /**
     * Set brand.
     * 
     * @param Brands $brand
     * 
     * @return Products
     */
    public function setBrand($brand){
        $this->brand = $brand;
        return $this;
    }

    /**
     * Set category.
     * 
     * @param Categories $category
     * 
     * @return Products
     */
    public function setCategory($category){
        $this->category = $category;
        return $this;
    }

    public function __construct() {
        $this->stocks = new ArrayCollection();
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return [
            "product_id" => $this->product_id,
            "product_name" => $this->product_name,
            "brand" => $this->brand->getBrandName(),
            "category" => $this->category->getCategoryName(),
            "model_year" => $this->model_year,
            "list_price" => $this->list_price
        ];
    }

}