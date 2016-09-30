<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleReadingAnalysis;
use App\ReadingHistory;
use App\SearchHistory;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends Controller
{

    public function search(Request $request){

        SearchHistory::create([
            'word' => $request['s'],
            'page' => $request -> get('page', 1),
            'user_id' => \Auth::user() -> id,
        ]);

        $articles = Article::search($request['s'],$request['c']);

        return view('article.index', ['articles' => $articles]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        ReadingHistory::create([
            'article_id' => $id,
            'user_id' => \Auth::user() -> id,
        ]);
        return view('article.show',['article' => Article::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('article.edit',['article' => Article::find($id)]);
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
        Article::find($id) -> update($request->all());
        return $this -> success('保存成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
