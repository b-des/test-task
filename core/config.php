<?php
//час життя сесії
define('LIFE_LIMIT', 7400);
//параметри сесії
session_set_cookie_params(LIFE_LIMIT,  "/", "", false, false);
//стартуємо сесію
@session_start();

//якщо користувач залогінений
//встановлюєм константу LOGINED = true
//інакше false
if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
    define('LOGINED', true);
}
else{
    define('LOGINED', false);
}

//назва шаблону для view
define('THEME_NAME',   'main');

//шлях до файлів теми
define ('THEME', '/templates/'.THEME_NAME);
