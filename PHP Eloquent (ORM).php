

/*
Добавьте в схему таблицу posts. Структура таблицы:

id – идентификатор. Тип: bigint.
state – состояние публикации (опубликован/не опубликован). Тип: string. Может отсутствовать.
title – Заголовок поста. Тип: string.
body – Тело поста. Тип: text.
created_at/updated_at – Автоматические поля через метод timestamps().
*/

<?php

namespace App\config\schema;

use Illuminate\Database\Capsule\Manager as Capsule;

function load()
{
    if (!Capsule::schema()->hasTable('users')) {
        Capsule::schema()->create('users', function ($table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }
    if (!Capsule::schema()->hasTable('posts')) {
        // BEGIN (write your solution here)
        Capsule::schema()->create('posts', function ($table) {
            $table->bigIncrements('id');
            $table->string('state')->nullable();
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });
        // END
    }
}
________________________________________________________________________________________________________________________


/*
В этом задании нужно реализовать функции, которые выполняют стандартный набор действий называемых для любой сущности:

Работа со списком сущностей
Создание новой сущности
Обновление существующей
Удаление
Для хеширования паролей воспользуйтесь функцией password_hash()

<?php
password_hash('password', PASSWORD_DEFAULT);
// "$2y$10$aqnIg/V9zGHKMoqIPDIMt.MNz.h6NSIFwQwzQOVaWTQMjLFC8bgoS"
src/actions/Users.php
index

Возвращает список всех пользователей. Используйте метод all()

create

Создает нового пользователя на основе переданного массива параметров. В функцию передаются: first_name, last_name, password, email. Все параметры обязательные. Функция должна вернуть нового, сохраненного в базе, пользователя.

update

Обновляет и возвращает пользователя. Принимает на вход идентификатор и набор параметров таки же как при создании. В отличие от создания, часть параметров может отсутствовать (значит надо проверять их существование в $params). Используйте метод findOrFail()

delete

Удаляет пользователя по переданному идентификатору. Если пользователь успешно удален, то возвращается true, если пользователь уже был удален, то возвращается false. То есть операция идемпотентная. Для удаления используйте метод delete()
*/

<?php

namespace App\actions;

use App\Models\User;

class Users
{
    public static function index()
    {
        // BEGIN (write your solution here)
        return User::all();
        // END
    }

    public static function create($params)
    {
        // BEGIN (write your solution here)
        $user = new User();
        $user->first_name = $params['first_name'];
        $user->last_name = $params['last_name'];
        $user->password = password_hash($params['password'], PASSWORD_DEFAULT);
        $user->email = $params['email'];
        $user->save();
        return $user;

        // END
    }

    public static function update($id, $params)
    {
        // BEGIN (write your solution here)
        $user = User::findOrFail($id);
        if(array_key_exists('first_name', $params)) {
            $user->first_name = $params['first_name'];
        }
        if(array_key_exists('last_name', $params)) {
            $user->last_name = $params['last_name'];
        }
        if(array_key_exists('password', $params)) {
            $user->password = password_hash($params['password'], PASSWORD_DEFAULT);
        }
        if(array_key_exists('email', $params)) {
            $user->email = $params['email'];
        }
        $user->save();
        return $user;

        // END
    }

    public static function delete($id)
    {
        // BEGIN (write your solution here)
        $user = User::find($id);
        if(!$user) {
            return false;
        }
        $user->delete();
        return true;
        // END
    }
}
________________________________________________________________________________________________________________________


/*
src/Models/User.php
Заполните свойство $fillable.

src/actions/Users.php
Реализуйте create и update используя mass-assigment.
*/

src/Models/User.php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    // BEGIN (write your solution here)
    protected $fillable = ['first_name', 'last_name', 'email'];
    // END
}

src/actions/Users.php



namespace App\actions;

use App\Models\User;

class Users
{
    public static function create($params)
    {
        // BEGIN (write your solution here)
        $user = new User($params);
        if (array_key_exists('password', $params)) {
            $user->password = password_hash($params['password'], PASSWORD_DEFAULT);
        }
        $user->save();
        return $user;
        // END
    }

    public static function update($id, $params)
    {
        // BEGIN (write your solution here)
        $user = User::find($id);
        $user->fill($params);
        if (array_key_exists('password', $params)) {
            $user->password = password_hash($params['password'], PASSWORD_DEFAULT);
        }
        $user->save();
        return $user;
        // END
    }
}
________________________________________________________________________________________________________________________


/*
Реализуйте фильтрацию пользователей в методе index.

На вход в этот метод приходит массив, сформированный особым образом. Внутри он анализируется и строится запрос, который возвращает наружу отфильтрованный список пользователей. Все данные в этом массиве не обязательные. В самом простом случае он может прийти пустым. Ниже более полный пример:

<?php

$params = [
  'q' => [
    'email' => 'lala@ehu.com',
    'first_name' => 'Mike'
  ],
  's' => 'id:desc'
];
s – сортировка. В значении строка в которой соединены двоеточием поле по которому идет сортировка и направление сортировки (asc или desc).
q – ассоциативный массив. Ключ – имя поля, значение – точное значение в базе данных. Поиск значений в q должен происходить по условию OR (orWhere).
*/



namespace App\actions;

use App\Models\User;

class Users
{
    public static function index($params = [])
    {
        // BEGIN (write your solution here)
        $scope = User::query();

        if (array_key_exists('s', $params)) {
            $sorting = $params['s'];
            [$fildName, $direction] = explode(':', $sorting);
            $scope->orderBy($fildName, $direction);
        }

        if (array_key_exists('q', $params)) {
            $search = $params['q'];
            $scope->orWhere($search);
        }

        return $scope->get();
        // END
    }
}
________________________________________________________________________________________________________________________



/*
src/Models/PostLike.php
Реализуйте сущность PostLike со следующими полями:

creator_id – пользователь оставивший лайк
post_id – пост к которому прикреплен лайк
Добавьте связи с постом и пользователем.

src/config/schema.php
Добавьте в схему описание таблицы лайков.

src/Models/Post.php
Реализуйте связь поста с лайками.

src/Models/User.php
Реализуйте связь пользователя с лайками.

src/actions/Posts.php
Реализуйте следующие обработчики:

create($user, $params): Post – создание поста. Метод должен вернуть сохраненный пост.
createLike($user, $post): PostLike – создание лайка. Метод должен вернуть сохраненный лайк.
*/

src/Models/PostLike.php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// BEGIN (write your solution here)
class PostLike extends Model
{
    public function creator()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User');
    }

    public function post()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Post');
    }
}

