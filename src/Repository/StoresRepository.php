<?php
// src/Repository/StoresRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetmapping;
use Entity\Stores;
use Doctrine\ORM\EntityManagerInterface;

class StoresRepository extends EntityRepository {

    public function getAllWithSort($column, $order){
        return $this->findBy(array(), array($column => $order));
    }

    public function getStoreDetail($id, $detail){
        $store = $this->find($id);
        switch($detail){
            case "store_name":
                return $store->getStoreName();
                break;
            case "phone":
                return $store->getPhone();
                break;
            case "email":
                return $store->getEmail();
                break;
            case "street":
                return $store->getStreet();
                break;
            case "city":
                return $store->getCity();
                break;
            case "state":
                return $store->getState();
                break;
            case "zip_code":
                return $store->getZipCode();
                break;
        }
    }

    public function create(EntityManagerInterface $entityManager, $name, $phone, $email, $street, $city, $state, $zip_code){
        $myStoresRepository = $entityManager->getRepository(Stores::Class);
        $store = new Stores();
        $store->setStoreName($name);
        $store->setPhone($phone);
        $store->setEmail($email);
        $store->setStreet($street);
        $store->setCity($city);
        $store->setState($state);
        $store->setZipCode($zip_code);
        $entityManager->persist($store);
        $entityManager->flush();
        $verif = $this->findBy(["store_name"=>$name]);
        if(!empty($verif)) {
            return array("status" => 1,"status_message" =>'Successful request, creation done.');
        } else {  
            return array("status" => 0,"status_message" =>'Failed request');
        }
    }

    public function update(EntityManagerInterface $entityManager, $name, $phone, $email, $street, $city, $state, $zip_code,$store){
        $store->setStoreName($name);
        $store->setPhone($phone);
        $store->setEmail($email);
        $store->setStreet($street);
        $store->setCity($city);
        $store->setState($state);
        $store->setZipCode($zip_code);
        $entityManager->persist($store);
        $entityManager->flush();
        $verif = $this->findBy(["store_name"=>$name]);
        if(!empty($verif)) {
            return array("status" => 1,"status_message" =>'Successful request, modification done.');
        } else {  
            return array("status" => 0,"status_message" =>'Failed request');
        }
    }

}

?>