<?php


    namespace Home;


    class Request
    {
        /**
         *
         */
        const PUBLIC_WEB_ROOT = '/public';
        protected $requestPath;
        protected $requestParams;
        protected $baseUrl;

        public function __construct()
        {
            $this->setRequestParams();
            $this->setRequestPath();
        }

        /**
         * @return mixed
         */
        public function getRequestPath()
        {
            return $this->requestPath;
        }

        /**
         * @return mixed
         */
        public function getRequestParams()
        {
            return $this->requestParams;
        }

        /**
         * @return mixed
         */
        public function getBaseUrl()
        {
            return $this->baseUrl;
        }

        /**
         * @return array
         */
        public function setRequestPath()
        {
            $requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI');
            $requestPath = parse_url($requestUri, PHP_URL_PATH);
            $pos = strpos($requestPath, self::PUBLIC_WEB_ROOT);
            $appRequest = substr($requestPath, $pos + strlen(self::PUBLIC_WEB_ROOT) + 1);

            $this->requestPath = explode('/', $appRequest);
            $this->baseUrl = substr($requestPath, 0, $pos + strlen(self::PUBLIC_WEB_ROOT));
        }

        /**
         * @return array
         */
        public function setRequestParams()
        {
            $this->requestParams = array_merge(
                filter_input_array(INPUT_GET) ?? [], filter_input_array(INPUT_POST) ?? []
            );
        }

    }