<?php
// src/Repository/ProductsRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetmapping;
use Entity\Products;
use Entity\Brands;
use Entity\Categories;

class ProductsRepository extends EntityRepository {

    public function getAllWithSort($column, $order){
        return $this->findBy(array(), array($column => $order));
    }

    public function getProductDetail($id,$detail){
        $product = $this->find($id);
        switch($detail){
            case "product_name":
                return $product->getProductName();
                break;
            case "brand":
                return $product->getBrand()->getBrandName();
                break;
            case "category":
                return $product->getCategory()->getCategoryName();
                break;
            case "model_year":
                return $product->getModelYear();
                break;
            case "list_price":
                return $product->getListPrice();
                break;
        }
    }

    public function findBetweenPrices($min, $max){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('u')
                     ->from(Products::Class, 'u')
                     ->where($queryBuilder->expr()->between('u.list_price',$min, $max));
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

    public function customFindBy($brand, $category, $year, $min, $max){
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('u')
                     ->from(Products::Class, 'u')
                     ->where('u.brand = :brand')
                     ->andWhere('u.category = :category')
                     ->andWhere('u.model_year = :year')
                     ->andWhere($queryBuilder->expr()->between('u.list_price',$min, $max))
                     ->setParameter('brand', $brand)
                     ->setParameter('category', $category)
                     ->setParameter('year', $year);
        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }
}

?>