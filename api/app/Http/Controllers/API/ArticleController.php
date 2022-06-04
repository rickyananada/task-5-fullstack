<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return response()->json($articles, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('title')) {
                return response()->json(['error' => $errors->first('title')], 401);
            } elseif ($errors->has('content')) {
                return response()->json(['error' => $errors->first('content')], 401);
            } elseif ($errors->has('image')) {
                return response()->json(['error' => $errors->first('image')], 401);
            } elseif ($errors->has('category_id')) {
                return response()->json(['error' => $errors->first('category_id')], 401);
            }
        }

        $article = new Article;
        $article->title = $request->title;
        $article->content = $request->content;
        $fileName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $fileName);
        $article->image = $fileName;
        $article->user_id = auth()->guard('api')->user()->id;
        $article->category_id = $request->category_id;
        $article->save();

        return response()->json($article, 200);
    }

    public function show(Article $article)
    {
        return response()->json([
            'title' => $article->title,
            'content' => $article->content,
            'image' => $article->image,
            'user' => $article->user->name,
            'category' => $article->category->name,
        ], 200);
    }

    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('title')) {
                return response()->json(['error' => $errors->first('title')], 401);
            } elseif ($errors->has('content')) {
                return response()->json(['error' => $errors->first('content')], 401);
            } elseif ($errors->has('image')) {
                return response()->json(['error' => $errors->first('image')], 401);
            } elseif ($errors->has('category_id')) {
                return response()->json(['error' => $errors->first('category_id')], 401);
            }
        }

        $article->title = $request->title;
        $article->content = $request->content;
        $fileName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $fileName);
        $article->image = $fileName;
        $article->user_id = auth()->guard('api')->user()->id;
        $article->category_id = $request->category_id;
        $article->save();

        return response()->json($article, 200);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);
    }
}
