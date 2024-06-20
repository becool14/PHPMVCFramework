<?php
namespace app\controllers; 
use app\core\Request;
use app\core\Application;
use app\core\Controller;

    class SiteController extends Controller
    {
        public function handleContact(Request $request) : string
        {
            $body = $request->getBody();
            var_dump($body);
            return 'Handling submitted data';
        }
        public function contact() : string
        {
            return $this->render('contact');
        }
        public function home() : string
        {
            $params = [
                'name' => "TheBobus"
            ];
            return $this->render('home', $params);
        }
    }

?>