
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-white my-5 pt-5 p-5">
    <h3 class="text-center">Create Error Report</h3>
    {{-- Routing to Reports update method, passing Report id. --}}
    <form enctype="multipart/form-data" action="{{ route('errors.store') }}" method="post">
        {{-- Csrf ensures that we have a secure token which you will not be able to submit a form without --}}
        @csrf
        {{-- We also need a put method here, since HTML forms dont have it --}}
        <div class="form-group">
            <label for="title">Report Title</label>
            {{-- Creating input types for each table variable --}}
            <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}" placeholder="Enter Title">
            {{-- Error feedback --}}
            @if($errors->has('title'))
                <span class="invalid-feedback">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>
        {{-- Body value input. Here we'll need a textarea for the input --}}
        <div class="form-group my-3">
            <label for="body">Report Body</label>
            <input type="textarea" name="body" id="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" value="{{ old('body') }}" placeholder="Enter Body">
            @if($errors->has('body')) {{-- <-check if we have a validation error --}}
                <span class="invalid-feedback">
                    {{ $errors->first('body') }} {{-- <- Display the First validation error --}}
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="severity">Severity</label>
            <select name="severity" class="form-control {{ $errors->has('severity') ? 'is-invalid' : '' }}" value="{{ old('severity') }}">
                {{-- For each model category, show an option to select it --}}
                @foreach (App\Models\ErrorReport::arr() as $a)
                <option value = "{{$a}}">{{$a}} </option>
                @endforeach
            </select>
            @if($errors->has('severity')) 
                <span class="invalid-feedback">
                    {{ $errors->first('severity') }} 
                </span>
            @endif
            </select>
        </div>
        {{-- This is a button that will let us submit the form, which will then inact the form action --}}
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection