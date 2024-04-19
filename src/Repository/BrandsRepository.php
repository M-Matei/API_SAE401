<?php
// src/Repository/BrandsRepository.php
namespace Repository;

require_once __DIR__.'/../../bootstrap.php';

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetmapping;
use Entity\Brands;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Repository\BrandsRepository;
use Doctrine\ORM\EntityManagerInterface;

class BrandsRepository extends EntityRepository {

    public function getAllWithSort($column, $order){
        return $this->findBy(array(), array($column => $order));
    }

    public function getBrandDetail($id){
        $brand = $this->find($id);
        return $brand->getBrandName();
    }

    public function create(EntityManagerInterface $entityManager, $name){
        $myBrandsRepository = $entityManager->getRepository(Brands::Class);
        $brand = new Brands();
        $brand->setBrandName($name);
        $entityManager->persist($brand);
        $entityManager->flush();
        $verif = $this->findBy(["brand_name"=>$name]);
        if(!empty($verif)) {
            return array("status" => 1,"status_message" =>'Successful request, creation done.');
        } else {  
            return array("status" => 0,"status_message" =>'Failed request');
        }
    }

    public function update(EntityManagerInterface $entityManager, $name, $brand){
        $brand->setBrandName($name);
        $entityManager->persist($brand);
        $entityManager->flush();
        $verif = $this->findBy(["brand_name"=>$name]);
        if(!empty($verif)) {
            return array("status" => 1,"status_message" =>'Successful request, modification done.');
        } else {  
            return array("status" => 0,"status_message" =>'Failed request');
        }
    }

}

?>