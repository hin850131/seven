@extends('todos.layout')

@section('content')
    <div class="flex justify-between border-b pb-4 px-4">
        <h1 class="text-2xl  pb-4 justify-between">
            Update this todo list
        </h1>
        <a class="mx-5 py-2 text-gray-400 cursor-pointer text-white" href="{{route('todo.index')}}"><span class="fas fa-arrow-left"></span></a>
    </div>
    
{{-- <h2>{{$todo->title}}</h2> --}}
    <x-alert></x-alert>
    <form method="POST" action="{{route('todo.update',$todo->id)}}" class="py-5">
        @csrf
        @method('patch')
        <div class="py-1">
    <input type="text" name="title" id="title" placeholder="Title" value="{{$todo->title}}" class="py-2 px-2 border rounded">
       
        </div>
        <div class="py-1">
            <textarea name="description" class="p-2 rounded border" id="" placeholder="Description" >{{$todo->description}}</textarea>
        </div>
        <div class="py-2">
      
            @livewire("edit-step",['steps'=>$todo->steps])
        
        </div>
        <div class="py-1"> 
            <input type="submit" value="Update" class="p-2 border rounded">
        </div>
    </form>

{{-- <a class="m-5 px-1 bg-white-400 cursor-pointer rounded border " href="{{route('todo.index')}}">Back</a> --}}
@endsection