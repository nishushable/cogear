<?php
/**
 *  Errors gear
 *
 * @author		Dmitriy Belyaev <admin@cogear.ru>
 * @copyright		Copyright (c) 2011, Dmitriy Belyaev
 * @license		http://cogear.ru/license.html
 * @link		http://cogear.ru
 * @package		Core
 * @subpackage
 * @version		$Id$
 */
class Errors_Gear extends Gear {
    protected $name = 'Errors gear';
    protected $description = 'Handle errors';
    protected $order =  1;
    /**
     * Init
     */
    public function init(){
        $cogear = getInstance();
        $cogear->errors = $this;
        parent::init();
    }
    /**
     * Show error
     * @param string $text
     * @param string $title 
     */
    public function show($text,$title = ''){
        error($text,$title = '');
    }
    public function _404(){
        $this->request();
        $cogear = getInstance();
        $cogear->response->header('Status', '404 '. Response::$codes[404]);
        error(t('Page you are looking for was not found on the server.'),t('Page not found'));
    }
}

function _404(){
    $cogear = getInstance();
    $cogear->router->exec(array($cogear->errors,'_404'));
}