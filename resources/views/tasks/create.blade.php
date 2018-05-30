@extends('layouts.app')

@section('content')

    <h1>タスク新規作成ページ</h1>
    
    {!! Form::model($task, ['route'=>'tasks.store']) !!}
    
        {!! Form::label('status', '状態:') !!}
        {!! Form::select('status', [
            '未'=>'未',
            '着手'=>'着手',
            'まだまだ'=>'まだまだ',
            '済'=>'済',
        ]) !!}

        {!! Form::label('content', 'タスク') !!}
        {!! Form::text('content') !!}
        
        {!! Form::submit('作成') !!}
    
    {!! Form::close() !!}

@endsection
