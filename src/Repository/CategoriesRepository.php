<?php
// src/Repository/CategoriesRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetmapping;
use Entity\Categories;
use Doctrine\ORM\EntityManagerInterface;

class CategoriesRepository extends EntityRepository {

    public function getAllWithSort($column, $order){
        return $this->findBy(array(), array($column => $order));
    }

    public function getCategoryDetail($id){
        $category = $this->find($id);
        return $category->getCategoryName();
    }

    public function create(EntityManagerInterface $entityManager, $name){
        $myCategoriesRepository = $entityManager->getRepository(Categories::Class);
        $category = new Categories();
        $category->setCategoryName($name);
        $entityManager->persist($category);
        $entityManager->flush();
        $verif = $this->findBy(["category_name"=>$name]);
        if(!empty($verif)) {
            return array("status" => 1,"status_message" =>'Successful request, creation done.');
        } else {  
            return array("status" => 0,"status_message" =>'Failed request');
        }
    }

    public function update(EntityManagerInterface $entityManager, $name, $category){
        $category->setCategoryName($name);
        $entityManager->persist($category);
        $entityManager->flush();
        $verif = $this->findBy(["category_name"=>$name]);
        if(!empty($verif)) {
            return array("status" => 1,"status_message" =>'Successful request, modification done.');
        } else {  
            return array("status" => 0,"status_message" =>'Failed request');
        }
    }

}

?>