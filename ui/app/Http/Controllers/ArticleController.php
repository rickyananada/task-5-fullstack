<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('articles.main', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.input', ['data' => new Article, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:articles|max:255',
            'content' => 'required',
            'image' => 'required',
            'category_id' => 'required',
        ]);

        $article = new Article;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $request->image;
        $article->user_id = $request->user_id;
        $article->category_id = $request->category_id;
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article has been created');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('articles.input', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|unique:articles|max:255',
            'content' => 'required',
            'image' => 'required',
            'category_id' => 'required',
        ]);

        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $request->image;
        $article->user_id = $request->user_id;
        $article->category_id = $request->category_id;
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article has been updated');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article has been deleted');
    }
}
