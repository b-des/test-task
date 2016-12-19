<?php

class ModelNeworder
{

    private $model;

    public function __construct()
    {
        $this->model = Model::getInstance();
        $this->model->title = 'Нове замовлення';
        if(!LOGINED){
            header('Location:/');
        }
        if($_SESSION['usertype'] == 'cook'){
            header('Location:/');
        }
    }

    //створення нового замовлення
    public function NewOrder()
    {
        $table = (int)$_POST['table'];
        $waiter = $_POST['waiter'];
        $title = $_POST['title'];
        $quantity = $_POST['quantity'];
        $result = Array();
        $i=0;
        foreach ($title as $item){
            $data = array(
                'title' => json_encode(array($item, (int)$quantity[$i])),
                'waiter' => $waiter,
                'table' => $table,
                'new' => '1'
            );
            $result[] = $this->model->db->insert('orders', $data);
            ++$i;
        }
        if(!in_array(false, $result)){
          $this->model->SetMessage('success', 'Замовлення успішно оформлено');
        }
    }

}
