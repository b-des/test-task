<?php

class ControllerNeworder extends Controller
{

    public $model;

    public function __construct()
    {
        $this->model = new ModelNeworder();
        $this->view = new  View();

        if(isset($_POST['action'])){
            $this->model->$_POST['action']();
        }
    }

    public function action_index()
    {
        $this->view->setTemplate('neworder', $this->model);
    }


}
