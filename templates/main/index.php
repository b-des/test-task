<?php include 'header.php'; ?>

<?php //print_r(); ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="span7">
            <div class="widget stacked widget-table action-table">

                <div class="widget-header">
                    <i class="icon-th-list"></i>
                    <h3>Список замовлень</h3>
                </div> <!-- /widget-header -->

                <div class="widget-content">
                    <?php $orders = $this->display('all orders', false) ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Назва страви</th>
                            <th>Кількість порцій</th>
                            <?php if ($_SESSION['usertype'] != 'waiter'): ?>
                                <th>Офіціант</th>
                            <?php endif; ?>
                            <th>№ столу</th>
                            <th>Статус</th>
                            <th>Час до приготування</th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody id="order-list">
                        <?php foreach ($orders as $order): ?>
                            <tr id="order_<?php echo $order['id'] ?>" data-id="<?php echo $order['id'] ?>">
                                <?php $title = json_decode($order['title']); ?>
                                <td><?php echo $order['id'] ?></td>
                                <td><?php echo $title[0] ?></td>
                                <td><?php echo $title[1] ?></td>
                                <?php if ($_SESSION['usertype'] != 'waiter'): ?>
                                    <td><?php echo $order['waiter'] ?></td>
                                <?php endif; ?>
                                <td><?php echo $order['table'] ?></td>
                                <td class="status">
                                    <?php
                                    if ($order['status'] == 'done') {
                                        echo 'Готово';
                                    } elseif($order['status'] == 'preparing') {
                                        echo 'Готується';
                                    }else{
                                        echo 'В обробці';
                                    }
                                    ?>

                                </td>

                                <td class="time-left text-center" data-time="<?php echo $order['time'] ?>">
                                    <?php if ($_SESSION['usertype'] != 'waiter' && $order['time'] == ''): ?>

                                        <input type="number" class="form-control input-sm deadline" style="width: 80px; display: inline-block;">
                                        <a href="#" class="btn btn-primary btn-xs SetTime" data-id="<?php echo $order['id'] ?>">
                                            Вказати
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center user-actions">
                                    <?php if ($_SESSION['usertype'] != 'waiter' && $order['status'] != 'done'): ?>
                                        <a href="#" class="btn btn-success btn-xs StatusDone" title="Завершити"
                                           data-id="<?php echo $order['id'] ?>">
                                            <i class="glyphicon  glyphicon-ok "></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($_SESSION['usertype'] != 'cook' && $order['status'] == 'done'): ?>
                                        <a href="#" class="btn btn-danger btn-xs" title="Видалити" id="DeleteOrder"
                                           data-id="<?php echo $order['id'] ?>">
                                            <i class="glyphicon  glyphicon-remove "></i>
                                        </a>

                                    <?php endif; ?>
                                </td>


                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div> <!-- /widget-content -->

            </div> <!-- /widget -->
        </div>

    </div>

</div>
<!-- /.container -->

<div class="container">

    <hr>
    <?php include 'footer.php'; ?>
