

/*
public/index.php
Реализуйте два обработчика:

/ — выводит флеш сообщения в шаблон templates/index.phtml.
/courses — добавляет сообщение Course Added во Flash и делает редирект на /.
templates/index.phtml
Реализуйте вывод Flash сообщений

*/

//Мое решение:


//public/index.php

<form action="/courses" method="post">
    <input type="submit" value="Create Course">
</form>

<!-- BEGIN (write your solution here) -->


<?php foreach ($flash as $messages) : ?>
    <?php foreach ($messages as $message) : ?>
        <li><?= $message ?></li>
    <?php endforeach ?>
<?php endforeach ?>


<!-- END -->

//templates/index.phtml

<?php

use DI\Container;
use Slim\Factory\AppFactory;

require '/composer/vendor/autoload.php';

session_start();

$container = new Container();
$container->set('renderer', function () {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});
$container->set('flash', function () {
    return new \Slim\Flash\Messages();
});

AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

// BEGIN (write your solution here)
$app->post('/courses', function ($req, $res) {
    $this->get('flash')->addMessage('success', 'Course Added');
    return $res->withRedirect('/');
});

$app->get('/', function ($req, $res) {
    $messages = $this->get('flash')->getMessages();
    $params = ['flash' => $messages];
    return $this->get('renderer')->render($res, 'index.phtml', $params);
});
// END

$app->run();