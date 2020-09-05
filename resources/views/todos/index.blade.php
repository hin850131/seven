@extends('todos.layout')    

@section('content')
{{-- flex - inline --}}
<div class="flex justify-between border-b pb-4 px-4">
    <h1 class="text-2xl">All Your Todos</h1>
    <a class="mx-5 py-2 text-blue-400 cursor-pointer text-white" href="{{route('todo.create')}}"><span class="fas fa-plus-circle"></span>
    </a>
</div>
    
    <ul class="my-5">
        <x-alert></x-alert>
       
        @forelse ($todos as $todo)
            <li class="flex justify-between p-2">
                <div>
                    @include('todos.complete-button')
                </div>
                
                @if($todo->completed)
                    <p class="line-through">{{$todo->title}}</p>
                @else
            <a class="cursor-pointer" href="{{route('todo.show',$todo->id)}}">{{$todo->title}}</p>
                @endif
                <div>
                    <a href="{{route('todo.edit',$todo->id)}}" class="text-orange-400 cursor-pointer  text-white">
                        <span class="fas fa-pencil-alt px-2 " ></span>
                    </a>

                
                        <span class="fas fa-times text-red-500 px-2 cursor-pointer" onclick="event.preventDefault();
                        if (confirm('Are you really wato to delete?'))
                        {document.getElementById('form-delete-{{$todo->id}}').submit()}" ></span>
                    
                        <form style="display:none" id="{{'form-delete-'.$todo->id}}" method="post" action="{{route('todo.destroy',$todo->id)}}">
                            @csrf
                            @method('delete')
                            {{-- @method('put') --}}
                        </form>
                    
                
                </div>
            
                

            </li>
        @empty
            <p>No task available, create one</p>
        @endforelse
                
 
           
    </ul>
@endsection
