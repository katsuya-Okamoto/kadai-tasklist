@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
            
            <h1>タスク新規作成ページ</h1>
            
                {!! Form::model($task, ['route'=>'tasks.store']) !!}
                <div class="row">
                    <?php $user = Auth::user(); ?>
                    {{Form::hidden('user_id', $user->id)}}
                    <div class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
                        <div class="form-group">
                            {!! Form::label('status', '状態:') !!}
                            {!! Form::select('status', [
                                '未'=>'未',
                                '着手'=>'着手',
                                'まだまだ'=>'まだまだ',
                                '済'=>'済',
                            ],
                                null, [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                    </div>
                
                    <div class="col-xs-8 col-sm-9 col-md-10 col-lg-10">
                        <div class="form-group">
                            {!! Form::label('content', 'タスク') !!}
                            {!! Form::text('content', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        {!! Form::submit('作成', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
        
                {!! Form::close() !!}
                
        </div>
    </div>    
@endsection
