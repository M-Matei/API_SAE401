<?php
// src/Entity/Brands.php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Entity\Products;
use JsonSerializable;
use Repository\BrandsRepository;

/**
 * @ORM\Entity(repositoryClass=BrandsRepository::class)
 * @ORM\Table(name="brands")
 */
class Brands implements JsonSerializable {

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $brand_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $brand_name;

    /** @var Collection */
    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="brand")
     */
    private Collection $products;

    /**
     * Get id.
     * 
     * @return int
     */
    public function getBrandId(){
        return $this->brand_id;
    }

    /**
     * Get brand_name.
     * 
     * @return string
     */
    public function getBrandName(){
        return $this->brand_name;
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
     * Set brand_name.
     * 
     * @param string $brand_name
     * 
     * @return Brands
     */
    public function setBrandName($brand_name){
        $this->brand_name = $brand_name;
        return $this;
    }

    public function __construct() {
        $this->products = new ArrayCollection();
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return [
            "brand_id" => $this->brand_id,
            "brand_name" => $this->brand_name
        ];
    }

}