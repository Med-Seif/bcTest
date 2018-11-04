<?php

    namespace Home;

    use Bc\Exceptions\MissingRequestedParam;

    /**
     * Description of BaseController
     *
     * @author Seif
     */
    abstract class AbstractBaseController
    {

        /**
         *
         * @var Container
         */
        public $container;
        protected $params;

        public function setParams($params)
        {
            $this->params = $params;
        }

        public function setContainer(Container $container)
        {
            $this->container = $container;
        }

        public function hasParam($paramName)
        {
            return array_key_exists($paramName, $this->params);
        }

        public function getParam($paramName)
        {
            if (!$this->hasParam($paramName)) {
                throw new MissingRequestedParam($paramName);
            }
            return $this->params[$paramName];
        }

        public function getParams()
        {
            return $this->params;
        }

        public function get($id)
        {
            return $this->container->get($id);
        }

        public function render($templatePath, $vars = [])
        {
            if (is_null($vars) || !is_array($vars)) {
                $vars = [];
            }
            return $this->container->get('twig')->render($templatePath, $vars);
        }

        public function redirect($url)
        {
            $host = $_SERVER['HTTP_HOST'] ?? '';
            $proto = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== "off") ? 'https' : 'http';
            $port = $_SERVER['SERVER_PORT'] ?? 80;
            $uri = $proto . '://' . $host;
            if ((('http' == $proto) && (80 != $port)) || (('https' == $proto) && (443 != $port))) {
                // ne pas ajouter le port si il existe déjà
                if (strrchr($host, ':') === false) {
                    $uri .= ':' . $port;
                }
            }
            $url = $uri . $this->get('base_url') . '/' . ltrim($url, '/');
            header('Location: ' . $url);
        }

    }
