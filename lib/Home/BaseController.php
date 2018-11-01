<?php

namespace Home;

/**
 * Description of BaseController
 *
 * @author Seif
 */
class BaseController {

    /**
     *
     * @var Container
     */
    public $container;

    public function setContainer(Container $container) {
        $this->container = $container;
    }

    public function getFromQuery($paramName) {
        
    }

    public function get($id) {
        return $this->container->get($id);
    }

    public function render($templatePath, $vars) {
        return $this->container->get('twig')->render($templatePath, $vars);
    }

}
