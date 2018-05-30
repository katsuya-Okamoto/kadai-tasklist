@extends('layouts.app')

@section('content')

    <h1>id: {{ $task->id }} のタスク更新ページ</h1>
    
    {!! Form::model($task, ['route'=>['tasks.update', $task->id], 'method'=>'put']) !!}

        {!! Form::label('status', '状態:') !!}
        {!! Form::select('status', [
            '未'=>'未',
            '着手'=>'着手',
            'まだまだ'=>'まだまだ',
            '済'=>'済',
        ]) !!}

       {!! Form::label('content', 'タスク') !!}
        {!! Form::text('content') !!}
        
        {!! Form::submit('更新') !!}

    {!! Form::close() !!}

@endsection
