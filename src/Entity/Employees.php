<?php
// src/Entity/Employees.php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Entity\Stores;
use JsonSerializable;
use Repository\EmployeesRepository;

/**
 * @ORM\Entity(repositoryClass=EmployeesRepository::class)
 * @ORM\Table(name="employees")
 */
class Employees implements JsonSerializable {

    /** @var int */
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $employee_id;

    /** @var string */
    /**
     * @ORM\ManyToOne(targetEntity=Stores::class, inversedBy="employees", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id")
     */
    private Stores $store;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $employee_name;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $employee_email;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $employee_password;

    /** @var string */
    /**
     * @ORM\Column(type="string")
     */
    private string $employee_role;

    /**
     * Get id.
     * 
     * @return int
     */
    public function getEmployeeId(){
        return $this->employee_id;
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
     * Get employee_name.
     * 
     * @return string
     */
    public function getEmployeeName(){
        return $this->employee_name;
    }

    /**
     * Get employee_email.
     * 
     * @return string
     */
    public function getEmployeeEmail(){
        return $this->employee_email;
    }

    /**
     * Get employee_password.
     * 
     * @return string
     */
    public function getEmployeePassword(){
        return $this->employee_password;
    }

    /**
     * Get employee_role.
     * 
     * @return string
     */
    public function getEmployeeRole(){
        return $this->employee_role;
    }

    /**
     * Set employee_name.
     * 
     * @param string $employee_name
     * 
     * @return Employees
     */
    public function setEmployeeName($employee_name){
        $this->employee_name = $employee_name;
        return $this;
    }

    /**
     * Set store.
     * 
     * @param Stores $store
     * 
     * @return Employees
     */
    public function setStore($store){
        $this->store = $store;
        return $this;
    }

    /**
     * Set employee_email.
     * 
     * @param string $employee_email
     * 
     * @return Employees
     */
    public function setEmployeeEmail($employee_email){
        $this->employee_email = $employee_email;
        return $this;
    }

    /**
     * Set employee_password.
     * 
     * @param string $employee_password
     * 
     * @return Employees
     */
    public function setEmployeePassword($employee_password){
        $this->employee_password = $employee_password;
        return $this;
    }

    /**
     * Set employee_role.
     * 
     * @param string $employee_role
     * 
     * @return Employees
     */
    public function setEmployeeRole($employee_role){
        $this->employee_role = $employee_role;
        return $this;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        $tab = [];
            foreach ($this as $key => $value) {
                if ($key == 'store'){
                    $tab[$key] = $value->getStoreName();
                } else {
                    $tab[$key] = $value;
                }
            }
        return $tab;
    }

}