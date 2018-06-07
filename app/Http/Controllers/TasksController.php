<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\User;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            return view('tasks.index', ['tasks'=>$tasks,]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;
        
        return view('tasks.create', [
                'task'=>$task,
            ]);
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
           'status' => 'required|max:10',
           'content' => 'required|max:191',
        ]);
        
        $task = new Task;
        $task->user_id = $request->user_id;
        $task->status = $request->status;
        $task->content = $request->content;
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
        if (\Auth::check()) {
            $user = \Auth::user();
            $task = $user->tasks()->find($id);
            
            if ($task!=null){
                return view('tasks.show', ['task'=>$task,]);
            }else{
                return redirect('/tasks');
            }
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
        if (\Auth::check()) {
            $user=\Auth::user();
            if (($user->isMyTask($id))==TRUE){
                $task = $user->tasks()->find($id);
                return view('tasks.edit', [
                        'task'=>$task,
                    ]);
            }else{
                return redirect('/');
            }
            
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
        $this->validate($request, [
           'status' => 'required|max:10',
           'content' => 'required|max:191',
        ]);

        $task = Task::find($id);
        $task->status = $request->status;
        $task->content = $request->content;
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
        if (\Auth::check()) {
            $user=\Auth::user();
            if (($user->isMyTask($id))==TRUE){
                $task = Task::find($id);
                $task->delete();
            }
        }
        return redirect('/tasks');
    }
}
