@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-white my-5 pt-5 p-5">
    <h3 class="text-center">Edit report</h3>
    {{-- Routing to Company update method, passing Company id. --}}
    <form enctype="multipart/form-data" action="{{ route('companies.store', $company->id) }}" method="post">
        {{-- Csrf ensures that we have a secure token which you will not be able to submit a form without --}}
        @csrf
        {{-- We also need a put method here, since HTML forms dont have it --}}
        @method('PUT')
        <div class="form-group">
            <label for="name">Company Name</label>
            {{-- Creating input types for each company variable --}}
            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') ? : $company->name }}" placeholder="Enter name">
            {{-- Error feedback --}}
            @if($errors->has('name'))
                <span class="invalid-feedback">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        {{-- Address input --}}
        <div class="form-group">
            <label for="address">Company Address</label>
            <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ old('address') ? : $company->address }}" placeholder="Enter address">
            {{-- Error feedback --}}
            @if($errors->has('address'))
                <span class="invalid-feedback">
                    {{ $errors->first('address') }}
                </span>
            @endif
        </div>
      
        {{-- This is a button that will let us submit the form, which will then inact the form action --}}
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection