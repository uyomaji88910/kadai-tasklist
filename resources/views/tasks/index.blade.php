@extends('layouts.app')

    @section('content')

    <h1>タスク一覧</h1>

    @if (count($test) > 0)
        <ul>
            @foreach ($test as $task)
              ------------------------------------------------------
                <li>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!}
   @empty ($task->status && $task->content)!!!!!!!!! Empty !!!!!!!!!!   ステータスかコンテンツが空です！
　　　　　　　　　　　@endempty
                     <br> ステータス : {{ $task->status }}
                     <br> コンテンツ : {{ $task->content }}
                     <br>
                </li>
            @endforeach
        </ul>
    @endif

              {!! link_to_route('tasks.create', '新規タスクの投稿') !!}

@endsection
