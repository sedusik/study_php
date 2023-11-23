

/*
Реализуйте Маршрут /companies/{id}, по которому отдается json представление компании. Компания извлекается из списка $companies. Каждая компания представлена ассоциативным массивом у которого есть текстовый (то есть тип данных - строка) ключ id:

Пример
<?php

// Гипотетический пример показывающий структуру
$companies = [
  ['id' => 4, /* другие свойства */],
  ['id' => 2, /* другие свойства */],
  ['id' => 8, /* другие свойства */]
];
Если компания с таким идентификатором не существует, то сайт должен вернуть ошибку 404 (страница с HTTP кодом 404) и текстом Page not found.


*/

//Мое решение:


<?php

use Slim\Factory\AppFactory;

require '/composer/vendor/autoload.php';

$companies = App\Generator::generate(100);

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function ($request, $response, $args) {
    return $response->write('open something like (you can change id): /companies/5');
});

$app->get('/companies/{id:[0-9]+}', function ($request, $response, $args) use ($companies) {
        $id = $args['id'];
        $company = collect($companies)->firstWhere('id', $id);
        if (!$company) {
            return $response->withStatus(404)->write('Page not found');
        }
        return $response->write(json_encode($company));
});

$app->run();