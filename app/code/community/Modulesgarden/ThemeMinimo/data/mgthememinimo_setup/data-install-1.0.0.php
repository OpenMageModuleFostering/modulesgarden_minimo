<?php

$storeName = Mage::getStoreConfig('general/store_information/name');
if(!$storeName) { $storeName = "Theme Crystal";}
$storeAddress = Mage::getStoreConfig('general/store_information/address');
if(!$storeAddress) { $storeAddress = "Your Street 22/A, Alaska";}
$storePhone = Mage::getStoreConfig('general/store_information/phone');
if(!$storePhone) { $storePhone = "+48 112 334 567";}
$storeEmail = Mage::getStoreConfig('trans_email/ident_general/email');
if(!$storeEmail) { $storeEmail = "company@my-company.com";}
$storeUrl = Mage::getBaseUrl();

$now = date("Y-m-d H:i:s", Mage::getModel('core/date')->timestamp(time()));
$block1 = Mage::getModel('cms/block')
	->setTitle('Contact Block - Footer')
	->setIdentifier('minimo-footer-col1')
	->setContent("<h2>Contact:</h2>\r\n<ul>\r\n<li>{$storeName}<br />{$storeAddress}</li>\r\n<li>{$storePhone}</li>\r\n<li>{$storeEmail}</li>\r\n</ul>")
	->setCreationTime($now)
	->setUpdateTime($now)
	->setIsActive(1)
	->save();
$block2 = Mage::getModel('cms/block')
	->setTitle('Information Block - Footer')
	->setIdentifier('minimo-footer-col2')
	->setContent("<h2>Information</h2>\r\n<ul>\r\n<li><a title=\"About Us\" href=\"{$storeUrl}about\">About Us</a></li>\r\n<li><a title=\"Contact Us\" href=\"{$storeUrl}contacts\">Contact Us</a></li>\r\n<li><a title=\"Terms  &amp;Conditions\" href=\"{$storeUrl}terms-conditions\">Terms &amp; Conditions</a></li>\r\n<li><a title=\"Privacy Policy\" href=\"{$storeUrl}privacy-policy\">Privacy Policy</a></li>\r\n<li><a title=\"Orders and Returns\" href=\"{$storeUrl}orders-and-returns\">Orders and Returns</a></li>\r\n<li><a title=\"Site Map\" href=\"{$storeUrl}sitemap\">Site Map</a></li>\r\n</ul>")
	->setCreationTime($now)
	->setUpdateTime($now)
	->setIsActive(1)
	->save();
$block3 = Mage::getModel('cms/block')
	->setTitle('Why choose us - Footer')
	->setIdentifier('minimo-footer-col3')
	->setContent("<h2>Why choose us</h2>\r\n<ul>\r\n<li><a title=\"Returns and Exchanges\" href=\"{$storeUrl}returns-and-exchanges\">Returns and Exchanges</a></li>\r\n<li><a title=\"Shipping Options\" href=\"{$storeUrl}shipping-options\">Shipping Options</a></li>\r\n<li><a title=\"Help &amp; FAQs\" href=\"{$storeUrl}faq\">Help &amp; FAQs</a></li>\r\n</ul>")
	->setCreationTime($now)
	->setUpdateTime($now)
	->setIsActive(1)
	->save();
$block4 = Mage::getModel('cms/block')
	->setTitle('My Account Block - Footer')
	->setIdentifier('minimo-footer-col4')
	->setContent("<h2>My Account</h2>\r\n<ul>\r\n<li><a title=\"Sign In\" href=\"{$storeUrl}customer/account/login/\">Sign In</a></li>\r\n<li><a title=\"View Cart\" href=\"{$storeUrl}checkout/cart/\">View Cart</a></li>\r\n<li><a title=\"My Wishlist\" href=\"{$storeUrl}wishlist/\">My Wishlist</a></li>\r\n<li><a title=\"Checkout\" href=\"{$storeUrl}checkout/onepage/\">Check out</a></li>\r\n<li><a title=\"Help\" href=\"{$storeUrl}help\">Help</a></li>\r\n</ul>")
	->setCreationTime($now)
	->setUpdateTime($now)
	->setIsActive(1)
	->save();
$block5 = Mage::getModel('cms/block')
	->setTitle('Minimo baner 1')
	->setIdentifier('minimo-baner-1')
	->setContent('<img src="{{skin url="images/slider/baner1.png"}}" alt="" />')
	->setCreationTime($now)
	->setUpdateTime($now)
	->setIsActive(1)
	->save();
$block6 = Mage::getModel('cms/block')
	->setTitle('Minimo baner 2')
	->setIdentifier('minimo-baner-2')
	->setContent('<img src="{{skin url="images/slider/baner2.png"}}" alt="" />')
	->setCreationTime($now)
	->setUpdateTime($now)
	->setIsActive(1)
	->save();
$block7 = Mage::getModel('cms/block')
	->setTitle('Minimo baner 3')
	->setIdentifier('minimo-baner-3')
	->setContent('<img src="{{skin url="images/slider/baner3.png"}}" alt="" />')
	->setCreationTime($now)
	->setUpdateTime($now)
	->setIsActive(1)
	->save();

$installer = $this;
$installer->startSetup();

foreach (array($block1->getId(), $block2->getId(), $block3->getId(), $block4->getId(), $block5->getId(), $block6->getId(), $block7->getId()) as $block_id){
	$installer->run("INSERT INTO ".Mage::getSingleton('core/resource')->getTableName('cms_block_store')." (block_id, store_id) VALUES ({$block_id}, 0)");
}
	
$installer->run("
INSERT INTO `".Mage::getSingleton('core/resource')->getTableName('cms_page')."` (`page_id`, `title`, `root_template`, `meta_keywords`, `meta_description`, `identifier`, `content_heading`, `content`, `creation_time`, `update_time`, `is_active`, `sort_order`, `layout_update_xml`, `custom_theme`, `custom_root_template`, `custom_layout_update_xml`, `custom_theme_from`, `custom_theme_to`) VALUES
(NULL, 'Home page', 'one_column', NULL, NULL, 'home', NULL, '<h2>Welcome to our website</h2>\r\n<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Curabitur id est et sem facilisis tincidunt. In blandit elementum hendrerit. Donec efficitur sodales tincidunt. Etiam ac est dignissim, ornare magna ut, mattis magna. Nulla eu maximus tortor, non vehicula purus. Nullam ullamcorper vitae quam eu consequat.</p>\r\n<p>Aliquam tempus urna ipsum, quis dictum neque fermentum id. Etiam facilisis malesuada euismod. Sed in velit vulputate, volutpat nibh ut, faucibus nisi. Nam eget imperdiet ante. Quisque sit amet faucibus velit, id ornare ante. Cras eget metus lorem. Sed elit elit, imperdiet a mattis eget, tincidunt interdum turpis.</p>\r\n', '2007-08-23 10:03:25', '2014-11-06 15:13:54', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL);
");

$installer->endSetup();