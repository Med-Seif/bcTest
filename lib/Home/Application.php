<?php

    namespace Home;

    use Bc\Exceptions\ServiceNotFoundException;
    use Exception;
    use Twig\Extension\DebugExtension;
    use Twig_Environment;
    use Twig_Loader_Filesystem;

    /**
     * Description of Application
     *
     * @author Seif
     */
    class Application
    {
        /**
         *
         */
        const CONFIG_PATH = __DIR__ . '/../../app/Config';
        /**
         *
         */
        const TWIG_TEMPLATE_PATH = __DIR__ . '/../../src/Bc/Views/';

        /**
         *
         * @var ServicesStore
         */
        protected $serviceStore;
        protected $request;

        /**
         *
         */
        public function run()
        {
            try {
                $this->initRequest();
                $this->initServices();
                $this->initConfig();
                $this->initDbConnection();
                $this->initTemplateEngine();
                $this->printTemplate(
                    $this->processRequest()
                );
            } catch (Exception $e) {
                echo get_class($e) . ' : ' . $e->getMessage();
            }
        }

        public function initRequest()
        {
            $this->request = new Request();
        }

        /**
         *
         */
        public function initServices()
        {
            $services = require_once self::CONFIG_PATH . '/services.php';
            $serviceStore = new ServicesStore();
            foreach ($services as $serviceKey => $serviceClassName) {
                if (!class_exists($serviceClassName)) {
                    throw new ServiceNotFoundException($serviceClassName);
                }
                $serviceStore[$serviceKey] = new $serviceClassName();
            }
            $this->serviceStore = $serviceStore;
        }

        /**
         *
         */
        public function initDbConnection()
        {
            $configDB = require_once self::CONFIG_PATH . '/db.php';
            $this->serviceStore['db_connection'] = PdoMysqlAdapter::createConnection($configDB);
        }

        /**
         *
         */
        public function initTemplateEngine()
        {
            $loader = new Twig_Loader_Filesystem(self::TWIG_TEMPLATE_PATH);
            $twig = new Twig_Environment($loader, ['debug' => true]);
            $twig->addExtension(new DebugExtension());
            $twig->addGlobal('base_url', $this->request->getBaseUrl());
            $this->serviceStore['twig'] = $twig;
        }


        /**
         * @return mixed
         * @throws \Bc\Exceptions\MissingControllerActionResponse
         */
        public function processRequest()
        {
            $fc = new FrontController(
                $this->request->getRequestPath(),
                $this->request->getRequestParams(),
                new Container($this->serviceStore)
            );
            return $fc->dispatch();
        }


        public function initConfig()
        {
            $this->serviceStore['base_url'] = $this->request->getBaseUrl();
        }

        /**
         * @param $response
         */
        public function printTemplate($response)
        {
            echo $response;
        }

    }
