<?php

class ModelMain
{

    private $model;

    public function __construct()
    {
        $this->model = Model::getInstance();
        $this->model->title = 'Список замовлень';
    }

    public function Login()
    {
        $login = $this->model->Processing($_POST['login']);
        $password = $this->model->Processing($_POST['password']);
        $password = md5(md5($password));

        $where = Array('login' => Array($login));
        $data = Array(
            'where' => $where,
            'limit' => 1
        );

        $result = $this->model->db->select('*', 'users', $data);


        if ($result[0]['password'] == $password) {
            $_SESSION['username'] = $result[0]['name'];
            $_SESSION['userid'] = $result[0]['id'];
            $_SESSION['login'] = $result[0]['login'];
            $_SESSION['usertype'] = $result[0]['type'];
        }
        header('Location:/');
    }

    //список всіх замовлень
    public function AllOrders()
    {
        $usertype = $_SESSION['usertype'];
        if ($usertype != 'waiter') {
            $where = Array('status' => array('preparing', ''));
        }else{
            $where = Array('waiter' => $_SESSION['username']);
        }

        $data = Array(
            'where' => $where,
        );

        $result = $this->model->db->select('*', 'orders', $data);
        return $result;
    }


    //виводимо дані користувача
    public function GetUserData()
    {
        print_r(json_encode($_SESSION));
    }

    //видалення замовлення
    public function DeleteOrder()
    {
        $id = $this->model->Processing($_POST['id']);
        $result = $this->model->db->delete('orders', array('id' => $id));
        if ($result) {
            echo 'ok';
        }
    }

    //вихід із системи
    public function Logout()
    {
        session_destroy();
        header('location:/');
    }
}
