

/*
routes/web.php
Добавьте два маршрута:

GET /about. Берет содержимое из шаблона about.blade.php
GET /articles. Берет содержимое из шаблона articles.blade.php
resources/views/welcome.blade.php
Добавьте в шаблон ссылки на страницы /about и /articles

resources/views/about.blade.php
Добавьте в шаблон HTML:

<h1>О блоге</h1>
<p>Эксперименты с Ларавелем на Хекслете</p>
resources/views/articles.blade.php
Добавьте в шаблон HTML:

<h1>Статьи</h1>
*/

routes/web.php

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// BEGIN (write your solution here)
Route::get('/about', function () {
    return view('about');
});

Route::get('/articles', function () {
    return view('articles');
});
// END

resources/views/welcome.blade.php

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="container mt-4">
            <!-- BEGIN (write your solution here) -->
            <a href="/about">About</a>
            <a href="/articles">Articles</a>
            <!-- END -->
        </div>
    </body>
</html>

resources/views/about.blade.php

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel | About</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="container mt-4">
            <!-- BEGIN (write your solution here) -->
            <h1>О блоге</h1>
            <p>Эксперименты с Ларавелем на Хекслете</p>
            <!-- END -->
        </div>
    </body>
</html>

resources/views/articles.blade.php

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel | Articles</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="container mt-4">
            <!-- BEGIN (write your solution here) -->
            <h1>Статьи</h1>
            <!-- END -->
        </div>
    </body>
</html>
________________________________________________________________________________________________________________________

routes/web.php
Реализуйте обработчик маршрута about, который передает в шаблон about переменную $team. Она содержит список сотрудников компании с указанием их имени и должности.
Выведите на экран информацию о сотрудниках в произвольном формате.

routes/web.php



use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$team = [
    ['name' => 'Hodor', 'position' => 'programmer'],
    ['name' => 'Joker', 'position' => 'CEO'],
    ['name' => 'Elvis', 'position' => 'CTO'],
];

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', function () use ($team) {
    // BEGIN (write your solution here)
    return view('about', ['team' => $team]);
    // END
});

about.blade.php

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel | About</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="container mt-4">
            <h1>О блоге</h1>
            <p>Эксперименты с Ларавелем на Хекслете</p>
            <!-- BEGIN (write your solution here) -->
            @foreach ($team as $member)
            <h2>{{ $member['name'] }}</h2>
            <p>{{ $member['position'] }}</p>
            @endforeach
            <!-- END -->
        </div>
    </body>
</html>

________________________________________________________________________________________________________________________

resources/views/layouts/app.blade.php
Добавьте вывод двух секций:

Секция header, содержимое которой выводится в заголовке <h1>
Секция content, содержимое которой выводится под заголовком в <div>
resources/views/about.blade.php
Подключите макет layouts/app
Добавьте в секцию header текст "О блоге"
Добавьте в секцию content:

<p>Эксперименты с Ларавелем на Хекслете</p>
resources/views/articles.blade.php
Подключите макет layouts/app
Добавьте в секцию header текст "Статьи"
Добавьте в секцию content:

<p>Тут будут статьи</p>

____

resources/views/layouts/app.blade.php

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="container mt-4">
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/articles">Articles</a>
            <!-- BEGIN (write your solution here) -->
            <h1>@yield('header')</h1>
            <div>
                @yield('content')
            </div>
            <!-- END -->
        </div>
    </body>
</html>

resources/views/about.blade.php

<!-- BEGIN (write your solution here) -->
@extends('layouts.app')

@section('header', 'О блоге')


@section('content')
    <p>Эксперименты с Ларавелем на Хекслете</p>
@endsection
<!-- END -->

resources/views/articles.blade.php

<!-- BEGIN (write your solution here) -->
@extends('layouts.app')

@section('header', 'Статьи')

@section('content')
    <p>Тут будут статьи</p>
@endsection
<!-- END -->

________________________________________________________________________________________________________________________

database/migrations/2020_03_17_172941_add_views_count_to_articles.php
Добавьте поле views_count (количество просмотров) в таблицу статей

