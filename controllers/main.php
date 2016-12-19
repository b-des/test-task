<?php

class ControllerMain extends Controller
{


    function __construct()
    {
        $this->model = new ModelMain();
        $this->view = new View();

    }

    //головний екшн
    function action_index()
    {
        if (!LOGINED) {
            $this->view->setTemplate('login', $this->model);
        } else {
            $this->view->setTemplate('index', $this->model);
        }
    }

    //авторизація
    public function action_login()
    {
        $this->model->Login();
    }


    //отримання даних користувача
    public function action_GetUserData()
    {
        $this->model->GetUserData();

    }


    //видалення замовлення
    public function action_DeleteOrder()
    {
        $this->model->DeleteOrder();

    }

    //вихід із системи
    public function action_Logout()
    {
        $this->model->Logout();
    }



}