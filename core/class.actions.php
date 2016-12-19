<?php

class Actions
{
    public $model;
    public $host;

    function __construct()
    {
        require_once('model.php');
        $this->model = Model::getInstance();
    }


    //зміна статусу замовлення з "готується" на "готово"
    public function ChangeOrderStatus($id, $value = '')
    {
        $id = $this->model->Processing($id);
        $data = Array(
            'status' => 'done',
            'time' => ''
        );

        $where = Array(
            'id' => Array($id)
        );

          $result = $this->model->db->update('orders', $data, $where);
          if ($result) {
        return array('action' => 'ChangeOrderStatus', 'value' => 'true', 'id' => $id);
         }


    }

    //встановлення часу до приготування замовлення
    public function OrderSetTime($id, $time)
    {
        $id = $this->model->Processing($id);
        $time = $this->model->Processing($time);
        $data = Array(
            'time' => $time,
            'status' => 'preparing'
        );

        $where = Array(
            'id' => Array($id)
        );

        $result = $this->model->db->update('orders', $data, $where);
        if ($result) {
            return array('action' => 'OrderSetTime', 'value' => $time, 'id' => $id);
        }
    }


    public function GetOrderTimers()
    {

    }


    //перевірка на наявність нових замовлень
    public function CheckForNewOrder($id = '', $value = '')
    {
        $where = Array('new' => '1');
        $data = Array(
            'where' => $where,
        );

        $result = $this->model->db->select('*', 'orders', $data);
        if (!empty($result)) {
            $id = array();
            $html = '';
            foreach ($result as $item) {
                $id[] = $item['id'];
                $title = json_decode($item['title']);
                $html .= '<tr id="order_' . $item['id'] . '" data-id="' . $item['id'] . '">
                                <td>' . $item['id'] . '</td>
                                <td>' . $title[0] . '</td>
                                <td>' . $title[1] . '</td>
                                <td>' . $item['waiter'] . '</td>
                                <td>' . $item['table'] . '</td>
                                <td class="status">
                                    В обробці
                                </td>

                                <td class="time-left text-center" data-time="">
                                    <input type="number" class="form-control input-sm deadline" style="width: 80px; display: inline-block;">
                                        <a href="#" class="btn btn-primary btn-xs SetTime" data-id="' . $item['id'] . '">
                                            Вказати
                                        </a>
                                </td>
                                <td class="text-center user-actions">
                                    <a href="#" class="btn btn-success btn-xs StatusDone1" title="Завершити" data-id="' . $item['id'] . '">
                                        <i class="glyphicon  glyphicon-ok "></i>
                                    </a>
                                </td>
                            </tr>';
            }
            $id = implode(',', $id);
            $this->model->db->update('orders', array('new' => '0'), array('new' => '1'));
            return array('action' => 'CheckForNewOrder', 'value' => $html, 'id' => $id);

        }
    }
}