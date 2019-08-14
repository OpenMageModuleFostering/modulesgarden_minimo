<?php
class Modulesgarden_ThemeMinimo_Block_Product_Bestseller extends Mage_Catalog_Block_Product_Abstract{
    
    public function __construct() {
        parent::__construct();
        
        $visibility     = array(
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG,
        );
        
        $storeId = Mage::app()->getStore()->getId();
        $products = Mage::getResourceModel('reports/product_collection')
                ->addOrderedQty()
                ->addAttributeToSelect(array('name', 'price', 'small_image', 'mg_is_new'))
                ->setStoreId($storeId)
                ->addStoreFilter($storeId)
                ->addAttributeToFilter('status', array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED))
                ->addAttributeToFilter('visibility' , array('in' => $visibility))
                ->setOrder('ordered_qty', 'desc'); // most best sellers on top
        
        Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($products);

        $products->setPageSize(3)->setCurPage(1);
        $this->setProductCollection($products);
    }
}
?>