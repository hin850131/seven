@extends('todos.layout')


@section('content')
    <div class="flex justify-between border-b pb-4 px-4">
        <h1 class="text-2xl  pb-4 justify-between">
            {{$todo->title}}
        </h1>
        <a class="mx-5 py-2 text-gray-400 cursor-pointer text-white" href="{{route('todo.index')}}"><span class="fas fa-arrow-left"></span></a>
    </div>
    
    <div>
        <div>
            <h3 class="text-lg">Description</h3>
           <p class="">{{$todo->description}}</p>
        </div>
        @if($todo->steps->count() >0)
        <div class="py-4">
            <h3 class="text-lg">Step for this task</h3>
           @foreach ($todo->steps as $step)
               <p>{{$step->name}}</p>
           @endforeach 
        </div>
        @endif
    </div>
@endsection


