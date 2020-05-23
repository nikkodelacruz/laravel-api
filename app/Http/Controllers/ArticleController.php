<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Articles
        $articles = Article::paginate(5);

        // return collection of articles as a resource
        return ArticleResource::collection($articles);
        // return Article::all();

    }

    public function latest()
    {
        // get only 5 articles and desc by date created
        $articles = Article::orderBy('created_at', 'desc')->take(5)->get();
        return ArticleResource::collection($articles);
    }

    public function all()
    {
        // get all artice
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // add data to article
        $article = $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;

        $article->id = $request->input('article_id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if ($article->save()) {
            return new ArticleResource($article);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Single article
        $article = Article::findOrFail($id);

        // Return single article as a resource
        return new ArticleResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if ($article->delete()) {
            return new ArticleResource($article);
        }
    }

    // Pages Controller

    // index
    public function articles() {
        $title = 'Articles';
        // $data = [
        //  'title' => 'Articles',
        //  'articles' => ['A1','A2']
        // ];
        // with($data);
        return view('pages.articles.latest')->with('title', $title);
    }

    // Get all articles
    public function allArticles() {
        return view('pages.articles.all');
    }
}
