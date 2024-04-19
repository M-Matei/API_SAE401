<?php
// src/Repository/EmployeesRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetmapping;
use Entity\Employees;
use Entity\Stores;
use Doctrine\ORM\EntityManagerInterface;


class EmployeesRepository extends EntityRepository {

    public function getAllWithSort($column, $order){
        return $this->findBy(array(), array($column => $order));
    }

    public function getEmployeeDetail($id, $detail){
        $employee = $this->find($id);
        switch($detail){
            case "store":
                return $employee->getStore()->getStoreName();
                break;
            case "employee_name":
                return $employee->getEmployeeName();
                break;
            case "employee_email":
                return $employee->getEmployeeEmail();
                break;
            case "employee_password":
                return $employee->getEmployeePassword();
                break;
            case "employee_role":
                return $employee->getEmployeeRole();
                break;
        }
    }

    public function update(EntityManagerInterface $entityManager, $name, $email, $mdp, $emp){
        $emp->setEmployeeName($name);
        $emp->setEmployeeEmail($email);
        $emp->setEmployeePassword($mdp);
        $entityManager->persist($emp);
        $entityManager->flush();
        $verif = $this->findBy(["employee_name"=>$name]);
        if(!empty($verif)) {
            return array("status" => 1,"status_message" =>'Successful request, modification done.');
        } else {  
            return array("status" => 0,"status_message" =>'Failed request');
        }
    }

 }


?>