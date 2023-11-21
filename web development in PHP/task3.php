

/*
Реализуйте Slim приложение, в котором по адресу / отдается строчка Welcome to Hexlet!
*/

//Мое решение:


<?php

namespace App;

require '/composer/vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function ($request, $response) {
    $response->getBody()->write('Welcome to Hexlet!');
    return $response;
});
$app->run();