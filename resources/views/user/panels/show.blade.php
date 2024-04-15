@extends('layouts.app')
{{-- Showing a specific panel --}}
@section('content')
@auth
<div class="max-w-3xl mx-3 mx-lg-auto sm:px-6 lg:px-8 space-y-6 bg-gray-200 mt-4 p-2 rounded">
    <h3 class="text-center">Panel Number #{{$panel->number}}</h3>
    {{-- Displaying all of the values of the panel object --}}
    <table class="table table-primary table-striped">
        <tr>
            <td class="text-center">
                <h5>Light-level</h5>
                {{ $panel->light_level }}
                
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h5>Battery</h5>
                {{ $panel->battery }}%
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h5>Production</h5>
                {{ $panel->production }}
                
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h5>Ambient Temperature</h5>
                {{ $panel->ambient_temperature }} 
                
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h5>Humidity</h5>
                {{ $panel->humidity }}
                
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h5>Panel Temperature</h5>
                {{ $panel->panel_temperature }}
                
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h5>Company Name</h5>
                {{ $panel->companies->name }}
                
            </td>
        </tr>
        <tr>
            <td class="text-center">
                <h5>Registered By</h5>
                {{ $panel->users->name }}
                
            </td>
        </tr>
        
    </table>
    <br>
    <a href="#" class="btn btn-danger float-right" data-bs-toggle="modal" data-bs-target="#delete-modal">Delete</a>
    <div class="clearfix"></div>
    {{-- Delete item modal. The popup window will ask you if you want to delete the item. --}}
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Song</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                {{-- We find the form with querySelector, then submit the form with submit() --}}
                <button type="button" class="btn btn-danger" onclick="document.querySelector('#delete-form').submit()">Proceed</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
        </div>
    </div>
    {{-- Routing to panels.destroy with the panel id --}}
    <form method="POST" id="delete-form" action="{{route('panels.destroy',$panel->id)}}">
        @csrf
        {{-- passing the value of DELETE since forms can only do post and get --}}
        @method('DELETE')
    </form>
</div>
@endauth
@endsection