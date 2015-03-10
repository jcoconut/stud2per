<?php

class HomeController extends BaseController {

	public function index()
	{
		return View::make('index/index');
	}

    public function mypart()
    {
        if (!Auth::check())
        {
            return Redirect::to('');
        }
        $blogs = Blog::allBlogs();
        $top = Blog::test();
        return View::make('index/mypart',$blogs)->with('blogs',$blogs)->with('top', $top);

    }

    public function tag($tag)
    {
        if (!Auth::check())
        {
            return Redirect::to('');
        }
        $blogs = new Blog();
        $blogs = $blogs->searchBlogs($tag);
        $top = Blog::test();
        return View::make('index/tag',$blogs)->with('blogs', $blogs)->with('top', $top);
    }

    public function create()
    {
        if (!Auth::check())
        {
            return Redirect::to('');
        }
        return View::make('index/create');
    }

    public function create_action()
    {
        $validate = Blog::validate(Input::all());
        if($validate->fails()){
            return Redirect::to('create')->withInput()->withErrors($validate,'create');
        }
        $data = array(
            'title' => Input::get('title'),
            'body' => Input::get('body'),
            'random' => Input::get('random', 0),
            'private' => Input::get('private', 0),
            'color' => Input::get('color', 0),
            'tag' => Input::get('tag'),
            'user_id' => Auth::user()->id,
        );

        Blog::create($data);

        Session::flash('success', Config::get('constants.BLOG_OK'));
        return Redirect::to('mypart');
    }

    public function edit($id)
    {
        if (!Auth::check())
        {
            return Redirect::to('');
        }
        $blog = Blog::find($id);
        if($blog) {
            return View::make('index/edit')->with('blog', $blog);
        }
        return $blog; //TODO
    }

    public function edit_action()
    {
        $validate = Blog::validate(Input::all());
        if($validate->fails()){
            return Redirect::back()->withInput()->withErrors($validate,'create');
        }
        $data = array(
           'title' => Input::get('title'),
           'body' => Input::get('body'),
            'tag' => Input::get('tag'),
            'random' => Input::get('random'),
            'private' => Input::get('private'),
            'color' => Input::get('color'),
        );
        Blog::updateBlog(Input::get('id'), $data);

        Session::flash('success', Config::get('constants.BLOG_EDIT_OK'));
        return Redirect::to('mypart');
    }

    public function delete_action($id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        Session::flash('success', Config::get('constants.BLOG_DELETE_OK'));
        return Redirect::to('mypart');
    }

    public function random()
    {
        $ids =  Blog::getIds();
        $i = array_rand($ids, 1);
        $blog = Blog::getBlog($ids[$i]->id);
        $top = Blog::test();
        return View::make('index/random')->with('blog', $blog)->with('top' ,$top);
    }

}
