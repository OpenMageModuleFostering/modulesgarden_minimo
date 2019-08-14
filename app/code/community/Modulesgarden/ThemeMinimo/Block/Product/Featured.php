<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved
 * (2014-10-31, 13:42:58)
 *
 *
 * CREATED BY MODULESGARDEN -> http://modulesgarden.com
 * CONTACT -> contact@modulesgarden.com
 *
 *
 *
 *
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the
 * inclusion of the above copyright notice. This software or any other
 * copies thereof may not be provided or otherwise made available to any
 * other person. No title to and ownership of the software is hereby
 * transferred.
 *
 *
 * ******************************************************************** */

/**
 * @author Grzegorz Draganik <grzegorz@modulesgarden.com>
 */
class Modulesgarden_ThemeMinimo_Block_Product_Featured extends Mage_Catalog_Block_Product_Abstract {

    
public function getProducts() {
        $visibility     = array(
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
            Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG,
        );
        
        $storeId = Mage::app()->getStore()->getId();
        
        $products = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToFilter('mg_is_featured', array('eq' => 1))
                ->addAttributeToSelect(array('name', 'price', 'small_image', 'mg_is_new'))
                ->setStoreId($storeId)
                ->addStoreFilter($storeId)
                ->addAttributeToFilter('status', array('eq' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED))
                ->addAttributeToFilter('visibility' , array('in' => $visibility))
                ->setPageSize(10);
        
        Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($products);
        
        return $products;
    }

}
