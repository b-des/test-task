<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $this->display('title', false) ?></title>

    <link href="<?php echo THEME; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo THEME; ?>/css/styles.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/">Замовлення </a>
                    </li>
                    <li>
                        <a href="/users">Користувачі</a>
                    </li>
                    <?php if($_SESSION['usertype'] != 'cook'): ?>
                    <li>
                        <a href="/neworder">Створити замовлення</a>
                    </li>
                    <?php endif; ?>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="pull-right">
                        <a href="/main/logout">Вихід</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<div class="container">
    <?php $this->display('info', true) ?>
</div>