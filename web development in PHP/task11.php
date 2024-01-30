

/*
public/index.php
Реализуйте следующие обработчики:

Список постов: /posts
Конкретный пост /posts/:id (например /posts/3)
Посты находятся в репозитории $repo. Каждый пост содержит внутри себя четыре поля:

id
name
body
slug
Каждый пост из списка ведет на страницу конкретного поста. Список нужно вывести с пейджингом по 5 постов на странице. На первой странице первые пять постов, на второй вторые пять и так далее. Переключение между страницами нужно сделать с помощью двух ссылок: назад и вперед. То какая сейчас страница открыта, определяется параметром page. По умолчанию загружается первая страница.

Страница конкретного поста отображает данные поста и позволяет вернуться на список. Если поста не существует, то страница обработчик должен вернуть код ответа 404 и текст Page not found.

templates/posts/index.phtml
Выведите список добавленных постов. Каждый пост это имя, которое представлено ссылкой ведущей на отображение (show).

templates/posts/show.phtml
Вывод информации о конкретном посте. Выводить только имя и содержимое поста.


*/

//Мое решение:


//public/index.php

<?php

use Slim\Factory\AppFactory;
use DI\Container;

require '/composer/vendor/autoload.php';

$container = new Container();
$container->set('renderer', function () {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});

$app = AppFactory::createFromContainer($container);
$app->addErrorMiddleware(true, true, true);

$repo = new App\PostRepository();

$app->get('/', function ($request, $response) {
    return $this->get('renderer')->render($response, 'index.phtml');
});

// BEGIN (write your solution here)
$app->get('/posts', function ($request, $response) use ($repo) {
    $per = 5;
    $page = $request->getQueryParam('page', 1);
    $item = ($page - 1) *  $per;
    $posts = $repo->all();
    $sliceOfPosts = array_slice($posts, $item, $per);
    $params = ['page' => $page, 'posts' => $sliceOfPosts];
    return $this->get('renderer')->render($response, 'posts/index.phtml', $params);
})->setName('posts');

$app->get('/posts/{id}', function ($request, $response, $args) use ($repo) {
    $id = $args['id'];
    $post = $repo->find($id);
    if (!$post) {
        return $response->withStatus(404)->write('Page not found');
    }
    $params = ['post' => $post];
    return $this->get('renderer')->render($response, 'posts/show.phtml', $params);
})->setName('post');
// END

$app->run();


//templates/posts/index.phtml

<!-- BEGIN (write your solution here) -->
<table>
  <?php foreach ($posts as $post): ?>
    <tr>
      <td>
          <a href="/post/<?= $post['id'] ?>"><?= $post['name'] ?></a>
      </td>
    </tr>
  <?php endforeach ?>
</table>

<br>

<div>
<a href="?page=<?= $page < 2 ? 1 : $page - 1 ?>">Назад</a> <a href="?page=<?= $page + 1 ?>">Вперед</a>
</div>
<!-- END -->

//templates/posts/show.phtml

<a href="/posts">Посты</a>

<!-- BEGIN (write your solution here) -->
  <div>
      <?= $post['name'] ?>
      <?= $post['body'] ?>
  </div>
<!-- END -->