____



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewsCountToArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // BEGIN (write your solution here)
            $table->integer('views_count');
            // END
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            // BEGIN (write your solution here)
            $table->dropColumn('views_count');
            // END
        });
    }
}

_________________________________________________________________________________________________________________________

routes/web.php
Реализуйте обработчик маршрута articles, который извлекает из базы данных все статьи и выводит их в шаблон.

Получите из базы все статьи и передайте их в шаблон
Выведите их в шаблоне

____

articles.blade.php

<!-- BEGIN (write your solution here) -->
@extends('layouts.app')

@section('content')
     @foreach ($articles as $article)
        <h2>{{ $article->name }}</h2>
        <p>{{ $article->body }}</p>
    @endforeach
@endsection
<!-- END -->

web.php



use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// BEGIN (write your solution here)
Route::get('/articles', function () {
    $articles = App\Models\Article::all();
    return view('articles', ['articles' => $articles]);
});
// END

___________________________________________________________________________________________________________________________

Реализуйте рейтинг статей. Он должен быть доступен по ссылке /rating. На этой странице нужно вывести опубликованные статьи отсортированные по количеству лайков.

routes/web.php
Реализуйте маршрут /rating и свяжите его с index экшеном контроллера RatingController.

app/Http/Controller/RatingController.php
Создайте контроллер и экшен index. Извлеките из базы все статьи и выполните нужные преобразования (взять только опубликованные, отсортировать их) над коллекцией перед ее передачей в шаблон.

Метод isPublished() у статьи позволяет узнать опубликована она или нет
Количество лайков можно узнать обратившись к свойству likes_count
resources/views/rating/index.blade.php
Выведите статьи в табличном виде. Для каждой статьи нужно вывести количество лайков и название.

____

routes/web.php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// BEGIN (write your solution here)
Route::get('rating', [RatingController::class, 'index']);
// END

app/Http/Controller/RatingController.php



namespace App\Http\Controllers;

use App\Models\Article;

// BEGIN (write your solution here)

class RatingController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $articlesForRating = $articles->filter(function ($a) {
            return $a->isPublished();
        })->sortByDesc('likes_count');
        return view('rating.index', ['articles' => $articlesForRating]);
    }

}
// END

resources/views/rating/index.blade.php

{{-- BEGIN (write your solution here) --}}
@extends('layouts.app')

@section('content')
<table>
        <tr>
            <th>Название</th>
            <th>Количество лайков</th>
        </tr>
        @foreach ($articles as $article)
        <tr>
            <td>{{ $article->name }}</td>
            <td>{{ $article->likes_count }}</td>
        </tr>
        @endforeach
</table>
@endsection
{{-- END --}}

__________________________________________________________________________________________________________________________

routes/web.php
Реализуйте маршрут article_categories и свяжите его с index экшеном контроллера ArticleCategoryController. Сделайте маршрут именованным.

app/Http/Controller/ArticleCategoryController.php
Создайте контроллер (используя artisan) и экшен index. Извлеките из базы все категории и передайте их в шаблон.

Бонусное задание: выведите данные с пейджингом, по 10 элементов на страницу

resources/views/article_category/index.blade.php
Подключите макет
Выведите категории любым удобным способом. Для каждой категории нужно вывести ее название и описание.
resources/views/layouts/app.blade.php
Добавьте ссылку (через хелпер route) ведущую на страницу категорий.

____

routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ArticleController, ArticleCategoryController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('articles', [ArticleController::class, 'index'])
    ->name('articles.index');

// BEGIN (write your solution here)
Route::get('article_categories', [ArticleCategoryController::class, 'index'])
    ->name('article_categories.index');
// END

app/Http/Controller/ArticleCategoryController.php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $categories = ArticleCategory::all();
        return view('article_category.index', compact('categories'));
    }
}

resources/views/article_category/index.blade.php

{{-- BEGIN (write your solution here) --}}
@extends('layouts.app')

@section('content')
    @foreach ($categories as $category)
        <h2>{{$category->name}}</h2>
        <div>{{Str::limit($category->description, 200)}}</div>
    @endforeach
@endsection
{{-- END --}}

