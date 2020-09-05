<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use Illuminate\Http\Request;
use App\Todo;
use App\Step;
use App\User;
use Faker\Provider\Lorem;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\todos;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //dd(auth()->user());

        //$todos = auth()->user()->todos()->orderBy('completed')->get();
        
        //collection sort by
        $todos = auth()->user()->todos->sortBy('completed');
        //return $todos;

        //$todos = Todo::orderBy('completed')->get(); //order by
        //$todos = Todo::orderall();
        // return $todos;
        //return view('todos.index')->with(['todos'=>$todos]);
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function show(Todo $todo)
    {
        //return($todo->steps);
        return view('todos.show', compact('todo'));
    }

    //public function store(Request $request)
    public function store(TodoCreateRequest $request)
    {
        //dd($request->all());
        //dd(auth()->id());
        // $userId = auth()->id();
        //$request['user_id'] = $userId;
        // Todo::create($request->all());
        $todo = auth()->user()->todos()->create($request->all());
        if ($request->step) {
            foreach ($request->step as $step) {
                $todo->steps()->create(['name'=>$step]);
            }
        }
        // $todo->steps()->create();
        //dd($todo);
        //return redirect()->back()->with('message','Todo Created Sucessfully');
        return redirect(route('todo.index'))->with('message', 'Todo Created Sucessfully');
    }

    // public function edit($id)
    // {
    //     //dd($id);
    //     $todo = TOdo::find($id);
    //     //return $todo;
    //     return view('todos.edit',compact('todo'));
    // }
    //new routing function
    public function edit(Todo $todo) //route model binding
    {
        //dd($todo->title);
        //$todo = TOdo::find($id);
        //return $todo;
        return view('todos.edit', compact('todo'));
    }

    //public function update(Request $request, Todo $todo)
    public function update(TodoCreateRequest $request, Todo $todo)
    {
        //dd($request->all());
        //update todo
        $todo->update(['title'=>$request->title,'description'=>$request->description]);

        if ($request->stepName) {
            foreach ($request->stepName as $key=>$value) {
                $id = $request->stepId[$key];

                if (!$id) {
                    $todo->steps()->create(['name'=>$value]);
                } else {
                    $step = Step::find($id);
                    //$todo->steps()->update(['name'=>$step]);
                    $step->update(['name'=>$value]);
                }
            }
        }
        //return redirect()->back()->with('message','Updated!');
        return redirect(route('todo.index'))->with('message', 'Updated!');
    }

    public function complete(Todo $todo)
    {
        $todo->update(['completed'=>true]);
        return redirect()->back()->with('message', 'Task marked as Completed!');
    }

    public function incomplete(Todo $todo)
    {
        $todo->update(['completed'=>false]);
        return redirect()->back()->with('message', 'Task marked as Incompleted!');
    }

    public function destroy(Todo $todo)
    {
        $todo->steps->each->delete();
        $todo->delete();
        return redirect()->back()->with('message', 'Task Deleted!');
    }
}
