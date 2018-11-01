<?php

namespace Home;

/**
 * Description of Application
 *
 * @author Seif
 */
class Application {

    const CONFIG_PATH = __DIR__ . '/../../app/Config';

    /**
     *
     * @var Container
     */
    protected $serviceStore;

    public function run() {
        $this->initServices();
//        $this->initDbConnection();
        $this->initTemplateEngine();

        $response = $this->processRequest($this->getRequestPath());
        $this->printTemplate($response);
    }

    public function initServices() {
        $services = require_once self::CONFIG_PATH . '/services.php';
        $serviceStore = new ServicesStore();
        foreach ($services as $serviceKey => $serviceClassName) {
            $serviceStore[$serviceKey] = new $serviceClassName();
        }
        $this->serviceStore = $serviceStore;
    }

    public function initDbConnection() {
        $configDB = require_once self::CONFIG_PATH . '/db.php';
        $dbConnection = new mysqli(
                $configDB['hostname'], $configDB['user'], $configDB['password'], $configDB['database']
        );
        $this->serviceStore['db_connection'] = $dbConnection;
    }

    public function initConfig() {
        
    }

    public function initTemplateEngine() {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../../src/Bc/Views/');
        $twig = new \Twig_Environment($loader);
        $this->serviceStore['twig'] = $twig;
    }

    public function processRequest() {
        $fc = new FrontController($this->getRequestPath(), new Container($this->serviceStore));
        return $fc->dispatch();
    }

    public function getRequestPath() {
        $publicFolderName = '/public';
        $requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI');
        $requestPath = parse_url($requestUri, PHP_URL_PATH);
        $pos = strpos($requestPath, $publicFolderName);
        $appRequest = substr($requestPath, $pos + strlen($publicFolderName) + 1);
        return explode('/', $appRequest);
    }
    
    public function printTemplate($response)
    {
        echo $response;
    }

}
