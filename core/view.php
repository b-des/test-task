<?php


class View
{
    private $object;
    private $base_model;
    private $current_model;
    private $string;
    public $section;
    public $test;

    public function __construct(&$current_model = NULL)
    {
        if ($current_model != NULL)
            $this->current_model = $current_model;
        $this->base_model = Model::getInstance();
    }

    public function __call($name, array $params)
    {
        echo "Can't call method $name";
        return;
    }

    //метод виведення інформації
    //дані передаються із моделі у вигляді об'єкту
    //1 параметр - властивість або метод, який потрібно відобразити
    //2 параметр - вказівник, виводити дані чи віддати на обробку
    //3 параметр - додаткові параметри для методу, що викликається
    public function display($data = NULL, $echo = false, $string = NULL)
    {

        $this->test++;
        $this->string = $string;
        $show = array();

        $data = str_replace(array('-', ' '), '', $data);


        if ($data == 'obj') {
            var_dump($this->object);
            return false;
        }
        if ($data == 'info') {
            include('.' . THEME . '/info.php');
            return false;
        }
        if ((!is_null($data) || $data != "") && !is_null($this->object)) {
            $params = explode(",", $data);
            foreach ($params as $parameter) {
                $name = trim($parameter);


                if (method_exists($this->object, $name)) {

                    $data = $this->object->$name($this->string);
                } else if (property_exists($this->object, $name)) {

                    $data = $this->object->$name;

                } elseif($this->current_model != NULL) {
                    if (!method_exists($this->current_model, $name)) {

                        $data = $this->current_model->$name;
                    } else {
                        $data = $this->current_model->$name($this->string);
                    }
                }else {
                    if (!method_exists($this->base_model, $name)) {

                        $data = $this->base_model->$name;
                    } else {
                        $data = $this->base_model->$name($this->string);
                    }
                }


                array_push($show, $data);

            }
            if (count($params) > 1) {
                return $show;
            } else {
                if ($echo) {
                    print_r($data);
                } else {
                    return $data;
                }
            }
        }
        return false;
    }


    //метод для завантаження шаблону
    //1 параметр - ім'я шаблону
    //2 второй - дані, що передані з моделі(об'єкт)
    public function setTemplate($template, &$data = NULL)
    {

        if ($data !== NULL) {
            $this->object = $data;
        } else {
            $this->object = (object)$this->object;
        }
        $template = mb_strtolower($template);
        if (!@include('.' . THEME . '/' . $template . ".php"))
            die("<br/>No file " . HOST . THEME . '/' . $template . ".php<br/>");

    }


}




