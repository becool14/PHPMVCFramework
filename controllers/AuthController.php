<?php 
namespace app\controllers;
use app\core\Request;
use app\core\Application;
use app\core\Controller;
use app\models\User;

    class AuthController extends Controller{
        public function login() : string{
            $this->setLayout('auth');
            return $this->render('login');
        }
        public function register(Request $request) : string
        {
            $user = new User;
            if($request->isPost()){
             
                $user->loadData($request->getBody());
                if($user->validate()&&$user->save())
                {
                    Application::$app->session->setFlash('success', 'Thanks for registration');
                    Application::$app->response->redirect('/');
                    exit;
                }
                return $this->render('register', [
                    'model' => $user
                ]);
            }
            $this->setLayout('auth');
            return $this->render('register', [
                'model' => $user
            ]);
        }
    }






?>