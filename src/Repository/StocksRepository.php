<?php
// src/Repository/StocksRepository.php
namespace Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetmapping;
use Entity\Stocks;
use Entity\Products;
use Entity\Stores;

class StocksRepository extends EntityRepository {

    public function getAllWithSort($column, $order){
        return $this->findBy(array(), array($column => $order));
    }

    public function getStockDetail($id,$detail){
        $stock = $this->find($id);
        switch($detail){
            case "store_name":
                return $stock->getStore()->getStoreName();
                break;
            case "product_name":
                return $stock->getProduct()->getProductName();
                break;
            case "quantity":
                return $stock->getQuantity();
                break;
        }
    }
}

?>