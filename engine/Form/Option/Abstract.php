<?php
/**
 * Form option abstract
 *
 * @author		Dmitriy Belyaev <admin@cogear.ru>
 * @copyright		Copyright (c) 2011, Dmitriy Belyaev
 * @license		http://cogear.ru/license.html
 * @link		http://cogear.ru
 * @package		Core
 * @subpackage
 * @version		$Id$
 */
class Form_Option_Abstract {
    protected $element;
    /**
     * Set element
     *
     * @param Form_Element_Abstract $element
     */
    public function setElement(Form_Element_Abstract $element) {
        $this->element = $element;
    }
}