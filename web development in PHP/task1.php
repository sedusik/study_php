

/*
Реализуйте микросайт, со следующими страницами:

/. Содержимое:

<a href="/welcome">welcome</a>
<br>
<a href="/not-found">not-found</a>
/welcome. Содержимое:

<a href="/">main</a>
Все остальные обращения считаются не найденными страницами. На такие запросы должен возвращаться код ответа 404 и содержимое:

Page not found. <a href="/">main</a>


*/

//Мое решение:


<?php

$adress = $_SERVER['REQUEST_URI'];

switch ($adress) {
  case '/':
    echo '<a href="/welcome">welcome</a>';
    echo '<br>';
    echo '<a href="/not-found">not-found</a>';
    break;
  case '/welcome':
    echo '<a href="/">main</a>';
    break;
  default:
    header("HTTP/1.0 404 Not Found");
    echo 'Page not found. <a href="/">main</a>';
    break;
}