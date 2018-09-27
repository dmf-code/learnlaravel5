<?php
/**
 * Created by PhpStorm.
 * User: DMF
 * Date: 2018/9/23
 * Time: 19:15
 */

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Article;

class ArticleController extends Controller
{

    public function index()
    {
        return view('admin/article/index')->withArticles(\App\Article::all());
    }

    public function create()
    {
        return view('admin/article/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:articles|max:255',
            'body' => 'required',
        ]);

        $article = new Article;
        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->user_id = $request->user()->id;

        if ($article->save()) {
            return redirect('admin/articles');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }


    public function edit($id)
    {
        $article = new Article;
        $data = $article->find($id);
        return view('admin/article/edit')->withArticle($data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $article = new Article;
        $datas['title'] = $request->get('title');
        $datas['body'] = $request->get('body');

        if ($article->where('id', $id)->update($datas)) {
            return redirect('admin/articles');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function destroy($id) {
        Article::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功!');
    }

}