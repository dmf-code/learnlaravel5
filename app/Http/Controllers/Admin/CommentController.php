<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
        return view('admin/comment/index')->withComments(Comment::all());
    }
    public function destroy($id)
    {
        Comment::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功');
    }
    public function edit($id)
    {
        $comment = new Comment;
        $data = $comment->find($id);
        return view('admin/comment/edit')->withComment($data);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nickname' => 'required'
        ]);
        $comment = new Comment;
        $data['nickname'] = $request->get('nickname');
        $data['email'] = $request->get('email');
        $data['website'] = $request->get('website');
        $data['content'] = $request->get('content');

        if ($comment->where('id', $id)->update($data)) {
            return redirect('admin/comments');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }
}
