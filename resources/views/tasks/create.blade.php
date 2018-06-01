@extends('layouts.app')

    @section('content')

    <h1>タスク新規作成ページ</h1>
     
    {!! Form::model($task, ['route' => 'tasks.store']) !!}
        {!! Form::label('status', 'ステータス:') !!}
        {!! Form::text('status') !!}
<br>
        {!! Form::label('content', 'メッセージ:') !!}
        {!! Form::text('content') !!}
<br>
        {!! Form::submit('投稿') !!}

    {!! Form::close() !!}

@endsection
