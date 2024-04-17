@extends('layouts.app')
{{-- Company details--}}
@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-white my-5 pt-5 p-5">
    <h3 class="text-center">{{$company->title}}</h3>
    {{-- Displaying the data of the company table --}}
    <table class="table table-primary table-striped">
        <td class="text-left py-4">
            <h5>Company Name:</h5>
            {{ $company->name }}
        </td>

        <tr>
            <td class="text-left" style="">
                <h5>Created At:</h5>
                {{ $company->created_at }}
            </td>
        </tr>

        <tr>
            <td class="text-left" style="">
                <h5>Company Address:</h5>
                {{ $company->address }}
            </td>
        </tr>

    </table>
    <a href="{{route('companies.edit', $company->id) }}" class="btn btn-primary float-left">Edit</a>
    <a href="#" class="btn btn-danger float-right" data-bs-toggle="modal" data-bs-target="#delete2-modal">Delete</a>
    <div class="clearfix"></div>
    {{-- Delete pop-up --}}
    <div class="modal fade" id="delete2-modal">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Error Report</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                {{-- We find the form with querySelector, then submit the form with submit() --}}
                <button type="button" class="btn btn-danger" onclick="document.querySelector('#delete-form2').submit()">Proceed</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
        </div>
    </div>
    {{-- Routing to the company destroy method. Passing error report id --}}
    <form method="POST" id="delete-form2" action="{{route('companies.destroy',$company->id)}}">
        @csrf
        {{-- passing the value of DELETE since forms can only do post and get --}}
        @method('DELETE')
    </form>
</div>
    
    
@endsection