<?php include 'header.php'; ?>

<!-- Page Content -->
<div class="container">
    <div class="row col-md-12 ">
        <?php $users = $this->display('all users', false) ?>
        <table class="table table-striped custab">
            <thead>
            <a href="#" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#new-user"><b>+</b> Додати нового користувача</a>
            <tr>
                <th>ID</th>
                <th>Ім'я</th>
                <th>Логін</th>
                <th>Тип</th>
                <th class="text-center">Дія</th>
            </tr>
            </thead>
            <?php foreach ($users as $user): ?>
                <tr id="user_<?php echo $user['id'] ?>">
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['login'] ?></td>
                    <td><?php
                        if ($user['type'] == 'waiter') {
                            echo 'Офіціант';
                        } else {
                            echo 'Повар';
                        }
                        ?></td>
                    <td class="text-center">
                        <a class='btn btn-info btn-xs' href="#" data-toggle="modal" data-target="#edit-user" data-name="<?php echo $user['name'] ?>" data-login="<?php echo $user['login'] ?>" data-id="<?php echo $user['id'] ?>">
                            <span class="glyphicon glyphicon-edit"></span> Редагувати</a>
                        <a href="#" class="btn btn-danger btn-xs" data-id="<?php echo $user['id'] ?>" id="RemoveUser">
                            <span class="glyphicon glyphicon-remove"></span> Видалити</a>
                    </td>
                </tr>
            <?php endforeach; ?>


        </table>
    </div>

    <!-- Modal -->
    <div id="new-user" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Новий користувач</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="/users/newuser">
                        <fieldset>


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="UID">Логін</label>
                                <div class="col-md-4">
                                    <input id="UID" name="login" placeholder="" class="form-control input-md" required="" type="text">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="pwd_confirm">Ім'я</label>
                                <div class="col-md-4">
                                    <input id="pwd_confirm" name="name" placeholder="" class="form-control input-md" required="" type="text">

                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="pwd_confirm">Пароль</label>
                                <div class="col-md-4">
                                    <input id="pwd_confirm" name="password" placeholder="" class="form-control input-md" required="" type="password">

                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="perfil">Тип користувача</label>
                                <div class="col-md-4">
                                    <select id="perfil" name="type" class="form-control">
                                        <option value="waiter">Офіціант</option>
                                        <option value="cook">Повар</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="btn_continuar"></label>
                                <div class="col-md-4">
                                    <button id="btn_continuar" name="btn_continuar" class="btn btn-primary" type="submit">Додати</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
                </div>
            </div>

        </div>
    </div>



    <div id="edit-user" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Редагувати користувача</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="">
                        <fieldset>


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="UID">Логін</label>
                                <div class="col-md-4">
                                    <input id="UID" name="login" placeholder="" class="form-control input-md" required="" type="text">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="pwd_confirm">Ім'я</label>
                                <div class="col-md-4">
                                    <input id="pwd_confirm" name="name" placeholder="" class="form-control input-md" required="" type="text">

                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="pwd_confirm">Пароль</label>
                                <div class="col-md-4">
                                    <input id="pwd_confirm" name="password" placeholder="" class="form-control input-md"  type="password">

                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="perfil">Тип користувача</label>
                                <div class="col-md-4">
                                    <select id="perfil" name="type" class="form-control">
                                        <option value="waiter">Офіціант</option>
                                        <option value="cook">Повар</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="btn_continuar"></label>
                                <div class="col-md-4">
                                    <button id="btn_continuar" name="btn_continuar" class="btn btn-primary" type="submit">Зберегти</button>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="3">
                            <input type="hidden" name="action" value="EditUser">
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container -->

<div class="container">

    <hr>
    <?php include 'footer.php'; ?>