resources/views/layouts/app.blade.php

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="container mt-4">
            <a href="{{ route('articles.index') }}">Статьи</a>
            {{-- BEGIN (write your solution here) --}}
            <a href="{{ route('article_categories.index') }}">Категории</a>
            {{-- END --}}
        </div>
        <div class="container mt-4">
            @yield('content')
        </div>
    </body>
</html>

__________________________________________________________________________________________________________________________

В этом упражнении нужное реализовать страницу категории, на которой выводится список статей этой категории.

routes/web.php
Реализуйте маршрут article_categories/{id} и свяжите его с show экшеном контроллера ArticleCategoryController. Сделайте маршрут именованным.

app/Http/Controller/ArticleCategoryController.php
Создайте экшен show.
Извлеките из базы текущую запрошенную категорию и передайте её в шаблон.
resources/views/article_category/show.blade.php
Подключите макет.
Выведите имя и описание категории.
Выведите список названий статей категории в виде <ol> списка. Если статей в категории нет, то тег <ol> не должен отображаться. Каждое название – ссылка на саму статью (маршрут подсмотрите в файле роутов).
resources/views/article/show.blade.php
Добавьте ссылку на категорию статьи рядом с именем статьи.

____

routes/web.php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ArticleController, ArticleCategoryController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('articles', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('articles/{id}', [ArticleController::class, 'show'])
    ->name('articles.show');

Route::get('article_categories', [ArticleCategoryController::class, 'index'])
    ->name('article_categories.index');

// BEGIN (write your solution here)
Route::get('article_categories/{id}', [ArticleCategoryController::class, 'show'])
  ->name('article_categories.show');
// END

app/Http/Controller/ArticleCategoryController.php



namespace App\Http\Controllers;

use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $articleCategories = ArticleCategory::all();
        return view('article_category.index', compact('articleCategories'));
    }

    // BEGIN (write your solution here)
    public function show($id)
    {
        $category = ArticleCategory::findOrFail($id);
        return view('article_category.show', compact('category'));
    }
    // END
}

resources/views/article_category/show.blade.php

{{-- BEGIN (write your solution here) --}}
@extends('layouts.app')

@section('content')
    <h1>{{$category->name}}</h1>
    <div>{{$category->description}}</div>
    @if ($category->articles->isNotEmpty())
        <ol>
            @foreach ($category->articles as $article)
                <a href="{{ route('articles.show', $article) }}"> {{ $article->name }} </a>
            @endforeach
        </ol>
    @endif
@endsection
{{-- END --}}

resources/views/article/show.blade.php

@extends('layouts.app')

@section('content')
    <h1>{{$article->name}}</h1>
    {{-- BEGIN (write your solution here) --}}
    <a href="{{ route('article_categories.show', $article->category) }}"> {{ $article->category }} </a>
    {{-- END --}}
    <div>{{$article->body}}</div>
@endsection

________________________________________________________________________________________________________________________

В этом упражнении нужно реализовать поисковую форму, которая позволяет отфильтровать статьи по слову, встречающемуся в названии статьи. Форма состоит из двух элементов: текстового поля (имя поля q, это важно для тестов) и кнопки "найти". Она ведет на тот же маршрут, который выводит список всех статей.

app/Http/Controller/ArticleController.php
Реализуйте экшен index. Если клиент прислал запрос из формы, выполните необходимую фильтрацию данных через правильный запрос в базу данных.

resources/views/article/index.blade.php
Выведите форму. Убедитесь что она работает.
Реализуйте подстановку данных в форму после запроса.

____

app/Http/Controller/ArticleController.php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    // BEGIN (write your solution here)
    public function index(Request $request)
    {

        $q = $request->input('q');
        $articles = Article::where('name', 'ilike', "%{$q}%")->get();
        return view('article.index', compact('articles', 'q'));
    }
    // END

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }
}

resources/views/article/index.blade.php

@extends('layouts.app')

@section('content')
    {{-- BEGIN (write your solution here) --}}

    {{Form::open(['route' => 'articles.index', 'method' => 'GET'])}}
    {{Form::text('q', $q)}}
    {{Form::submit('Найти')}}
    {{Form::close()}}

    {{-- END --}}
    <h1>Список статей</h1>
    @foreach($articles as $article)
        <h2>{{$article->name}}</h2>
        <div>{{Str::limit($article->body, 200)}}</div>
    @endforeach
