<?php

namespace Home;

/**
 * Description of FrontController
 *
 * @author Seif
 */
class FrontController {

    protected $controllerName;
    protected $actionName;
    protected $params;
    protected $container;

    public function __construct($requestPath, $container) {

        $this->setControllerName($requestPath[0]);
        $this->setActionName($requestPath[1]);
        $this->setParams($requestPath[2]);
        $this->container = $container;
    }

    public function setControllerName($controllerName) {
        if (!$controllerName) {
            $controllerName = 'index';
        }
        $this->controllerName = '\Bc\Controllers\\' . ucfirst($controllerName) . 'Controller';
    }

    public function setActionName($actionName) {
        if (!$actionName) {
            $actionName = 'index';
        }
        $this->actionName = $actionName . 'Action';
    }

    public function getParams() {
        return $this->params;
    }

    public function setParams($params) {
        $this->params = $params;
    }

    public function getControllerName() {
        return $this->controllerName;
    }

    public function getActionName() {
        return $this->actionName;
    }

    public function createConroller() {
        $className = $this->getControllerName();
        $controllerInstance = new $className;
        $controllerInstance->setContainer($this->container);
        return $controllerInstance;
    }

    public function dispatch() {

        return call_user_func_array(
                [
            $this->createConroller(),
            $this->getActionName()
                ], [
            $this->getParams()
                ]
        );
    }

}
