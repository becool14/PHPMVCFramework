<?php
namespace app\core;
    class Controller{
        public string $layout = 'main';

        public function render($view, $params=[]) : string
        {
            return Application::$app->router->renderView($view, $params);
        }

        public function setLayout($layout) : void
        {
            $this->layout=$layout;
        }
    }



?>