<?php

/* * ********************************************************************
 * Customization Services by ModulesGarden.com
 * Copyright (c) ModulesGarden, INBS Group Brand, All Rights Reserved 
 * (2014-09-09, 08:23:25)
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
class Modulesgarden_ThemeMinimo_Model_System_Config_Source_Select extends Varien_Object {

	protected $_options;
	
	public function toOptionArray() {
		$options = array();
		$pathExplode = explode('/', $this->getPath());
		if (count($pathExplode) != 3)
			return $options;

		list($pathSection, $pathGroup, $pathField) = $pathExplode;

		$section = Mage::getSingleton('adminhtml/config')->getSection($pathSection);
		foreach ($section->groups->children() as $group_id => $group) {
			if ($group_id == $pathGroup) {
				foreach ($group->fields->children() as $field_id => $field) {
					if ($field_id == $pathField) {
						if ($field->options) {
							foreach ($field->options->children() as $option) {
								$options[] = array(
									'value' => $option->value,
									'label' => $option->label,
								);
							}
						}
					}
				}
			}
		}
		$this->_options = $options;
		return $options;
	}

	public function toArray(array $arrAttributes = array()){
		if ($this->_options === null)
			$this->_options = $this->toOptionArray();
		
		$options = array();
		foreach ($this->_options as $op){
			$options[$op['value']] = Mage::helper('adminhtml')->__($op['label']);
		}
		return $options;
	}

}
