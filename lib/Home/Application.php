<?php

namespace Home;

use Exception;
use Twig\Extension\DebugExtension;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Description of Application
 *
 * @author Seif
 */
class Application {

    const CONFIG_PATH = __DIR__ . '/../../app/Config';
    const TWIG_TEMPLATE_PATH = __DIR__ . '/../../src/Bc/Views/';
    const PUBLIC_WEB_ROOT = '/public';

    /**
     *
     * @var Container
     */
    protected $serviceStore;

    public function run() {
        try {
            $this->initServices();
            $this->initDbConnection();
            $this->initTemplateEngine();
            $this->printTemplate(
                    $this->processRequest()
            );
        } catch (Exception $e) {
            echo get_class($e);
        }
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
        $this->serviceStore['db_connection'] = DbMysqliAdapter::createConnection($configDB);
    }

    public function initTemplateEngine() {
        $loader = new Twig_Loader_Filesystem(self::TWIG_TEMPLATE_PATH);
        $twig = new Twig_Environment($loader, ['debug' => true]);
        $twig->addExtension(new DebugExtension());
        $this->serviceStore['twig'] = $twig;
    }

    public function getRequestParams() {
        return array_merge(
                filter_input_array(INPUT_GET) ?? [], filter_input_array(INPUT_POST) ?? []
        );
    }

    public function processRequest() {
        $fc = new FrontController(
                $this->getRequestPath(), $this->getRequestParams(), new Container($this->serviceStore)
        );
        return $fc->dispatch();
    }

    public function getRequestPath() {
        $requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI');
        $requestPath = parse_url($requestUri, PHP_URL_PATH);
        $pos = strpos($requestPath, self::PUBLIC_WEB_ROOT);
        $appRequest = substr($requestPath, $pos + strlen(self::PUBLIC_WEB_ROOT) + 1);
        return explode('/', $appRequest);
    }

    public function printTemplate($response) {
        echo $response;
    }

}
