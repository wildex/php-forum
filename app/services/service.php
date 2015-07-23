<?php
/**
 * @class services\Service
 */

namespace services;

use Twig_Environment, Twig_Loader_Filesystem;

abstract class Service {

    protected $_model;
    protected $_twig;
    protected $_data;

    public function __construct() {
        $twig_loader = new Twig_Loader_Filesystem(TEMPLATE_DIR);
        $this->_twig = new Twig_Environment($twig_loader, array(
            'cache' => TEMPLATE_CACHE_DIR,
        ));
    }

    /**
     * Return html page, or just json data.
     */
    public function run($action = null) {
        var_dump($action);die;
        // return html
        echo $this->_twig->render('', $this->_data);
        // return json data
        echo json_decode($this->_data);
    }
}