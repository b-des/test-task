<?php

class Model
{
    protected static $_instance;
    public $db;
    public $message;
    public $title;
    public $session;


    //використовуємо патерн Singleton
    public static function getInstance()
    {

        if (self::$_instance === null) { 
            self::$_instance = new self;
        }
        return self::$_instance;

    }


    private function __wakeup()
    {
    }

    private function __clone()
    {
    }

    function __construct()
    {
        $this->LoadClass('jsondb');
        $this->db = new Jsondb();

    }


    //метод обробки вхідних даних
    public function Processing($data)
    {

        return strip_tags(trim(htmlentities($data, ENT_QUOTES, 'UTF-8')));
    }

    //метод завантаження додаткових класів класів
    public function LoadClass($class)
    {
        $class = mb_strtolower($class);
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/core/class.' . $class . '.php')) {
            include_once $_SERVER['DOCUMENT_ROOT'] . '/core/class.' . $class . '.php';
        }

    }


    //метод побудови повідомелння користувачеві
    //1 тип повідомлення(danger, success, warning)
    //2 заголовок повідомлення
    //3 текст повідомлення
    public function SetMessage($type, $title = '', $text = '')
    {
        if ($title == '') {
            $title = $type;
        }
        $this->message['type'] = $type;
        $this->message['title'] = $title;
        $this->message['text'] = $text;
        return $this->message;
    }
}

