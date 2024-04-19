<?php
// src/Entity/Stores.php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Entity\Employees;
use Entity\Stocks;
use JsonSerializable;
use Repository\StoresRepository;

/**
 * @ORM\Entity(repositoryClass=StoresRepository::class)
 * @ORM\Table(name="stores")
 */
class Stores implements JsonSerializable {

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $store_id;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $store_name;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $phone;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $email;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $street;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $city;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $state;

    /** @var int */
    /**
     * @ORM\Column(type="integer")
     */
    private int $zip_code;

    /** @var Collection */
    /**
     * @ORM\OneToMany(targetEntity=Employees::class, mappedBy="store")
     */
    private Collection $employees;

    /** @var Collection */
    /**
     * @ORM\OneToMany(targetEntity=Stocks::class, mappedBy="store")
     */
    private Collection $stocks;

    /**
     * Get id.
     * 
     * @return int
     */
    public function getStoreId(){
        return $this->stock_id;
    }

    /**
     * Get store_name.
     * 
     * @return string
     */
    public function getStoreName(){
        return $this->store_name;
    }

    /**
     * Get phone.
     * 
     * @return string
     */
    public function getPhone(){
        return $this->phone;
    }

    /**
     * Get email.
     * 
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * Get street.
     * 
     * @return string
     */
    public function getStreet(){
        return $this->street;
    }

    /**
     * Get city.
     * 
     * @return string
     */
    public function getCity(){
        return $this->city;
    }

    /**
     * Get state.
     * 
     * @return string
     */
    public function getState(){
        return $this->state;
    }

    /**
     * Get zip_code.
     * 
     * @return int
     */
    public function getZipCode(){
        return $this->zip_code;
    }

    /**
     * Get employees.
     * 
     * @return Collection
     */
    public function getEmployees() {
        return $this->employees;
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
     * Set store_id.
     * 
     * @param int $store_id
     * 
     * @return Stores
     */
    public function setStoreId($store_id) {
        $this->store_id = $store_id;
        return $this;
    }

    /**
     * Set store_name.
     * 
     * @param string $store_name
     * 
     * @return Stores
     */
    public function setStoreName($store_name){
        $this->store_name = $store_name;
        return $this;
    }

    /**
     * Set phone.
     * 
     * @param string $phone
     * 
     * @return Stores
     */
    public function setPhone($phone){
        $this->phone = $phone;
        return $this;
    }

    /**
     * Set email.
     * 
     * @param string $email
     * 
     * @return Stores
     */
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    /**
     * Set street.
     * 
     * @param string $street
     * 
     * @return Stores
     */
    public function setStreet($street){
        $this->street = $street;
        return $this;
    }

    /**
     * Set city.
     * 
     * @param string $city
     * 
     * @return Stores
     */
    public function setCity($city){
        $this->city = $city;
        return $this;
    }

    /**
     * Set state.
     * 
     * @param string $state
     * 
     * @return Stores
     */
    public function setState($state){
        $this->state = $state;
        return $this;
    }

    /**
     * Set zip_code.
     * 
     * @param int $zip_code
     * 
     * @return Stores
     */
    public function setZipCode($zip_code){
        $this->zip_code = $zip_code;
        return $this;
    }

    public function __construct() {
        $this->employees = new ArrayCollection();
        $this->stocks = new ArrayCollection();
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        return [
            "store_id" => $this->store_id,
            "store_name" => $this->store_name,
            "phone" => $this->phone,
            "email" => $this->email,
            "street" => $this->street,
            "city" => $this->city,
            "state" => $this->state,
            "zip_code" => $this->zip_code
        ];
    }

}