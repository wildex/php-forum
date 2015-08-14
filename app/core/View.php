<?php
/**
 * @class \core\View
 */

namespace core;

use Twig_Environment, Twig_Loader_Filesystem;

class View {
    private $_twig;
    private $_template = '';

    const TPL_FILE_EXTENSION = 'html';

    public function __construct() {
        $twig_loader = new Twig_Loader_Filesystem(TEMPLATE_DIR);
        $this->_twig = new Twig_Environment($twig_loader, array(
            'cache' => false,
        ));
    }

    /**
     * Set template filename, relative to TEMPLATE_DIR
     * @param $template
     */
    public function setTemplate($template) {
        $this->_template = $template;
    }

    public function render($data) {
        return $this->_twig->render($this->_template, $data);
    }
}