// END

src/config/schema.php



namespace App\config\schema;

use Illuminate\Database\Capsule\Manager as Capsule;

function load()
{
    if (Capsule::schema()->hasTable('post_likes')) {
        Capsule::schema()->drop('post_likes');
    }

    if (Capsule::schema()->hasTable('posts')) {
        Capsule::schema()->drop('posts');
    }

    if (Capsule::schema()->hasTable('users')) {
        Capsule::schema()->drop('users');
    }

    Capsule::schema()->create('users', function ($table) {
        $table->bigIncrements('id');
        $table->string('email')->unique();
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('password')->nullable();
        $table->timestamps();
    });

    Capsule::schema()->create('posts', function ($table) {
        $table->bigIncrements('id');
        $table->string('state')->nullable();
        $table->string('title');
        $table->text('body');
        $table->bigInteger('creator_id');
        $table->foreign('creator_id')->references('id')->on('users');
        $table->timestamps();
    });

    // BEGIN (write your solution here)
    Capsule::schema()->create('post_likes', function ($table) {
        $table->bigIncrements('id');
        $table->bigInteger('creator_id');
        $table->foreign('creator_id')->references('id')->on('users');
        $table->bigInteger('post_id');
        $table->foreign('post_id')->references('id')->on('posts');
        $table->timestamps();
    });
    // END
}

