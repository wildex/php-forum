<?php
/**
 * @class services\Service
 */

namespace services;

use core;
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
     *
     * @param $action string action name (class method to call)
     * @throws \core\ForumException
     */
    public function run($action = null) {
        if(!method_exists($this, $action)) {
            throw new core\ForumException(getRegistry()->get('translation')->translate('Not found.'), core\ForumException::ERR_404);
        }
        call_user_func(array($this, $action));
        // return html
        echo $this->_twig->render('', $this->_data);
        // return json data
        echo json_decode($this->_data);
    }
}