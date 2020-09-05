<div>
    {{$slot}}
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    @if(session()->has('message'))
    {{-- {{session()->forget('message')}} --}}
    {{-- <div class="alert alert-success">{{session()->get('message')}}</div> --}}
    <div class="py-4 px-2 bg-green-300">{{session()->get('message')}}</div>
    @elseif(session()->has('error'))
    <div class="py-4 px-2 bg-red-300">{{session()->get('error')}}</div>
    @endif

    {{-- validation error --}}
    @if ($errors->any())
        <div class="py-4 px-2 bg-red-300">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>