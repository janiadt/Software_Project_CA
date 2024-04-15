@extends('layouts.app')
@section('content')

    @auth
    <div class="drop-shadow-3xl max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-gray-100 mt-5 p-2  rounded">
        <h2 class="text-center">Solar Panel Array</h2>
    </div>
    <div class="drop-shadow-3xl max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-gray-200 mt-1 p-5 pt-3 pb-3 rounded">
        
        {{-- routing to the panels.registerPanel route when the button is clicked. --}}
        <a href="{{route('panels.registerPanel')}}" class="btn btn-primary px-2">Register Solar Panel</a>


        {{-- Using the blade forelse loop, I will display each panel as its own div with a background based on how much battery is left --}}
        <div class="d-flex align-items-start flex-row flex-wrap ml-5">
            @forelse($panels as $panel)
            <a href="{{route('panels.show', $panel->id)}}" class="drop-shadow-3xl text-decoration-none text-black
            
            {{-- Blade if statement in the class names. The color will change based on how much battery you have left --}}
            @if($panel->battery > 70)
            bg-metal
            @elseif($panel->battery >= 40)
            bg-orange-400
            @elseif($panel->battery < 39 && $panel->battery >= 1)
            bg-red-400
            @else
            bg-black text-white
            @endif w-10 h-10 mx-2 my-2 border border-dark" style="width:48px; height:70px">
            
            {{-- Showing panel number and battery --}}
            <p>#{{$panel->number}}</p>
            
            {{$panel->battery}}%      
            </a>   
            @empty
            <h4 class="text-center">No Solar Panels Registered</h4>
            @endforelse
        </div>
        

        <div class="border border-dark">
        {{-- Using the in_array method, I check if the number 0 apperas in the $panels array (I need to use the toArray method to make the laravel collections into an array) --}}
        <h4 class="text-center">Malfunctioning solar panel(s):
            {{-- Shows the panels that are malfunctioning --}}
        @foreach($panels as $panel)
        @if($panel->battery === 0)
        <short class="text-red-800">#{{$panel->number}}</short>
        @endif
        @endforeach
      
    </div>
    </div>
    @endauth

@endsection