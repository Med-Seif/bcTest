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

    public function __construct(array $requestPath, array $requestParams = [], Container $container) {
        $this->setControllerName($requestPath[0]);
        $this->setActionName($requestPath[1]);
        $this->setParams($requestParams);
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
        if (!class_exists($className)) {
            throw new \Bc\Exceptions\ControllerNotFoundException();
        }
        $controllerInstance = new $className;
        if (!method_exists($controllerInstance, $this->getActionName())) {
            throw new \Bc\Exceptions\MethodActionNotFoundException();
        }
        $controllerInstance->setContainer($this->container);
        $controllerInstance->setParams($this->getParams());
        return $controllerInstance;
    }

    public function dispatch() {
        $response = call_user_func_array(
                [
            $this->createConroller(),
            $this->getActionName()
                ], []
        );
        if (!$response) {
            throw new \Bc\Exceptions\MissingControllerActionResponse();
        }
        return $response;
    }

}
