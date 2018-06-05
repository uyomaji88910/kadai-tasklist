            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put']) !!}
                <div class="form-group">
                {!! Form::label('status', 'ステータス:') !!}
                    {!! Form::text('status', null, ['class' => 'form-control']) !!}
                </div>
        
                <div class="form-group">
                {!! Form::label('content', 'タスク:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
