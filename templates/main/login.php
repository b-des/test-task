<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вхід в систему</title>
    <link href="<?php echo THEME; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo THEME; ?>/css/styles.css" rel="stylesheet">
    <style>
        body { 
    width: 100%;
    height:100%;
    font-family: 'Open Sans', sans-serif;
    background: #092756 url('http://hdwallpaperbackgrounds.net/wp-content/uploads/2016/11/Background-20.jpeg') no-repeat;
}
    </style>
</head>
<body>
    <div class="login">
    <h1>Вхід</h1>
    <form method="post" action="/main/login">
        <input type="text" name="login" placeholder="Логін" required="required" />
        <input type="password" name="password" placeholder="Пароль" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Поїхали!</button>
    </form>
    <br>
</div>
</body>
</html>