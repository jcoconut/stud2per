<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Blog extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blogs';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = array('password', 'remember_token');
    protected $fillable = array(
        'title',
        'user_id',
        'body',
        'random',
        'private',
        'color',
        'tag',
    );

    public static $rules = array(
        'title' => 'Required|Min:4|Max:100',
        'body'     => 'Required|Min:100|Max:5000',
        'random'   => 'numeric',
        'private'  => 'numeric',
        'color' => 'numeric',
    );


    public static function register($data) {
        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->body = $data['body'];
        $blog->random = $data['random'];
        $blog->private = $data['private'];
        $blog->user_id = $data['user_id'];
        $blog->color = $data['color'];
        $blog->tag = $data['tag'];
        $blog->save();
        return $blog->id;
    }

    public static function validate($data) {
        return Validator::make($data, static::$rules);
    }

    public static function allBlogs() {
        $get = array(
            'name',
            'username',
            'blogs.id',
            'body',
            'title',
            'color',
            'tag',
            'private',
            'random',
            'blogs.created_at'
        );
        return DB::table('blogs')->select($get)->where('user_id', Auth::user()->id)
            ->join('users','users.id','=','blogs.user_id')->orderBy('id','DESC')->paginate(10);
    }

    public static function getBlog($id) {
        $get = array(
            'name',
            'username',
            'blogs.id',
            'body',
            'title',
            'color',
            'tag',
            'private',
            'random',
            'user_id',
            'blogs.created_at'
        );

        return DB::table('blogs')->select($get)->where('blogs.id', $id)
            ->join('users','users.id','=','blogs.user_id')->first();
    }
    public function searchBlogs($tag)
    {
        $get = array(
            'name',
            'username',
            'blogs.id',
            'body',
            'title',
            'color',
            'tag',
            'private',
            'random',
            'user_id',
            'blogs.created_at'
        );
        return DB::table('blogs')->select($get)
            ->where('tag', 'LIKE', "%$tag%")
            ->where('private', 0)
            ->join('users','users.id','=','blogs.user_id')->orderBy('id','DESC')->paginate(10);
    }

    public static function updateBlog($id, $data) {

        DB::table('blogs')
            ->where('id', $id)
            ->update($data);
    }

    public static function getIds()
    {
        return DB::table('blogs')->select('id')
            ->where('private', 0)
            ->where('random', 1)
            ->orderBy('id','DESC')->get();
    }

    public static function test()
    {
        return DB::table('blogs')
            ->select('tag', DB::raw('count(*) as total'))
            ->where('private', 0)
            ->groupBy('tag')
            ->orderBy('total', 'DESC')
            ->limit('10')->get();
    }
}
