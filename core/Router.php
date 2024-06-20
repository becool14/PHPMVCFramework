<?php

    namespace app\core;


    class Router{
        public Request $request;
        public Response $response;
        protected array $routes=[];

        public function __construct(Request $request, Response $response){
            $this->request = $request;
            $this->response = $response;
        }

        public function get($path, $callback) : void
        {
            $this->routes['get'][$path]=$callback;
        }
        public function post($path, $callback) : void
        {
            $this->routes['post'][$path]=$callback;
        }
        public function resolve()
        {
            $path = $this->request->getPath();
            $method = $this -> request ->method();
            $callback = $this->routes[$method][$path] ?? false;
            if($callback === false){
                $this->response->setStatusCode(404);
                return $this->renderView("_404");
            }
            if (is_array($callback)) {
                Application::$app->controller = new $callback[0];
                $callback[0] = Application :: $app->controller;
            }
            return call_user_func($callback, $this->request);
        }
        public function renderView($view,$params = []) : string
        {
            $layoutContent = $this ->layoutContent();
            $viewContent = $this->renderOnlyView($view, $params);
            return str_replace('{{content}}', $viewContent, $layoutContent);

        }
        public function renderContent($viewContent) : string 
        {
            $layoutContent = $this ->layoutContent();
            str_replace('{{content}}', $viewContent, $layoutContent);
            return $layoutContent;

        }
        protected function layoutContent() : string
        {
            $layout = Application::$app->controller ? Application::$app->controller->layout : 'main';
            ob_start();
            include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
            return ob_get_clean();
        }

        protected function renderOnlyView($view, $params): string
        {
            foreach ($params as $key => $value){
                    $$key = $value;
            }
            ob_start();
            include_once Application::$ROOT_DIR."/views/$view.php";
            return ob_get_clean();
        }
    }
?>