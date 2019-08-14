<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-10-06, 11:20:48)
 * 
 *
 *  CREATED BY MODULESGARDEN       ->        http://modulesgarden.com
 *  CONTACT                        ->       contact@modulesgarden.com
 *
 *
 *
 *
 * This software is furnished under a license and may be used and copied
 * only  in  accordance  with  the  terms  of such  license and with the
 * inclusion of the above copyright notice.  This software  or any other
 * copies thereof may not be provided or otherwise made available to any
 * other person.  No title to and  ownership of the  software is  hereby
 * transferred.
 *
 *
 * ******************************************************************** */

/**
 * @author Grzegorz Draganik <grzegorz@modulesgarden.com>
 */

$installer = $this;
$installer->startSetup();

$attrs = array(
	array(
		'code' => 'mg_is_featured',
		'type' => 'int',
		'label' => 'Is Featured?',
		'note' => 'Attribute For ModulesGarden Themes',
		'group' => 'General',
	),
	array(
		'code' => 'mg_is_new',
		'type' => 'int',
		'label' => 'Is New?',
		'note' => 'Attribute For ModulesGarden Themes',
		'group' => 'General',
	)
);

$objCatalogEavSetup = Mage::getResourceModel('catalog/eav_mysql4_setup', 'core_setup');
foreach ($attrs as $attr){
	$attrIdTest = $objCatalogEavSetup->getAttributeId(Mage_Catalog_Model_Product::ENTITY, $attr['code']);

	if ($attrIdTest === false) {
		$objCatalogEavSetup->addAttribute(Mage_Catalog_Model_Product::ENTITY, $attr['code'], array(
			'group' => $attr['group'],
			'sort_order' => 7,
			'type' => $attr['type'],
            'backend' => '',
            'frontend' => '',
			'label' => $attr['label'],
			'note' => $attr['note'],
            'input' => 'boolean',
            'source' => 'eav/entity_attribute_source_table',
			'class' => '',
			'source' => '',
			'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
			'visible' => true,
			'required' => false,
			'user_defined' => true,
			'default' => '0',
			'visible_on_front' => false,
			'unique' => false,
			'is_configurable' => false,
			'used_for_promo_rules' => false
		));
	}
}

$installer->endSetup();