@endsection

________________________________________________________________________________________________________________________

routes/web.php
Добавьте маршруты для создания категории.

exercise/resources/views/article_category/index.blade.php
Добавьте ссылку на создание категории.

app/Http/Controller/ArticleCategoryController.php
Реализуйте экшены для создания категории. Добавьте следующие валидации:

Имя (name) – обязательно и должно быть максимум 100 знаков.
Описание (description) – обязательно и должно быть минимум 200 знаков.
Состояние (state) – может быть либо draft либо published.
resources/views/article_category/create.blade.php
Реализуйте форму создания категории. Добавьте три поля:

Имя
Описание
Состояние
Добавьте вывод ошибок.

_____

routes/web.php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ArticleController, ArticleCategoryController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('articles', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('articles/{id}', [ArticleController::class, 'show'])
    ->name('articles.show');

// BEGIN (write your solution here)
Route::get('article_categories/create', [ArticleCategoryController::class, 'create'])
  ->name('article_categories.create');

Route::post('article_categories', [ArticleCategoryController::class, 'store'])
  ->name('article_categories.store');
// END

Route::get('article_categories', [ArticleCategoryController::class, 'index'])
    ->name('article_categories.index');

Route::get('article_categories/{id}', [ArticleCategoryController::class, 'show'])
    ->name('article_categories.show');

exercise/resources/views/article_category/index.blade.php

@extends('layouts.app')

@section('content')
    {{-- BEGIN (write your solution here) --}}
    <a href="{{ route('article_categories.create') }}">создать категорию</a>
    {{-- END --}}
    <h1>Список категорий статей</h1>
    @foreach($articleCategories as $category)
        <h2><a href="{{ route('article_categories.show', $category) }}">{{$category->name}}</a></h2>
        <div>{{$category->description}}</div>
    @endforeach
@endsection

app/Http/Controller/ArticleCategoryController.php



namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $articleCategories = ArticleCategory::orderBy('id', 'desc')->get();
        return view('article_category.index', compact('articleCategories'));
    }

    public function show($id)
    {
        $category = ArticleCategory::findOrFail($id);
        return view('article_category.show', compact('category'));
    }

    // BEGIN (write your solution here)
    public function create()
    {
        $category = new ArticleCategory();
        return view('article_category.create', compact('category'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|max:100',
            'description' => 'required|min:200',
            'state' => 'in:draft,published'
        ]);

        $category = new ArticleCategory();
        $category->fill($data);
        $category->save();

        return redirect()
            ->route('article_categories.index');
    }
    // END
}

resources/views/article_category/create.blade.php

@extends('layouts.app')

@section('content')
    {{-- BEGIN (write your solution here) --}}
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::model($category, ['route' => 'article_categories.store']) }}
    {{ Form::label('name', 'Название') }}
    {{ Form::text('name') }}<br>
    {{ Form::label('description', 'Описание') }}
    {{ Form::textarea('body') }}<br>
    {{ Form::label('state', 'Состояние') }}
    {{ Form::select('size', ['draft' => 'draft', 'published' => 'published']) }}
    {{ Form::submit('Создать') }}
    {{ Form::close() }}

    {{-- END --}}
@endsection

________________________________________________________________________________________________________________________

routes/web.php
Добавьте маршруты для редактирования категории

app/Http/Controller/ArticleCategoryController.php
Реализуйте экшены для редактирования категории. Добавьте валидации аналогичные тем что были при создании.

resources/views/article_category/edit.blade.php
Реализуйте форму редактирования категории.

resources/views/article_category/form.blade.php
Вынесите сюда общие части для create и edit форм

____

