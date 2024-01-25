<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $search = $request->search ? $request->search : "";
        if(Auth::check()){
            $roleNameArray = array_column(Auth::user()->roles->toArray(), 'name');
            if(in_array('admin', $roleNameArray)) {
                $tasks = Task::where('title', 'LIKE', '%'. $search .'%')
                ->orWhere('description', 'LIKE', '%'. $search .'%')
                ->orderBy('due_date','DESC')
                ->latest()->paginate(3);
            } else {
               
                $tasks = Task::where('users_id', '=', Auth::user()->id)->where(function($query) use ($search) {
                    $query->where('title', 'LIKE', '%'.$search.'%')
                        ->orWhere('description', 'LIKE', '%'.$search.'%');
                    })->orderBy('due_date','DESC')
                ->latest()->paginate(3);

            }
            return view('tasks.index', [
                'tasks' => $tasks
            ]);
        } else {
            return redirect('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        if(Auth::check()){    
            return view('tasks.create');
        } else {
           return redirect('login'); 
        }    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request) : RedirectResponse
    {
        if(Auth::check()){  
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'status' => $request->status,
                'users_id' => Auth::user()->id
            ];  
            Task::create($data);
            return redirect()->route('tasks.index')
                ->withSuccess('New task is added successfully.');
        } else {
           return redirect('login'); 
        } 
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if(Auth::check()){    
            return view('tasks.show', [
                'task' => $task
            ]);
        } else {
           return redirect('login'); 
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if(Auth::check()){    
            return view('tasks.edit', [
                'task' => $task
            ]);
        } else {
           return redirect('login'); 
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task) : RedirectResponse
    {
        if(Auth::check()){    
                $task->update($request->all());
                return redirect()->back()
                ->withSuccess('Task is updated successfully.');
        } else {
            return redirect('login'); 
        }        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task) : RedirectResponse
    {
        $task->delete();
        return redirect()->route('tasks.index')
                ->withSuccess('Task is deleted successfully.');
    }
}