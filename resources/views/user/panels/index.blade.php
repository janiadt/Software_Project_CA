@extends('layouts.app')
@section('content')

    @auth
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-white my-5 pt-5 pb-3">
        <h2 class="text-center">Solar Panel Array</h2>
        <a href="{{route('panels.registerPanel')}}" class="btn btn-primary px-2">Register Solar Panel</a>


        {{-- Here I will display all of the error reports made by the user and their status --}}
        <table class="table table-bordered mt-3" id="normal-table" style="table-layout:auto">
            <thead class="table-primary">
            <tr>
                <th scope="col" class="p-2">Number</th>
                <th scope="col" class="p-2">Registered By</th>
                <th scope="col" class="p-2">Registered At</th>
                <th scope="col" class="p-2">Light Level</th>
                <th scope="col" class="p-2">Battery</th>
                <th scope="col" class="p-2">Production</th>
                <th scope="col" class="p-2">Ambient Temperature</th>
                <th scope="col" class="p-2">Humidity</th>
                <th scope="col" class="p-2">Panel Temperature</th>
                <th scope="col" class="p-2">Company Name</th>
            </tr>
            @forelse($panels as $panel)
            </thead>
            <tbody>
                <tr>
                {{-- Link to show page --}}
                <td class="p-3"><a href="{{route('panels.show',$panel->id)}}" id="counter" class="link-underline link-underline-opacity-0 link-underline-opacity-100-hover text-black">Solar Panel Number: {{$panel->number}}</a></td>
                {{-- User name --}}
                <td class="p-3">{{$panel->users->name}}
                <td class="p-3">{{$panel->created_at->diffForHumans()}} 
                <td class="p-3">{{$panel->light_level}}
                <td class="p-3">{{$panel->battery}}
                <td class="p-3">{{$panel->production}}
                <td class="p-3">{{$panel->ambient_temperature}}
                <td class="p-3">{{$panel->humidity}}
                <td class="p-3">{{$panel->panel_temperature}}
                <td class="p-3">{{$panel->companies->name}}
                </tr>
            </tbody>
            @empty
            <h4 class="text-center">No Solar Panels Registered</h4>
            @endforelse
        </table>

        {{-- Most viewed threads --}}

        {{-- Pagination links --}}
        <div class="d-flex justify-content-center">
            {{ $panels->links() }}
        </div>
    </div>
    @endauth

@endsection