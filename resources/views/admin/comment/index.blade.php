@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">评论管理</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                {!! implode('<br>', $errors->all()) !!}
                            </div>
                        @endif
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>名称</th>
                                <th>邮箱</th>
                                <th>网站</th>
                                <th>文章ID</th>
                                <th>内容</th>
                                <th>编辑</th>
                            </tr>
                        @foreach ($comments as $comment)
                                        <tr>
                                            <td>{{ $comment->id }}</td>
                                            <td>{{ $comment->nickname }}</td>
                                            <td>{{ $comment->email }}</td>
                                            <td>{{ $comment->website }}</td>
                                            <td>{{ $comment->article_id }}</td>
                                            <td>{{ $comment->content }}</td>
                                            <td>
                                                <a href="{{ url('admin/comments/'.$comment->id.'/edit') }}" class="btn btn-success">编辑</a>
                                                <form action="{{ url('admin/comments/'.$comment->id) }}" method="POST" style="display: inline;">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger">删除</button>
                                                </form>
                                            </td>
                                        </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection