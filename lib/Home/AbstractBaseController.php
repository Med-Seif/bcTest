<?php

namespace Home;

use Bc\Exceptions\MissingRequestedParam;

/**
 * Description of BaseController
 *
 * @author Seif
 */
abstract class AbstractBaseController {

    /**
     *
     * @var Container
     */
    public $container;
    protected $params;

    public function setParams($params) {
        $this->params = $params;
    }

    public function setContainer(Container $container) {
        $this->container = $container;
    }

    public function hasParam($paramName) {
        return array_key_exists($paramName, $this->params);
    }

    public function getParam($paramName) {
        if (!$this->hasParam($paramName)) {
            throw new MissingRequestedParam();
        }
        return $this->params[$paramName];
    }

    public function getParams() {
        return $this->params;
    }

    public function get($id) {
        return $this->container->get($id);
    }

    public function render($templatePath, $vars = []) {
        if (is_null($vars) || !is_array($vars)) {
            $vars = [];
        }
        return $this->container->get('twig')->render($templatePath, $vars);
    }

}
