<?php

namespace App\Controllers;

use App\Core\Controller;

use function App\route;

/** контрллер главной страницы */
class MainController extends Controller
{
    public function index()
    {
        // разлогирование
        if (isset($_GET['logout'])) {
            setcookie('email', '', time() - 3600, '/');
            setcookie('auth', '', time() - 3600, '/');
            session_destroy();
        }

        // роуты
        $routes = [
            'register' => route('register'),
            'login' => route('login'),
        ];

        $this->view->generate(
            page_name: $this->site_name,
            template_view: 'template_view.php',
            content_view: 'main_view.php',
            content_css: 'main.css',
            routes: $routes
        );
    }

    public function error($errorName)
    {
        $data = ['error' => $errorName];
        $this->view->generate(
            'Ошибка',
            'template_view.php',
            'page_error_view.php',
            $data
        );
    }
}
