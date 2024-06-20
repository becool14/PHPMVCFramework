<?php
    namespace app\core;


    class Application{
        public Session $session;
        public Database $db;
        public static string $ROOT_DIR;
        public Router $router;
        public Request $request;
        public Response $response;
        public static Application $app;
        public ?Controller $controller = null;
        public function __construct($rootPath, array $config)
        {
            self::$ROOT_DIR=$rootPath;
            self::$app=$this;
            $this->request = new Request;
            $this->response = new Response;
            $this->router = new Router($this->request, $this->response);
            $this->db = new Database($config['db']);
            $this->session = new Session();
        }
        public function run() : void
        {
            echo $this->router->resolve();
        }
        public function getController(): \app\core\Controller
        {
            return $this->controller;
        }
        public function setController(\app\core\Controller $controller): void
        {
            $this->controller = $controller;
        }
    }
?>