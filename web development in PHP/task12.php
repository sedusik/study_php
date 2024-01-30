

/*
public/index.php
Реализуйте следующие обработчики:

Форма создания нового поста: GET /posts/new
Создание поста: POST /posts
Посты содержат два поля name и body, которые обязательны к заполнению. Валидация уже написана.

Реализуйте вывод ошибок валидации в форме.
После каждого успешного действия нужно добавлять флеш сообщение и выводить его на списке постов. Текст:

Post has been created
templates/posts/new.phtml
Форма для создания поста


*/

//Мое решение:


//public/index.php

<?php

use Slim\Factory\AppFactory;
use DI\Container;

require '/composer/vendor/autoload.php';

$container = new Container();
$container->set('renderer', function () {
    return new Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});
$container->set('flash', function () {
    return new Slim\Flash\Messages();
});

$app = AppFactory::createFromContainer($container);
$app->addErrorMiddleware(true, true, true);

$repo = new App\PostRepository();
$router = $app->getRouteCollector()->getRouteParser();

$app->get('/', function ($request, $response) {
    return $this->get('renderer')->render($response, 'index.phtml');
});

$app->get('/posts', function ($request, $response) use ($repo) {
    $flash = $this->get('flash')->getMessages();

    $params = [
        'flash' => $flash,
        'posts' => $repo->all()
    ];
    return $this->get('renderer')->render($response, 'posts/index.phtml', $params);
})->setName('posts');

// BEGIN (write your solution here)

$app->get('/posts/new', function ($request, $response) {
    $params = [
        'postData' => [],
        'errors' => []
    ];
    return $this->get('renderer')->render($response, 'posts/new.phtml', $params);
})->setName('newPost');

$app->post('/posts', function ($request, $response) use ($router, $repo) {
    $postData = $request->getParsedBodyParam('post');
    $validator = new App\Validator();
    $errors = $validator->validate($postData);

    if (count($errors) === 0) {
        $repo->save($postData);
        $this->get('flash')->addMessage('success', 'Post has been created');
        $url = $router->urlFor('posts');
        return $response->withRedirect($url);
    }

    $params = [
        'postData' => $postData,
        'errors' => $errors
    ];

    $response = $response->withStatus(422);
    return $this->get('renderer')->render($response, 'posts/new.phtml', $params);
});
// END

$app->run();

//templates/posts/new.phtml

<a href="/posts">Посты</a>

<!-- BEGIN (write your solution here) -->
<form action="/posts" method="post">
    <div>
        <label>
            Название
            <input type="text" name="post[name]" value="<?= htmlspecialchars($postData['name'] ?? ''); ?>">
        </label>
        <?php if (isset($errors['name'])): ?>
            <div><?= $errors['name'] ?></div>
        <?php endif ?>
    </div>
    <div>
    <label>
        Текст
        <input type="text" name="post[body]" value="<?= htmlspecialchars($postData['body'] ?? ''); ?>">
    </label>
    <?php if (isset($errors['body'])): ?>
        <div><?= $errors['body'] ?></div>
    <?php endif ?>
    </div>
    <input type="submit" value="Create">
</form>
<!-- END -->