routes/web.php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ArticleController, ArticleCategoryController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('articles', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('articles/{id}', [ArticleController::class, 'show'])
    ->name('articles.show');

Route::get('article_categories/create', [ArticleCategoryController::class, 'create'])
  ->name('article_categories.create');

Route::post('article_categories', [ArticleCategoryController::class, 'store'])
  ->name('article_categories.store');

// BEGIN (write your solution here)
Route::get('article_categories/{id}/edit', [ArticleCategoryController::class, 'edit'])
  ->name('article_categories.edit');

Route::patch('article_categories/{id}', [ArticleCategoryController::class, 'update'])
  ->name('article_categories.update');
// END

Route::get('article_categories', [ArticleCategoryController::class, 'index'])
    ->name('article_categories.index');

Route::get('article_categories/{id}', [ArticleCategoryController::class, 'show'])
    ->name('article_categories.show');

app/Http/Controller/ArticleCategoryController.php



namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $articleCategories = ArticleCategory::orderBy('id', 'desc')->get();
        return view('article_category.index', compact('articleCategories'));
    }

    public function show($id)
    {
        $category = ArticleCategory::findOrFail($id);
        return view('article_category.show', compact('category'));
    }

    // BEGIN (write your solution here)
    public function update(Request $request, $id)
    {
        $category = ArticleCategory::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|unique:article_categories,name',
            'description' => 'required|min:200',
            'state' => [
                'required',
                Rule::in(['draft', 'published']),
            ]
        ]);

        $category->fill($data);
        $category->save();
        return redirect()
            ->route('article_categories.index');
    }

    public function edit($id)
    {
        $category = ArticleCategory::findOrFail($id);
        return view('article_category.edit', compact('category'));
    }
    // END

    public function create()
    {
        $category = new ArticleCategory();
        return view('article_category.create', compact('category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:article_categories',
            'description' => 'required|min:200',
            'state' => [
                'required',
                Rule::in(['draft', 'published']),
            ]
        ]);

        $category = new ArticleCategory();
        $category->fill($request->all());
        $category->save();

        return redirect()
            ->route('article_categories.index');
    }
}

resources/views/article_category/edit.blade.php

@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- BEGIN (write your solution here) --}}

{{ Form::model($category, ['route' => ['article_categories.update', $category], 'method' => 'PATCH']) }}
    @include('article_category.form')
    {{ Form::submit('Обновить') }}
{{ Form::close() }}

    {{-- END --}}
@endsection

resources/views/article_category/form.blade.php

{{-- BEGIN (write your solution here) --}}

{{ Form::label('name', 'Название') }}
{{ Form::text('name') }}<br>
{{ Form::label('description', 'Описание') }}
{{ Form::textarea('description') }}<br>
{{ Form::label('state', 'Состояние') }}
{{ Form::select('size', ['draft' => 'draft', 'published' => 'published']) }}
{{-- END --}}

___________________________________________________________________________________________________________________________

routes/web.php
Добавьте маршрут для удаления категории.

app/Http/Controller/ArticleCategoryController.php
Реализуйте экшен для удаления категории.

resources/views/article_category/index.blade.php
Выведите ссылку на удаление статьи. Добавьте подтверждение удаления и отправку данных методом DELETE.

____

routes/web.php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ArticleController, ArticleCategoryController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('articles', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('article_categories', [ArticleCategoryController::class, 'index'])
  ->name('article_categories.index');

Route::get('articles/{id}', [ArticleController::class, 'show'])
  ->name('articles.show');

Route::get('article_categories/create', [ArticleCategoryController::class, 'create'])
  ->name('article_categories.create');

Route::post('article_categories', [ArticleCategoryController::class, 'store'])
  ->name('article_categories.store');

Route::get('article_categories/{id}/edit', [ArticleCategoryController::class, 'edit'])
  ->name('article_categories.edit');

Route::patch('/article_categories/{id}', [ArticleCategoryController::class, 'update'])
  ->name('article_categories.update');

// BEGIN (write your solution here)
Route::delete('article_categories/{id}', [ArticleCategoryController::class, 'destroy'])
  ->name('article_categories.destroy');
// END

Route::get('article_categories/{id}', [ArticleCategoryController::class, 'show'])
    ->name('article_categories.show');

app/Http/Controller/ArticleCategoryController.php



namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $articleCategories = ArticleCategory::orderBy('id', 'desc')->get();
        return view('article_category.index', compact('articleCategories'));
    }

    public function show($id)
    {
        $category = ArticleCategory::findOrFail($id);
        return view('article_category.show', compact('category'));
    }

    public function edit($id)
    {
        $category = ArticleCategory::findOrFail($id);
        return view('article_category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = ArticleCategory::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|unique:article_categories,name,' . $category->id,
            'description' => 'required|min:200',
            'state' => [
                'required',
                Rule::in(['draft', 'published']),
            ]
        ]);

        $category->fill($request->all());
        $category->save();
        return redirect()
            ->route('article_categories.index');
    }

    public function create()
    {
        $category = new ArticleCategory();
        return view('article_category.create', compact('category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:article_categories',
            'description' => 'required|min:200',
            'state' => [
                'required',
                Rule::in(['draft', 'published']),
            ]
        ]);

        $category = new ArticleCategory();
        $category->fill($request->all());
        $category->save();

        return redirect()
            ->route('article_categories.index');
    }

    // BEGIN (write your solution here)
    public function destroy($id)
    {
        // DELETE — идемпотентный метод, поэтому результат операции всегда один и тот же
        $category = ArticleCategory::find($id);
        if ($category) {
        $category->delete();
        }
        return redirect()->route('article_categories.index');
    }
    // END
}


