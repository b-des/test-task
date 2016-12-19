<?php

class ModelUsers
{

    private $model;

    public function __construct()
    {
        $this->model = Model::getInstance();
        $this->model->title = 'Список користувачів';
        if(!LOGINED){
            header('Location:/');
        }
    }

    //виведення всіх користувачів
    public function AllUsers()
    {
        $result = $this->model->db->select('*', 'users');

        return $result;
    }

    //додавання нового користувача
    public function AddNewUser()
    {
        $login = $this->model->Processing($_POST['login']);
        $name = $this->model->Processing($_POST['name']);
        $password = $this->model->Processing($_POST['password']);
        $type = $this->model->Processing($_POST['type']);
        $count = $this->model->db->select('*', 'users', array('where' => array('login' => $login)));
        if(!empty($count)){
            header('Location:/users');
            return false;
        }
        if (!empty($login) && !empty($name) && !empty($password) && !empty($type)) {
            $data = array(
                'login' => $login,
                'name' => $name,
                'password' => md5(md5($password)),
                'type' => $type,
            );
            $result[] = $this->model->db->insert('users', $data);

            if (!in_array(false, $result)) {
                $this->model->SetMessage('success', 'Користувач успішно добвлений в систему');
            }
        }
        header('Location:/users');
    }


    //видалення користувача
    public function DeleteUser()
    {

        $id = (int)$this->model->Processing($_POST['id']);
        if($id == 1){
            return false;
        }
        $where = array(
            'id' => $id
        );
        $this->model->db->delete('users', $where);
        echo 'ok';
    }


    //редагування користувача
    public function EditUser()
    {
        $id = $this->model->Processing($_POST['id']);
        $login = $this->model->Processing($_POST['login']);
        $name = $this->model->Processing($_POST['name']);
        $password = $this->model->Processing($_POST['password']);
        $type = $this->model->Processing($_POST['type']);
        if (!empty($login) && !empty($name)  && !empty($type)) {
            $data = array(
                'login' => $login,
                'name' => $name,
                'type' => $type,
            );
            if(!empty($password)){
                $data['password'] = md5(md5($password));
            }
            $where = array(
                'id' => $id
            );
            $result[] = $this->model->db->update('users', $data, $where);

            if (!in_array(false, $result)) {
                header('Location:/users');
                $this->model->SetMessage('success', 'Дані користувача успішно збережені');
            }
        }

    }

}
