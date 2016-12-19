<?php

class ControllerUsers extends Controller
{

    public $model;

    public function __construct()
    {
        $this->model = new ModelUsers();
        $this->view = new  View();
        if(isset($_POST['action'])){
            $this->model->$_POST['action']();
        }
    }

    public function action_index()
    {
        $this->view->setTemplate('users', $this->model);
    }

    public function action_NewUser()
    {
        $this->model->AddNewUser();
    }

    public function action_DeleteUser()
    {
     $this->model->DeleteUser();
    }

    public function action_EditUser()
    {
     $this->model->EditUser();
    }

}
