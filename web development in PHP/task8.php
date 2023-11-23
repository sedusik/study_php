

/*
Реализуйте обработчик /users, который формирует список пользователей. Обработчик поддерживает фильтрацию через параметр term, в котором передается firstName, возвращающий все совпадения по началу имени пользователя. Список пользователей доступен в переменной $users.

templates/users/index.phtml
Реализуйте вывод списка пользователей и формы для фильтрации. Если совпадения не найдены, то должна выводится только форма. Поле ввода должно сохранять введённое значение.


*/

//Мое решение:


public/index.php
<?php

use Slim\Factory\AppFactory;
use DI\Container;

use function Symfony\Component\String\s;

require '/composer/vendor/autoload.php';

$users = App\Generator::generate(100);

$container = new Container();
$container->set('renderer', function () {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});

AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function ($request, $response) {
    return $this->get('renderer')->render($response, 'index.phtml');
});

// BEGIN (write your solution here)
$app->get('/users', function ($request, $response) use ($users) {
    $term = $request->getQueryParam('term');
    $result = collect($users)->filter(
        fn($user) => empty($term) ? true : s($user['firstName'])->ignoreCase()->startsWith($term)
    );
    $params = [
        'users' => $result,
        'term' => $term
    ];
    return $this->get('renderer')->render($response, 'users/index.phtml', $params);
});
// END

$app->run();


templates/users/index.phtml

<a href="/users">Все Пользователи</a>

<!-- BEGIN (write your solution here) -->
<form action="/users" method="get">
  <input type="search" name="term" value="<?= htmlspecialchars($term) ?>" />
  <input type="submit" value="Search" />
</form>
  <?php foreach ($users as $user): ?>
      <div>
            <?= $user['firstName'] ?>
      </div>
  <?php endforeach ?>
<!-- END -->