src/Models/Post.php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public function creator()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User');
    }

    // BEGIN (write your solution here)
    public function likes()
    {
        return $this->hasMany(__NAMESPACE__ . '\PostLike');
    }
    // END
}

src/Models/User.php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'first_name', 'last_name'];

    public function posts()
    {
        return $this->hasMany(__NAMESPACE__ . '\Post', 'creator_id');
    }


    // BEGIN (write your solution here)
    public function postLikes()
    {
        return $this->hasMany(__NAMESPACE__ . '\PostLike', 'creator_id');
    }
    // END
}

src/actions/Posts.php



namespace App\actions;

class Posts
{
    public static function create($user, $params)
    {
        // BEGIN (write your solution here)
        $post = $user->posts()->make($params);
        $post->save();
        return $post;
        // END
    }

    public static function createLike($user, $post)
    {
        // BEGIN (write your solution here)
        $like = $post->likes()->make();
        $like->creator()->associate($user);
        $like->save();

        return $like;
        // END
    }
}
________________________________________________________________________________________________________________________



/*
В этом задании немного кода, но он включает в себя использование большого числа возможностей Query Builder и Collection. Возможно придется попотеть.

Эту задачу можно реализовать огромным числом способов. Обратите внимание на то что делается в базе, а что делается в коде. Постарайтесь решить задачу хоть как-то, а потом уже думайте о том как сделать код лучше. Думайте про алгоритмическую сложность.

src/actions/Posts.php
Реализуйте метод index($user, $limit), который возвращает список постов с добавленной отметкой о том лайкал ли текущий пользователь этот пост или нет. $limit ограничивает количество постов. Пример вызова:

<?php

$result = Posts::index($user, 10);
/*
 * [
 *     ['post' => [...], 'liked' => true],
 *     ['post' => [...], 'liked' => false],
 *     ['post' => [...], 'liked' => true],
 * ]
 */
Каждый пост в этом массиве представлен обычным ассоциативным массивом.
*/

<?php

namespace App\actions;

use App\Models\Post;

class Posts
{
    public static function index($user, $limit)
    {
        // BEGIN (write your solution here)
        $posts = Post::limit($limit)->orderBy('created_at', 'desc')->get();
        $postIds = $posts->pluck('id');
        $likedPostIds = $user->postLikes()->whereIn('post_id', $postIds)->pluck('post_id');

        $result = $posts->map(function ($post) use ($likedPostIds) {
            return ['post' => $post->toArray(), 'liked' => $likedPostIds->contains($post->id)];
        });

        return $result;
        // END
    }
}
________________________________________________________________________________________________________________________


/*
src/Post.php
Реализуйте следующие скоупы:

Скоуп "опубликованные посты": where('state', 'published').
"Самые залайканные с лимитом": orderBy('likes_count', 'desc')->limit($limit)
src/actions/Posts.php
Реализуйте метод index($user, $limit), который возвращает список самых популярных (больше всего лайков) опубликованных постов:

<?php

$posts = Posts::index($user, 2);

*/

src/Post.php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public function creator()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User', 'creator_id');
    }

    public function posts()
    {
        return $this->hasMany(__NAMESPACE__ . '\Post', 'creator_id');
    }

    public function likes()
    {
        return $this->hasMany(__NAMESPACE__ . '\PostLike');
    }

    // BEGIN (write your solution here)
    public function scopePublished($query)
    {
        return $query->where('state', 'published');
    }

    public function scopePopular($query, $limit)
    {
        return $query->orderBy('likes_count', 'desc')->limit($limit);
    }

    // END
}

src/actions/Posts.php



namespace App\actions;

class Posts
{
    public static function index($user, $limit)
    {
        // BEGIN (write your solution here)
        return $user->posts()->published()->popular($limit);
        // END
    }
}
________________________________________________________________________________________________________________________






