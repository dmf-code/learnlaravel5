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
                        @foreach ($comments as $comment)
                            <hr>
                            <div class="comment">
                                <ul>
                                    <li>{{ $comment->id }}</li>
                                    <li>{{ $comment->nickname }}</li>
                                    <li>{{ $comment->email }}</li>
                                    <li>{{ $comment->website }}</li>
                                    <li>{{ $comment->article_id }}</li>
                                </ul>
                                <div class="content">
                                    <p>
                                        {{ $comment->content }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ url('admin/comments/'.$comment->id.'/edit') }}" class="btn btn-success">编辑</a>
                            <form action="{{ url('admin/comments/'.$comment->id) }}" method="POST" style="display: inline;">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">删除</button>
                            </form>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection