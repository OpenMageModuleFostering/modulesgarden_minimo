<?php

/**
 * Html page block
 *
 * @category Mage
 * @package Mage_Page
 * @author Magento Core Team <core@magentocommerce.com>
 */
class Modulesgarden_ThemeMinimo_Block_Html_Breadcrumbs extends Mage_Core_Block_Template {

    /**
     * Array of breadcrumbs
     *
     * array(
     * [$index] => array(
     * ['label']
     * ['title']
     * ['link']
     * ['first']
     * ['last']
     * )
     * )
     *
     * @var array
     */
    protected $_crumbs = null;

    /**
     * Cache key info
     *
     * @var null|array
     */
    protected $_cacheKeyInfo = null;
    protected $_title = null;

    public function __construct() {
        parent::__construct();
        $this->setTemplate('page/html/breadcrumbs.phtml');
        $this->addCrumb('home', array(
            'label' => Mage::helper('catalog')->__('Home'),
            'title' => Mage::helper('catalog')->__('Go to Home Page'),
            'link' => Mage::getBaseUrl()
        ));
        $this->_title = array();
        $path = Mage::helper('catalog')->getBreadcrumbPath();
        foreach ($path as $name => $breadcrumb) {
            $this->addCrumb($name, $breadcrumb);
            $this->_title[] = $breadcrumb['label'];
        }
    }

    protected function _prepareLayout() {
        if ($headBlock = $this->getLayout()->getBlock('head')) {
            $headBlock->setTitle(join($this->getTitleSeparator(), array_reverse($this->_title)));
        }
        return parent::_prepareLayout();
    }

    public function addCrumb($crumbName, $crumbInfo, $after = false) {
        $this->_prepareArray($crumbInfo, array('label', 'title', 'link', 'first', 'last', 'readonly'));
        if ((!isset($this->_crumbs[$crumbName])) || (!$this->_crumbs[$crumbName]['readonly'])) {
            $this->_crumbs[$crumbName] = $crumbInfo;
        }
        return $this;
    }

    /**
     * Get cache key informative items
     *
     * @return array
     */
    public function getCacheKeyInfo() {
        if (null === $this->_cacheKeyInfo) {
            $this->_cacheKeyInfo = parent::getCacheKeyInfo() + array(
                'crumbs' => base64_encode(serialize($this->_crumbs)),
                'name' => $this->getNameInLayout(),
            );
        }
        return $this->_cacheKeyInfo;
    }

    protected function _toHtml() {
        if (is_array($this->_crumbs)) {
            reset($this->_crumbs);
            $this->_crumbs[key($this->_crumbs)]['first'] = true;
            end($this->_crumbs);
            $this->_crumbs[key($this->_crumbs)]['last'] = true;
        }
        $this->assign('crumbs', $this->_crumbs);
        return parent::_toHtml();
    }

    public function getTitleSeparator($store = null) {
        $separator = (string) Mage::getStoreConfig('catalog/seo/title_separator', $store);
        return ' ' . $separator . ' ';
    }

}
