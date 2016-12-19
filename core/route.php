<?php

class Route
{
    public $error;

    static function start()
    {

        // контроллер і дія за замовчуванням
        $controller_name = 'main';
        $action_name = 'index';

        // отримуємо ім'я контроллера із  url
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // отримуємо ім'я контроллера із  url
        if (!empty($_GET['controller'])) {
            $controller_name = preg_replace(array("/\..+$/", "/\?.+$/", "/\-/"), "", $_GET['controller']);
            if ($_GET['controller'] == "index.php" || $_GET['controller'] == "index.html") {
                $controller_name = "main";
            }

        }

        // отримуємо ім'я екшена
        if (!empty($_GET['action'])) {
            $action_name = preg_replace(array("/\..+$/", "/\?.+$/", "/\-/"), "", $_GET['action']);
        }
        if(isset($_GET['action']) && $_GET['action'] != ''){
            $action_name = preg_replace(array("/\..+$/", "/\?.+$/", "/\-/"), "", $_GET['action']);
        }

        $action_name = str_replace('-', '', $action_name);


        // завантажуємо файл з класом контроллера
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "./controllers/" . $controller_file;
        if (file_exists($controller_path)) {
            include($controller_path);
        } else if ($controller_name != "index.php" || $controller_name != "index.html") {
            Route::ErrorPage404();
        }


        // додаємо префікси
        $model_name = $controller_name;
        $action_name = 'action_' . $action_name;


          // завантажуємо файл з классом моделі
        $model_file = strtolower($model_name) . '.php';
        $model_path = "./models/" . $model_file;
        if (file_exists($model_path)) {
            include($model_path);
        }
        // створюємо контроллер
        $controller_class = "Controller" . ucfirst($controller_name);
        $controller = new $controller_class;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            // викликаємо дію контроллера
            $controller->$action();
        } else {
            Route::ErrorPage404();

        }

    }


    static function ErrorPage404()
    {

        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:/404');
        die;
    }
}