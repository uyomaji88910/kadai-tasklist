<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Task;    // add by Ryo Nakajima 2018/05/29

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::check()) { // go to index add by Ryo Nakajima 2018/06/12
            $user = \Auth::user();
            $task = $user->task()->orderBy('id', 'asc')->paginate(10);
            return view('tasks.index', [
                'tasks' => $task,
            ]);
        } else { // go to welcome if no login!! add by Ryo Nakajima 2018/06/12
            return view('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::check()) { // go to index add by Ryo Nakajima 2018/06/12
            // Edit Ryo 06/14
            $task = new Task;
            return view('tasks.create', [
                        'task' => $task,
            ]);
        } else { // go to welcome if no login!! add by Ryo Nakajima 2018/06/12
            return view('welcome');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:10',   // add
            'content' => 'required|max:191',
        ]);

        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;        
        $user = \Auth::user(); // add by Ryo Nakajima 2018/06/14
        $task->user_id = $user->id; // get user_id from User
        $task->save();

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Edit Ryo 06/15
        $task = Task::find($id);
        if (\Auth::id() === $task->user_id) {
            return view('tasks.show', [
                'task' => $task,
            ]);
        } else {

            return redirect('/tasks');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        // Edit Ryo 06/15
        $task = Task::find($id);
        if (\Auth::id() === $task->user_id) {
            return view('tasks.edit', [
                'task' => $task,
            ]);
        } else {

            return redirect('/tasks');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // mod by ryo nakajima 2018/06/01
        $this->validate($request, [
            'status' => 'required|max:10',   // add
            'content' => 'required|max:191',
        ]);
        //
        $task = Task::find($id);
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/tasks');
    }
}
