<?php
// src/Entity/Stocks.php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\Stores;
use Entity\Products;
use JsonSerializable;
use Repository\StocksRepository;

/**
 * @ORM\Entity(repositoryClass=StocksRepository::class)
 * @ORM\Table(name="stocks")
 */
class Stocks implements JsonSerializable {

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $stock_id;

    /** @var string */
    /**
     * @ORM\ManyToOne(targetEntity=Stores::class, inversedBy="stocks", cascade={"persist"})
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id")
     */
    private Stores $store ;

    /** @var string */
    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="stocks", cascade={"persist"})
     * @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     */
    private Products $product ;

    /** @var int */
    /**
     * @ORM\Column(type="integer")
     */
    private int $quantity;

    /**
     * Get id.
     * 
     * @return int
     */
    public function getStockId(){
        return $this->stock_id;
    }

    /**
     * Get quantity.
     * 
     * @return int
     */
    public function getQuantity(){
        return $this->quantity;
    }

    /**
     * Get store.
     * 
     * @return Stores
     */
    public function getStore(){
        return $this->store;
    }

    /**
     * Get product.
     * 
     * @return Products
     */
    public function getProduct(){
        return $this->product;
    }

    /**
     * Set store.
     * 
     * @param Stores $store
     * 
     * @return Stocks
     */
    public function setStore($store){
        $this->store = $store;
        return $this;
    }

    /**
     * Set product.
     * 
     * @param Products $product
     * 
     * @return Stocks
     */
    public function setProduct($product){
        $this->product = $product;
        return $this;
    }

    /**
     * Set quantity.
     * 
     * @param int $quantity
     * 
     * @return Stocks
     */
    public function setQuantity($quantity){
        $this->quantity = $quantity;
        return $this;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        $tab = [];
            foreach ($this as $key => $value) {
                if ($key == 'store'){
                    $tab[$key] = $value->getStoreName();
                } else if ($key == 'product'){
                    $tab[$key] = $value->getProductName();
                } else {
                    $tab[$key] = $value;
                }
            }
        return $tab;
    }

}