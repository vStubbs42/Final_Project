<?php
namespace App\Controllers;
use App\Core\App;

class PostsController {

    public function index()
    {
        $posts = App::get('database')->getAll('posts');

        return view('posts-index', compact('posts'));
    }

    public function create()
    {
        return view('posts-create');
    }

    public function store()
    {
        //uraditi prethodno sanitizaciju i validaciju !
        App::get('database')->insert('posts', $_POST);

        return redirect('/posts');
    }

    public function show()
    {
        $post = App::get('database')->getOne('posts', $_GET['id']);

        return view('posts-show', compact('post'));
    }

    public function edit()
    {
        $post = App::get('database')->getOne('posts', $_GET['id']);

        return view('posts-edit', compact('post'));
    }

    public function update()
    {
        //uraditi validaciju
        App::get('database')->update('posts', $_POST);

        return redirect('/posts');
    }

    public function destroy()
    {
        App::get('database')->delete('posts', $_GET['id']);

        return redirect('/posts');

    }
    
}