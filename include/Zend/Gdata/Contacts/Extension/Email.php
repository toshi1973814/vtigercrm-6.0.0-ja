<?php

/**
 * https://github.com/prasad83/Zend-Gdata-Contacts
 * @author prasad
 * 
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Contacts
 */
require_once 'Zend/Gdata/Contacts/Extension.php';

class Zend_Gdata_Contacts_Extension_Email extends Zend_Gdata_Contacts_Extension {
	protected $_rootElement = 'email';
	protected $_valueAttrName = 'address';
	
	protected $_isprimary = false;
	protected $_rel;
	
	public function __construct($value = null, $rel = 'work') {
        parent::__construct($value);
		$this->_rel = $rel;
	}
	
	public function getDOM($doc = null, $majorVersion = 1, $minorVersion = null) {
		$element = parent::getDOM($doc, $majorVersion, $minorVersion);
		$element->setAttribute("rel", $this->lookupNamespace("gd").'#'.$this->_rel);
		$element->setAttribute($this->_valueAttrName, $this->getValue());
		return $element;
	}

	protected function takeAttributeFromDOM($attribute) {
        switch ($attribute->localName) {
        case 'primary':
            $this->_isprimary = strcasecmp("true", $attribute->nodeValue);
            break;
        default:
            parent::takeAttributeFromDOM($attribute);
        }
    }
}