resources/views/article_category/index.blade.php

@extends('layouts.app')

@section('content')
    <small><a href="{{ route('article_categories.create') }}">Создать категорию</a></small>
    <h1>Список категорий статей</h1>
    @foreach($articleCategories as $category)
        <h2>
            <a href="{{ route('article_categories.show', $category) }}">{{$category->name}}</a>
            (
                <a href="{{ route('article_categories.edit', $category) }}">Edit</a>
                {{-- BEGIN (write your solution here) --}}
             <a href="{{ route('article_categories.destroy', $category) }}"
                    data-method="delete"
                    rel="nofollow"
                    data-confirm="Are you sure?">Delete</a>
                {{-- END --}}

            )
        </h2>
        <div>{{$category->description}}</div>
    @endforeach
@endsection

_________________________________________________________________________________________________________________________

В этом уроке вам предстоит добавить вложенный ресурс – комментарий к статье. Его особенность в том, что список комментариев и создание комментария выводятся на странице самой статьи. Все остальное уже во вложенном ресурсе.

В целях простоты в этом проекте не учитываются пользователи. В реальной жизни комментарии принадлежат пользователям и только они могут управлять ими. Поэтому придется делать авторизацию.

app/Http/Controller/ArticleCommentController.php
Сгенерируйте ресурсный контроллер. Добавьте все нужные экшены (кроме списка и формы создания). Добавьте минимальную валидацию: длина комментария не может быть меньше 10 символов.

resources/views/article_comment/edit.blade.php
Реализуйте редактирование комментария.

____

app/Http/Controller/ArticleCommentController.php



namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Http\Request;

class ArticleCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    // public function index(Article $article)
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    // public function create(Article $article)
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $validated = $this->validate($request, [
            'content' => 'required|min:10'
        ]);

        $comment = $article->comments()->make();
        $comment->fill($validated);
        $comment->save();

        return redirect()
            ->route('articles.show', $article);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @param  \App\Models\ArticleComment  $articleComment
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @param  \App\Models\ArticleComment  $articleComment
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article, ArticleComment $comment)
    {
        return view('article_comment.edit', compact('article', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @param  \App\Models\ArticleComment  $articleComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article, ArticleComment $comment)
    {
        $validated = $this->validate($request, [
            'content' => 'required|min:10'
        ]);

        $comment->fill($validated);
        $comment->save();
        return redirect()
            ->route('articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @param  \App\Models\ArticleComment  $articleComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article, ArticleComment $comment)
    {
        $comment->delete();
        return redirect()->route('articles.show', $article);
    }
}

resources/views/article_comment/edit.blade.php

@extends('layouts.app')

@section('content')
    <h1>{{$article->name}}</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- BEGIN (write your solution here) --}}

    {{ Form::model($comment, ['method' => 'PATCH', 'url' => route('articles.comments.update', [$article, $comment])]) }}
        {{ Form::textarea('content') }}
        {{ Form::submit('Update') }}
    {{ Form::close() }}

    {{-- END --}}
@endsection












