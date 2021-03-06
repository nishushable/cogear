<?php
/**
 * Menu 
 *
 * @author		Dmitriy Belyaev <admin@cogear.ru>
 * @copyright		Copyright (c) 2011, Dmitriy Belyaev
 * @license		http://cogear.ru/license.html
 * @link		http://cogear.ru
 * @package		Core
 * @subpackage          
 * @version		$Id$
 */
class Menu extends Stack{
    protected $position = 0;
    public function setActive($uri = NULL){
        if(!sizeof($this)){
            return;
        }
        $cogear = getInstance();
        $uri OR $uri = $cogear->router->getUri();
        $pieces = explode('/',trim($uri,'/'));
        $path = '';
        $root = $this->getIterator()->key();
        while($pieces) {
            $path = implode('/',$pieces);
            if(strpos($uri, $path) !== FALSE){
                if(isset($this->{'/'.$path})){
                    $this->{'/'.$path}->active = TRUE;
                    event('menu.setActive',$this->{'/'.$path});
                    break;
                }
                elseif(isset($this->{'/'.$path.'/'})){
                    $this->{'/'.$path.'/'}->active = TRUE;
                    event('menu.setActive',$this->{'/'.$path.'/'});
                    break;
                }
            }        
            array_pop($pieces);
        }
    }
    /**
     * Magic __set method
     *
     * @param	string
     * @param	mixed
     */
    public function __set($name, $value){
        $element = new Core_ArrayObject();
        $element->value = $value;
        $element->order = $this->position++;
        $this->offsetSet($name, $element);
    }
    /**
     * Render menu
     * 
     * @param string $glue
     * @return string
     */
    public function render($template = ''){
        event('menu.'.$this->name,$this);
        $this->uasort('Core_ArrayObject::sortByOrder');
        $this->setActive();
        $tpl = new Template($template);
        $tpl->menu = $this;
        return $tpl->render();
    }
    
}
