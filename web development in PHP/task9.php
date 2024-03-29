

/*
Реализуйте класс валидатор, который проверяет данные курса. Реализация должна соответствовать интерфейсу ValidatorInterface.

Валидации:

Свойство paid - должно быть заполнено
Свойство title - должно быть заполнено
Если поле не заполнено, то используется сообщение Can't be blank

public/index.php
Реализуйте создание курсов в которое входит два обработчика /courses/new (отображает форму) и /courses создает курс.

Если данные формы валидны, то сохраните курс $repo->save($course) и выполните редирект на страницу со списком курсов /courses. Если данные не валидны, то выведите форму с заполненными полями и сообщения об ошибках.

templates/courses/new.phtml
Выведите форму создания курса со следующими полями:

paid - селект определяющий платность курса (true/false)
title - имя курса

*/

//Мое решение:


// src/Validator.php

<?php

namespace App;

class Validator implements ValidatorInterface
{
    public function validate(array $course)
    {
        // BEGIN (write your solution here)
        $errors = [];

        if($course['paid'] === '') {
            $errors['paid'] = "Can't be blank";
        }
        if($course['title'] === '') {
            $errors['title'] = "Can't be blank";
        }
        return $errors;
        // END
    }
}


// public/index.php


use Slim\Factory\AppFactory;
use DI\Container;
use App\Validator;

require '/composer/vendor/autoload.php';

$repo = new App\CourseRepository();

$container = new Container();
$container->set('renderer', function () {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
});

$app = AppFactory::createFromContainer($container);
$app->addErrorMiddleware(true, true, true);

$app->get('/', function ($request, $response) {
    return $this->get('renderer')->render($response, 'index.phtml');
});

$app->get('/courses', function ($request, $response) use ($repo) {
    $params = [
        'courses' => $repo->all()
    ];
    return $this->get('renderer')->render($response, 'courses/index.phtml', $params);
});

// BEGIN (write your solution here)


$app->get('/courses/new', function ($request, $response) {
    $params = [
        'course' => ['title' => '', 'paid' => ''],
        'errors' => []
    ];
    return $this->get('renderer')->render($response, "courses/new.phtml", $params);
});

$app->post('/courses', function ($request, $response) use ($repo) {
    $validator = new Validator();
    $course = $request->getParsedBodyParam('course');
    $errors = $validator->validate($course);
    if (count($errors) === 0) {
        $repo->save($course);
        return $response->withRedirect('/courses');
    }
    $params = [
        'course' => $course,
        'errors' => $errors
    ];
    return $this->get('renderer')->render($response->withStatus(422), "courses/new.phtml", $params);
});
// END

$app->run();

//templates/courses/new.phtml

<!-- BEGIN (write your solution here) -->
<form action="/courses" method="post">
  <div>
    <label>
        Paid
      <select name="course[paid]">
        <option value="">Select</option>
        <option <?= $course['paid'] === '1' ? 'selected' : '' ?> value="1">Paid</option>
        <option <?= $course['paid'] === '0' ? 'selected' : '' ?> value="0">Free</option>
      </select>
    </label>
    <?php if (isset($errors['paid'])): ?>
      <div><?= $errors['paid'] ?></div>
    <?php endif ?>
  </div>
  <div>
    <label>
        Title
      <input type="text" required name="course[title]" value="<?= htmlspecialchars($course['title']) ?>">
    </label>
    <?php if (isset($errors['title'])): ?>
      <div><?= $errors['title'] ?></div>
    <?php endif ?>
  </div>
  <input type="submit" value="Create">
</form>
<!-- END -->